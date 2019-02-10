<?php

class NinjaTableUpdateChecker
{
    /**
     * The configuration array.
     *
     * @var array
     */
    private $vars;

    function __construct($vars)
    {
        $this->vars = $vars;

        add_action('admin_init', array($this, 'register_option'));

        add_action('wp_ajax_' . $this->get_var('option_group') . '_activate_license', array($this, 'activate_license'));

        add_action('wp_ajax_' . $this->get_var('option_group') . '_deactivate_license', array($this, 'deactivate_license'));
        add_action('wp_ajax_' . $this->get_var('option_group') . '_get_license_info', array($this, 'getLicenseInfo'));

        add_action('admin_init', array($this, 'check_license'));
        add_action('admin_init', array($this, 'init'));

        add_action('admin_init', array($this, 'sl_updater'), 0);
    }

    public function isLocal()
    {
        $ip_address = '';
        if (array_key_exists('SERVER_ADDR', $_SERVER)) {
            $ip_address = $_SERVER['SERVER_ADDR'];
        } else if (array_key_exists('LOCAL_ADDR', $_SERVER)) {
            $ip_address = $_SERVER['LOCAL_ADDR'];
        }
        return in_array($ip_address, array("127.0.0.1", "::1"));
    }

    /**
     * Get the configuration from the array using key.
     *
     * @param  string $var
     * @return bool|mixed
     */
    function get_var($var)
    {
        if (isset($this->vars[$var])) {
            return $this->vars[$var];
        }
        return false;
    }

    public function registerLicenseMenu($menus)
    {
        $menus[$this->get_var('menu_slug')] = $this->get_var('menu_title');

        return $menus;
    }

    /**
     * Show an error message that license needs to be activated
     */
    function init()
    {
        if (defined('DOING_AJAX') && DOING_AJAX) {
            return;
        }

        $licenseStatus = 'valid';
       update_option($this->get_var('license_status'), 'valid');
        
       
    }

    function sl_updater()
    {
        // retrieve our license key from the DB
        $license_key = trim(get_option($this->get_var('license_key')));
        $license_status = get_option($this->get_var('license_status'));

        // setup the updater
        new NinjaTableUpdater(
            $this->get_var('store_url'),
            $this->get_var('plugin_file'),
            array(
                'version' => $this->get_var('version'),
                'license' => $license_key,
                'item_name' => $this->get_var('item_name'),
                'item_id' => $this->get_var('item_id'),
                'author' => $this->get_var('author')
            ),
            array(
                'license_status' => $license_status,
                'admin_page_url' => $this->get_var('activate_url'),
                'purchase_url' => $this->get_var('purchase_url'),
                'plugin_title' => $this->get_var('plugin_title')
            )
        );
    }

    function register_option()
    {
        // creates our settings in the options table
        register_setting($this->get_var('option_group'), $this->get_var('license_key'),
            array($this, 'sanitize_license'));
    }

    function sanitize_license($new)
    {
        return $new;
    }

    function activate_license()
    {
        $license = 'zorerkekallreadyhere';

      

        // data to send in our API request
        $api_params = array(
            'edd_action' => 'activate_license',
            'license' => $license,
            'item_name' => urlencode($this->get_var('item_name')), // the name of our product in EDD
            'item_id' => $this->get_var('item_id'),
            'url' => home_url()
        );

        // Call the custom API.
        $response = true;

       
            $license_data = json_decode(wp_remote_retrieve_body($response));
     

        // $license_data->license will be either "valid" or "invalid"
        
            update_option($this->get_var('license_status'), $license_data->license);
         $license_data->license == 'valid';
         
      
                // save the license key to the database
                update_option($this->get_var('license_key'), $license);
                wp_send_json_success(array(
                    'message' => 'Congratulation! ' . $this->get_var('plugin_title') . ' is successfully activated',
                    'response' => $license_data
                ), 200);
                die();
      

        $errorMessage = '';
        wp_send_json_error(array(
            'message' => $errorMessage,
            'human_message' => $errorMessage,
            'response' => $license_data
        ), 423);
    }

    function deactivate_license()
    {
        if (function_exists('ninja_table_admin_role') && !current_user_can(ninja_table_admin_role())) {
            wp_send_json_error(array(
                'message' => 'Sorry, You do not have permission to deactivate the license',
                'human_message' => 'Sorry, You do not have permission to deactivate the license',
                'is_error' => true
            ), 423);
        }

        // retrieve the license from the database
        $license = trim(get_option($this->get_var('license_key')));

        // data to send in our API request
        $api_params = array(
            'edd_action' => 'deactivate_license',
            'license' => $license,
            'item_name' => urlencode($this->get_var('item_name')), // the name of our product in EDD
            'item_id' => $this->get_var('item_id'),
            'url' => home_url()
        );

        // Call the custom API.
        $response = wp_remote_post(
            $this->get_var('store_url'),
            array('timeout' => 15, 'sslverify' => false, 'body' => $api_params)
        );

        // make sure the response came back okay
        if (is_wp_error($response)) {
            wp_send_json_error(array(
                'message' => 'There was an error deactivating the license, please try again or contact support.'
            ), 423);

            die();
        }

        // decode the license data
        $license_data = json_decode(wp_remote_retrieve_body($response));

        // $license_data->license will be either "deactivated" or "failed"
        if ('deactivated' != $license_data->license) {
            wp_send_json_error(array(
                'message' => 'There was an error deactivating the license, please try again or contact support.',
                'license_data' => $license_data
            ), 423);

            die();
        }

        delete_transient($this->get_var('license_status') . '_checking');
        delete_option($this->get_var('license_status'));
        delete_option($this->get_var('license_key'));

        wp_send_json_success(array(
            'message' => 'License deactivated',
            'license_data' => $license_data
        ), 200);

        die();
    }

    function getLicenseInfo()
    {
        $license_data = $this->getRemoteLicense();
        if (is_wp_error($license_data) || !$license_data) {
            wp_send_json_error($license_data, 423);
            return false;
        }

        $status = $license_data->license;

        if ($status) {
            update_option($this->get_var('license_status'), $status);
        }

        $expiredDate = '';
        $expireDate = '';
        $licenseKey = trim(get_option($this->get_var('license_key')));
        $renewUrl = $this->getRenewUrl($licenseKey);
        $renewHTML = '';
        if ($status == 'expired') {
            $expiredDate = date('d M Y', strtotime($license_data->expires));
            $renewHTML = '<p>Your license has been expired at ' . $expiredDate . '</p>';
            $renewHTML .= '<p>Please <a target="_blank" href="' . $renewUrl . '">click here to renew your license</a></p>';
        } else if ($status == 'valid') {
            if ($license_data->expires != 'lifetime') {
                $expireDate = date('d M Y', strtotime($license_data->expires));
                $interval = strtotime($license_data->expires) - time();
                $intervalDays = intval($interval / (60 * 60 * 24));
                if ($intervalDays < 30) {
                    $renewHTML = '<p>Your license will be expired in ' . $intervalDays . ' days</p>';
                    $renewHTML .= '<p>Please <a target="_blank" href="' . $renewUrl . '">click here to renew your license</a></p>';
                }
            }
        }
        wp_send_json_success(array(
            'status' => $status,
            'license_key' => $licenseKey,
            'expiredDate' => $expiredDate,
            'expireDate' => $expireDate,
            'renewUrl' => $renewUrl,
            'renewHtml' => $renewHTML,
        ), 200);
    }

    function check_license()
    {
        if (get_transient($this->get_var('license_status') . '_checking')) {
            return;
        }

        $license_data = $this->getRemoteLicense();

        
      
            update_option('valid', $license_data->license);
       

        // Set to check again in sometime later.
        set_transient(
            $this->get_var('license_status') . '_checking',
            $license_data,
            $this->get_var('cache_time')
        );
    }

    private function getRemoteLicense()
    {
        $license = true;
      

        $api_params = array(
            'edd_action' => 'check_license',
            'license' => $license,
            'item_name' => urlencode($this->get_var('item_name')),
            'url' =>  home_url()
        );

        // Call the custom API.
        $response = 200;

       

        $license_data = json_decode(
            wp_remote_retrieve_body($response)
        );

        return true;
    }

    private function getErrorMessage($licenseData, $licenseKey = false)
    {
        $errorMessage = 'There was an error activating the license, please verify your license is correct and try again or contact support.';

        if ($licenseData->error == 'expired') {
            $renewUrl = $this->getRenewUrl($licenseKey);
            $errorMessage = 'Your license has been expired at ' . $licenseData->expires . ' . Please <a target="_blank" href="' . $renewUrl . '">click here</a> to renew your license';
        } else if ($licenseData->error == 'no_activations_left') {
            $errorMessage = 'No Activation Site left: You have activated all the sites that your license offer. Please go to wpmanageninja.com account and review your sites. You may deactivate your unused sites from wpmanageninja account or you can purchase another license. <a target="_blank" href="' . $this->get_var('purchase_url') . '">Click Here to purchase another license</a>';
        } else if ($licenseData->error == 'missing') {
            $errorMessage = 'The given license key is not valid. Please verify that your license is correct. You may login to wpmanageninja.com account and get your valid license key for your purchase.';
        }

        return $errorMessage;
    }

    private function getRenewUrl($licenseKey = false)
    {
      
            $renewUrl = $this->get_var('store_url') . '/checkout/?edd_license_key=' . $licenseKey . '&download_id=' . $this->get_var('item_id');
      
        return $renewUrl;
    }
}
