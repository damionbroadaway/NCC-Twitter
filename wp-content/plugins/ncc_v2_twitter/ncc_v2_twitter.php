<?php
/*
Plugin Name:    Nerdery Code Challenge v2.0 - Twitter
Plugin URI:     http://nerdpress.nerderylaps.com
Description:    Connect to the Twitter API to test applicant's WP development prowess.
Version:        1.0
Author:         Damion M Broadaway <dbroadaw@nerdery.com>
Author URI:     http://goo.gl/31tMc
License:        GPL2
*/

/**
 * Description: Checks for proper WorPress version on Plugins page.
 */
if ( ! empty ( $GLOBALS['pagenow'] ) && 'plugins.php' === $GLOBALS['pagenow'] )
    add_action( 'admin_notices', array('ncc_v2_twitter_bootstrap', 'ncc_v2_twitter_activate_wp_version_check'));

/**
 * Description: Calls WP activation and deactivation hooks
 */
register_activation_hook(__FILE__, array('ncc_v2_twitter_bootstrap', 'ncc_v2_twitter_activate'));
register_deactivation_hook(__FILE__, array('ncc_v2_twitter_bootstrap', 'ncc_v2_twitter_deactivate'));

    /**
     * Description: Bootsrap for Plugin. Loads data, settings, admin logic, & shortcode.
     *
     * Class ncc_v2_twitter_bootstrap
     */
    class ncc_v2_twitter_bootstrap
{

    function __construct()
    {
        define('NCC_V2_TWITTER_PLUGIN_URL', plugin_dir_url(__FILE__));
        define('NCC_V2_TWITTER_PUGLIN_BASE', plugin_basename(__FILE__));
        define('NCC_V2_TWITTER_PUGLIN_PATH', plugin_dir_path(__FILE__));
        define('NCC_TWITTER_TITLE', 'Nerdery Code Challenge v2.0');
        define('NCC_V2_TWITTER_OPTION_GROUP', 'ncc_v2_twitter_admin_options');
        self::ncc_v2_twitter_admin();
        self::ncc_v2_twitter_init();
        self::ncc_v2_twitter_shortcode();
    }

    /**
     * Description: Includes admin files if in the Dashboard
     *
     */
    public function ncc_v2_twitter_admin()
    {
        if ( is_admin() )
        {
            include_once('admin/ncc_v2_twitter_admin.php');
        }
    }

    /**
     * Description: Includes settings, data, and front-end display.
     *
     */
    public function ncc_v2_twitter_init()
    {
        include_once ( 'ncc_v2_twitter_tweets.php' );
        include_once ( 'admin/ncc_v2_twitter_admin_settings_data.php' );
        include_once ( 'admin/ncc_v2_twitter_admin_settings_builder.php' );
    }

    /**
     * Description: If no settings found - adds empty settings.
     *
     */
    public function ncc_v2_twitter_activate()
    {
        if ( !get_option( NCC_V2_TWITTER_OPTION_GROUP ) )
        {
            $ncc_v2_twitter_options = array(
                'ncc_v2_twitter_admin_options_oauth_consumer_key'           => '',
                'ncc_v2_twitter_admin_options_oauth_consumer_secret'        => '',
                'ncc_v2_twitter_admin_options_oauth_access_token'           => '',
                'ncc_v2_twitter_admin_options_oauth_access_token_secret'    => '',
                'ncc_v2_twitter_admin_options_account_twitter_user'         => '',
                'ncc_v2_twitter_admin_options_cache_duration'               => ''
            );

            update_option(NCC_V2_TWITTER_OPTION_GROUP, $ncc_v2_twitter_options);
        }
    }

    public function ncc_v2_twitter_deactivate()
    {

    }

    /**
     * Description: Version check for WordPress.
     *
     */
    public function ncc_v2_twitter_activate_wp_version_check()
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

            deactivate_plugins(NCC_V2_TWITTER_PUGLIN_BASE);

        }
    }

    /**
     * Description: Add shortcode.
     *
     */
    public function ncc_v2_twitter_shortcode()
    {
        add_shortcode('tweets', array('ncc_v2_twitter_tweets','ncc_v2_twitter_tweets_show'));
    }

}

$ncc_v2_twitter_bootstrap = new ncc_v2_twitter_bootstrap();

    /**
     * Description: Template tag to show Tweets.
     *
     */
function show_tweets()
{
    $ncc_v2_twitter_tweets = new ncc_v2_twitter_tweets();
    $ncc_v2_twitter_tweets->ncc_v2_twitter_tweets_show();
}