<?php

namespace NinjaTablesPro\DataProviders;


class WPPostsProvider
{
    use WPPostDataSourceTrait;

    public function boot()
    {
        add_filter('ninja_tables_get_table_wp-posts', array($this, 'getTableSettings'));
        add_filter('ninja_tables_get_table_data_wp-posts', array($this, 'getTableData'), 10, 4);
        add_filter('ninja_tables_fetching_table_rows_wp-posts', array($this, 'data'), 10, 5);
        add_action('wp_ajax_ninja_table_wp-posts_create_table', array($this, 'createTable'));
        add_action('wp_ajax_ninja_table_wp-posts_get_custom_field_options', array($this, 'getTableDataOptions'));

        add_filter('ninja_table_activated_features', function ($features) {
            $features['wp_posts_table'] = true;
            return $features;
        });
    }

    public function createTable()
    {
        if(!current_user_can(ninja_table_admin_role())) {
            return;
        }
        $messages = array();
        if (!($tableId = $_REQUEST['tableId'])) {
            // Validate Title
            if (empty($_REQUEST['post_title'])) {
                $messages['title'] = __('The title field is required.', 'ninja-tables-pro');
            }
        }

        // Validate Columns
        $fields = isset($_REQUEST['data']['columns']) ? $_REQUEST['data']['columns'] : array();
        $fields = array_filter($fields);
        if (!($fields = ninja_tables_sanitize_array($fields))) {
            $messages['columns'] = __('No columns were selected.', 'ninja-tables-pro');
        }

        // If Validation failed
        if (array_filter($messages)) {
            wp_send_json_error(array('message' => $messages), 422);
            wp_die();
        }

        if ($tableId) {
            $oldColumns = get_post_meta($tableId, '_ninja_table_columns', true);

            $oldColumnOriginalNames = array_filter(array_map(function ($col) {
                return $col['original_name'];
            }, $oldColumns));

            $oldColumns = array_filter($oldColumns, function ($col) use ($fields) {
                return in_array($col['original_name'], $fields);
            });

            $fields = array_diff($fields, $oldColumnOriginalNames);
        }

        $headers = ninja_table_format_header($fields);

        $columns = array();
        foreach ($headers as $key => $column) {
            $dataType = $this->getType($column);
            $sourceType = $this->getSourceType($column);
            $columnData = array(
                'name' => $this->getHumanName($column),
                'key' => $key,
                'breakpoints' => '',
                'data_type' => $dataType,
                'dateFormat' => ($dataType == 'date') ? 'YYYY-MM-DD' : null,
                'header_html_content' => null,
                'enable_html_content' => false,
                'contentAlign' => null,
                'textAlign' => null,

                // These are new attributes
                'source_type' => $sourceType,
                'original_name' => $column
            );

            if ($sourceType == 'post_data') {
                $columnData['permalinked'] = ($column == 'post_title' || $column == 'ID' || $column == 'post_author') ? 'yes' : 'no';
                if ($column == 'post_author') {
                    $columnData['filter_permalinked'] = 'yes';
                }
            } else if ($sourceType == 'tax_data') {
                $columnData['permalinked'] = 'yes';
                $columnData['filter_permalinked'] = 'yes';
                $columnData['taxonomy_separator'] = ', ';
            }

            $columns[] = $columnData;
        }

        if ($tableId) {
            $columns = array_merge($oldColumns, $columns);
            $message = 'Table updated successfully.';
        } else {
            $tableId = $this->saveTable();

            update_post_meta($tableId, '_ninja_wp_posts_query_extra', $this->getQueryExtra($tableId));

            $message = 'Table created successfully.';
        }

        update_post_meta($tableId, '_ninja_table_wpposts_ds_post_types', $_REQUEST['data']['post_types']);
        update_post_meta($tableId, '_ninja_table_wpposts_ds_where', $_REQUEST['data']['where']);
        update_post_meta($tableId, '_ninja_table_columns', $columns);
        update_post_meta($tableId, '_ninja_tables_data_provider', 'wp-posts');


        if(isset($_REQUEST['data']['query_extra'])) {
            update_post_meta($tableId, '_ninja_wp_posts_query_extra', $_REQUEST['data']['query_extra']);
        }

        wp_send_json_success(array('table_id' => $tableId, 'message' => $message), 200);
    }

    public function getTableSettings($table)
    {
        $table->isEditable = false;
        $table->dataSourceType = 'wp-posts';
        $table->whereConditions = get_post_meta($table->ID, '_ninja_table_wpposts_ds_where', true);
        $table->post_types = get_post_meta($table->ID, '_ninja_table_wpposts_ds_post_types', true);
        $table->isEditableMessage = 'You may edit your table settings here.';

        $table->isExportable = true;
        $table->isImportable = false;
        $table->isSortable = false;
        $table->isCreatedSortable = false;
        $table->hasCacheFeature = false;
        $table->query_extra = $this->getQueryExtra($table->ID);
        return $table;
    }

    public function getTableData($data, $tableId, $perPage = -1, $offset = 0)
    {
        if($perPage == -1) {
            $queryExtra = $this->getQueryExtra($tableId);
            if(isset($queryExtra['query_limit']) && $queryExtra['query_limit']) {
                $perPage = intval($queryExtra['query_limit']);
            }
        }

        $newData = array();
        $posts = $this->getPosts($tableId);
        $total = count($posts);
        $responsePosts = array_slice($posts, $offset, $perPage);
        foreach ($responsePosts as $key => $post) {
            $newData[] = array(
                'id' => $key + 1,
                'values' => $post,
                'position' => $key + 1,
            );
        }
        return array(
            $newData,
            $total
        );
    }

    public function data($data, $tableId, $defaultSorting, $limitEntries = false, $skip = false)
    {
        $perPage = -1;
        $queryExtra = $this->getQueryExtra($tableId);
        if($limitEntries) {
            $perPage = $limitEntries;
        } else {
            if(isset($queryExtra['query_limit']) && $queryExtra['query_limit']) {
                $perPage = intval($queryExtra['query_limit']);
            }
        }
        return $this->getPosts($tableId, $perPage, $skip);
    }

    public function getPosts($tableId, $per_page = -1, $offset = 0)
    {
        $columns = get_post_meta($tableId, '_ninja_table_columns', true);
        $formatted_columns = array();
        foreach ($columns as $column) {
            $type = $this->get($column, 'source_type');
            $originalName = $this->get($column, 'original_name');
            $columnKey = $this->get($column, 'key');
            $dataType = $this->get($column, 'wp_post_custom_data_type');
            $dataValue = $this->get($column, 'wp_post_custom_data_value');

            $formatted_columns[$columnKey] = array(
                'type' => ($originalName == 'post_author') ? 'author_data' : $type,
                'original_name' => $originalName,
                'key' => $columnKey,
                'permalinked' => $this->get($column, 'permalinked'),
                'permalink_target' => $this->get($column, 'permalink_target'),
                'filter_permalinked' => $this->get($column, 'filter_permalinked'),
                'taxonomy_separator' => $this->get($column, 'taxonomy_separator'),
                'wp_post_custom_data_type' => $dataType,
                'wp_post_custom_data_value' => $dataValue
            );
        }

        $where = get_post_meta($tableId, '_ninja_table_wpposts_ds_where', true);

        $post_types = get_post_meta($tableId, '_ninja_table_wpposts_ds_post_types', true);

        return $this->buildWPQuery(
            compact('tableId', 'formatted_columns', 'where', 'post_types', 'offset', 'per_page')
        );
    }

    protected function saveTable($postId = null)
    {
        $attributes = array(
            'post_title' => sanitize_text_field($this->get($_REQUEST, 'post_title')),
            'post_content' => wp_kses_post($this->get($_REQUEST, 'post_content')),
            'post_type' => 'ninja-table',
            'post_status' => 'publish'
        );

        if (!$postId) {
            $postId = wp_insert_post($attributes);
        } else {
            $attributes['ID'] = $postId;
            wp_update_post($attributes);
        }
        return $postId;
    }

    public function getTableDataOptions()
    {
        $data = array(
            'custom_fields' => array(
                array(
                    "key" => 'acf_field',
                    "label" => 'Advanced Custom Fields (ACF)',
                    "instruction" => 'You can populate any ACF fields. Please provide the selector name of the ACF field then your table column values will be populated',
                    "learn_more_url" => 'https://wpmanageninja.com/docs/ninja-tables/wp-posts-table/acf-field/',
                    "learn_more_text" => 'Learn more about ACF Field integration',
                    "value_type" => 'text',
                    "placeholder" => 'Type ACF field selector',
                    "disabled" => !function_exists('get_field')
                ),
                array(
                    "key" => 'post_meta',
                    "label" => 'Post Meta',
                    "placeholder" => 'Type Post Meta key',
                    "instruction" => 'You can populate any Post Meta. Please provide the name of the meta key then your table column values will be populated for corresponding row',
                    "learn_more_url" => 'https://wpmanageninja.com/docs/ninja-tables/wp-posts-table/custom-column-on-wp-posts-table/',
                    "learn_more_text" => 'Learn more about Post Meta integration',
                    "value_type" => 'text'
                ),
                array(
                    "key" => 'shortcode',
                    "label" => 'Shortcode / Computed Value or HTML',
                    "placeholder" => 'Provide any valid HTML / Computed fields, Please check instruction / documentation for advance usage',
                    "instruction" => 'You can add any type of HTML or customized dynamic field / shortcode as the column value. You add dynamic post/post meta/acf field like as below: <ul><li>For Post Field: {post.ID} / {post.post_title} / {post.permalink}</li><li>For Post Meta: {postmeta.POSTMETA_KEY_NAME}</li><li>For ACF Field: {acf.acf_field_name}</li><li>For Dynamic Shortcode: [yourshortcode YourParam="{post.ID}"]</li></ul>',
                    "learn_more_url" => 'https://wpmanageninja.com/docs/ninja-tables/wp-posts-table/shortcode-computed-value-or-html-in-wp-posts-table/',
                    "learn_more_text" => 'Please read the documentation for more details and advanced usage',
                    "value_type" => 'textarea'
                ),
                array(
                    "key" => 'featured_image',
                    "label" => 'Featured Image',
                    "instruction" => 'Show Featured image with post link / without link',
                    "value_type" => 'options',
                    "placeholder" => 'Select Image Size',
                    "options" => get_intermediate_image_sizes()
                ),
            )
        );
        wp_send_json_success($data);
    }

}
