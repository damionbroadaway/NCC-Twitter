<?php

/*
Plugin Name:    Nerdery Code Challenge v2.0
Plugin URI:     http://nerdpress.nerderylaps.com
Description:    Connect to an API to test applicant's WP development prowess.
Version:        1.0
Author:         Damion M Broadaway <dbroadaw@nerdery.com>
Author URI:     http://goo.gl/31tMc
License:        GPL2
*/


/**
 * Check for proper WordPress Version
 */
if ( ! empty ( $GLOBALS['pagenow'] ) && 'plugins.php' === $GLOBALS['pagenow'] )
    add_action( 'admin_notices', array('ncc_v2_bootstrap', 'ncc_v2_activate_wp_version_check'));

/**
 * WordPress Plugin Activation/Deactivation Hooks
 */
register_activation_hook(__FILE__, array('ncc_v2_bootstrap', 'ncc_v2_activate'));
register_deactivation_hook(__FILE__, array('ncc_v2_bootstrap', 'ncc_v2_deactivate'));

/**
 * Class ncc_v2_bootstrap
 */

class ncc_v2_bootstrap
{
    function __construct()
    {
        define('NCC_V2_PLUGIN_URL', plugin_dir_url(__FILE__));
        define('NCC_V2_PUGLIN_BASE', plugin_basename(__FILE__));
        define('NCC_TITLE', 'Nerdery Code Challenge v2.0');
        define('NCC_V2_OPTION_GROUP', 'ncc_v2_admin_options');
        self::ncc_v2_admin();
    }

    public function ncc_v2_admin()
    {
        if ( is_admin() )
        {
            include_once('admin/ncc_v2_admin.php');
        }
    }

    public function ncc_v2_activate()
    {
        $availableAPIs = array(
            'values'        => array('ncc_v2_available_apis' =>
                                    array(
                                        'name'  => 'Twitter',
                                        'id'    => 1
                                    ),
                                    array(
                                        'name'  => 'Flickr',
                                        'id'    => 2
                                    ),
                                    array(
                                        'name'  => 'last.fm',
                                        'id'    => 3
                                    )
            )
        );
        include_once ( 'admin/ncc_v2_wp_settings_builder.php' );
        ncc_v2_wp_settings_builder::ncc_v2_up_settings_builder_add_option($availableAPIs);
    }

    public function ncc_v2_activate_wp_version_check()
    {
        $currentVersion = get_bloginfo('version');
        $desiredVersion = '3.5.1';

        if ( version_compare( $currentVersion , $desiredVersion, '<' ) )
        {
            $errorHtml = '';
            $errorHtml .= '<div class="error">';
            $errorHtml .= '<p><strong>I just don\'t know what went wrong.</strong>';
            $errorHtml .= '<p>Oh wait. Yes I do. Your WordPress install is out of date at version. Please upgrade to continue.</p>';
            $errorHtml .= '</div>';

            $hackIsHacky = '';
            $hackIsHacky .= '<style type="text/css">div.updated{display: none;}</style>';

            echo $errorHtml;
            echo $hackIsHacky;

            deactivate_plugins(NCC_V2_PUGLIN_BASE);

        }
    }

    public function ncc_v2_deactivate()
    {

    }
}

$ncc_v2_bootstrap = new ncc_v2_bootstrap();
