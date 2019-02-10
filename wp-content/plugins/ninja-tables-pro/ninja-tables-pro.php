<?php
/*
Plugin Name: Ninja Tables Pro
Description: The Pro version of Ninja Tables, best Responsive Table Plugin for WordPress.
Version: 3.1.1
Author: WPManageNinja
Author URI: https://wpmanageninja.com/
Plugin URI: https://wpmanageninja.com/downloads/ninja-tables-pro-add-on/
License: GPLv2 or later
Text Domain: ninja-tables-pro
Domain Path: /resources/languages
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// To check if pro is available in scripts in this plugin
defined( 'NINJATABLESPRO' ) or define( 'NINJATABLESPRO', true );
define('NINJAPROPLUGIN_PATH',  plugin_dir_path(__FILE__));
define('NINJAPRO_PLUGIN_FILE', __FILE__);
defined('NINJAPROPLUGIN_VERSION') or define('NINJAPROPLUGIN_VERSION', '3.1.1');
define('NINJAPROPLUGIN_URL',  plugin_dir_url(__FILE__));

define('NINJATABLESPRO_SORTABLE', true);

include 'src/libs/updater/ninja_table_pro_updater.php';

if ( ! class_exists( 'NinjaTablesPro' ) ) {
	class NinjaTablesPro {

		public function boot() {
		    $this->loadDependencies();
			if(is_admin()) {
				$this->adminHooks();
			}
			$this->public_hooks();
		}

		/**
		 * Register admin/backend hooks
		 */
		public function adminHooks() {
			if ( current_user_can( 'install_plugins' ) ) {
				$this->checkForPluginInstall();
			}

			add_filter('ninja_table_admin_role', '\NinjaTablesPro\Permission::getPermission');
			add_filter('ninja_tables_item_attributes', '\NinjaTablesPro\Position::make');
			add_filter('ninja_tables_import_table_data', '\NinjaTablesPro\Position::maker', 10, 2);

			if ( function_exists( 'ninja_table_admin_role' ) && current_user_can( ninja_table_admin_role() ) ) {
				add_action( 'wp_ajax_ninja_tables_get_permission', '\NinjaTablesPro\Permission::get' );
				add_action( 'wp_ajax_ninja_tables_set_permission', '\NinjaTablesPro\Permission::set' );

				// Init sortable for the table.
				add_action('wp_ajax_ninja_tables_init_sortable', '\NinjaTablesPro\Sortable::init');
				add_action('wp_ajax_ninja_tables_sort_table', '\NinjaTablesPro\Sortable::sort');
			}
		}

		public function public_hooks() {
			add_filter('ninja_table_js_config', function ($config, $filter) {
				if(!empty($config['shortCodeData']['get_filter'])) {
					$filter_var = $config['shortCodeData']['get_filter'];
					if(isset($_GET[$filter_var])) {
						$filter = sanitize_text_field($_GET[$filter_var]);
					}
					if(isset($_GET['column'])) {
                        $config['settings']['filter_column'] = explode(',', $_GET['column']);
                    }
				}
				$config['default_filter'] = $filter;

				return $config;
			}, 10, 2);
			add_filter('ninja_table_column_attributes', function ($formatted_column, $originalColumn) {
				if(isset($formatted_column['title'])) {
					$formatted_column['title'] = do_shortcode($formatted_column['title']);
				}

				if(isset($originalColumn['conditions'])) {
					$formatted_column['conditions'] = $originalColumn['conditions'];
				}

				if(isset($originalColumn['transformed_value'])) {
					$formatted_column['transformed_value'] = $originalColumn['transformed_value'];
				}

				return $formatted_column;
			}, 10, 2);
			add_filter('ninja_tables_shortcode_defaults', function ($defaults) {
				$defaults['per_page'] = null;
				$defaults['search'] = null;
				$defaults['sorting'] = null;
				$defaults['hide_header'] = null;
				$defaults['logged_in_only'] = null;
				$defaults['columns'] = 'all';
				$defaults['get_filter'] = '';
				$defaults['filter_column'] = '';
				$defaults['skip'] = 0;
				$defaults['limit'] = 0;
				return $defaults;
			});
			add_filter('ninja_tables_rendering_table_settings', function ($settings, $shortCodeData) {

			    if($shortCodeData['per_page'] !== null) {
					$settings['perPage'] = intval($shortCodeData['per_page']);
				}

				if($shortCodeData['search'] !== null) {
					$settings['enable_search'] = (bool) $shortCodeData['search'];
				}
				if($shortCodeData['sorting'] !== null) {
					$settings['column_sorting'] = (bool) $shortCodeData['sorting'];
				}
				if($shortCodeData['hide_header'] !== null) {
					$settings['hide_header_row'] = (bool) $shortCodeData['hide_header'];
				}

				if($shortCodeData['logged_in_only'] !== null && $shortCodeData['logged_in_only']) {
					if(!is_user_logged_in()) {
						return array();
					}
				}

                if($shortCodeData['skip']) {
                    $settings['skip_rows'] = $shortCodeData['skip'];
                }
                if($shortCodeData['limit']) {
                    $settings['limit_rows'] = $shortCodeData['limit'];
                }

                if($shortCodeData['filter_column']) {
                    $filterColumns = explode(',', $shortCodeData['filter_column']);
                    $settings['filter_column'] = $filterColumns;
                }

				if(!empty($shortCodeData['columns']) && $shortCodeData['columns'] != 'all' ) {
					$columns = explode(',', $shortCodeData['columns']);
					if($columns) {
						$columns = array_flip($columns);
						$settings['columns_only'] = $columns;
					}
				}
				return $settings;
			}, 10, 2);
		    $customTableFilters = new \NinjaTablesPro\CustomFilters();
		}

		private function checkForPluginInstall() {
			if( defined( 'NINJA_TABLES_DIR_URL' ) ) {
				return;
			}

			// parent plugin is not installed;
			add_action( 'admin_notices', function () {
				$pluginInfo = $this->getNinjaTableInstallDetails();

				$class = 'notice notice-error';

				$install_url_text = 'Click Here to Install the plugin';

				if($pluginInfo->action == 'activate') {
					$install_url_text = 'Click Here to Activate the plugin';
				}

				$message =  'NinjaTables Pro Add-On Requires Ninja Tables Base Plugin, <b><a href="'.$pluginInfo->url.'">'.$install_url_text.'</a></b>';

				printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ),  $message  );
			} );

		}

		private function getNinjaTableInstallDetails() {
			$activation = (object) array(
				'action'       => 'install',
				'url'          => ''
			);

			$allPlugins = get_plugins();
			if ( isset( $allPlugins['ninja-tables/ninja-tables.php'] ) ) {
				$url                = wp_nonce_url(
					self_admin_url( 'plugins.php?action=activate&plugin=ninja-tables/ninja-tables.php' ),
					'activate-plugin_ninja-tables/ninja-tables.php'
				);
				$activation->action = 'activate';
			} else {
				$api = (object) array(
					'slug' => 'ninja-tables'
				);
				$url = wp_nonce_url(
					self_admin_url( 'update.php?action=install-plugin&plugin=' . $api->slug ),
					'install-plugin_' . $api->slug
				);
			}
			$activation->url = $url;
			return $activation;
		}

		private function loadDependencies()
        {
            include 'src/Permission.php';
            include 'src/Sortable.php';
            include 'src/Position.php';
            include 'src/CustomFilters.php';
            if( defined( 'NINJA_TABLES_DIR_URL' ) ) {
                include 'src/DataProviders/WPPostDataSourceTrait.php';
                include 'src/DataProviders/WPPostsProvider.php';
                include 'src/DataProviders/CsvProvider.php';
                $wpPostProvider = new \NinjaTablesPro\DataProviders\WPPostsProvider();
                $csvProvider = new \NinjaTablesPro\DataProviders\CsvProvider();
                $wpPostProvider->boot();
                $csvProvider->boot();
            }
        }

	}

	/**
	 * Plugin init hook
	 */
	add_action( 'init', function () {
		$ninjaTableBoot = new \NinjaTablesPro();
		$ninjaTableBoot->boot();
	});
}
