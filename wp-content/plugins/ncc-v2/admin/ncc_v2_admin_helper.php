<?php
/**
 * ncc_v2_admin_helper.php
 *
 * Description:
 *
 * @author dbroadaw /
 */
class ncc_v2_admin_helper
{

    public static function ncc_v2_admin_helper_check_post()
    {

        if (isset($_POST['submit']))
        {
            self::ncc_v2_admin_helper_save_options ($_POST );
        } elseif (isset($_POST['switchAPI']))
        {
            self::ncc_v2_admin_helper_switch_api();
        }

        if ( self::ncc_v2_admin_helper_api_check() )
        {
            $settingsScreen = self::ncc_v2_admin_helper_api_check();

            switch ($settingsScreen){

                case ($settingsScreen == 1):
                    include_once ( 'twitter/ncc_v2_admin_twitter.php' );
                    self::ncc_v2_admin_helper_render_page(ncc_v2_wp_settings_builder_source_data_twitter::page());
                    break;

                case ($settingsScreen == 2):
                    echo 'shit works, man';
                    break;

                case ($settingsScreen == 3):
                    echo 'shit works, man';
                    break;

                default:
                    throw new Exception( 'No API selection saved.' );
                    break;
            }
        } else
        {
            self::ncc_v2_admin_helper_render_page(ncc_v2_wp_settings_builder_source_data::page());
        }
    }

    public static function ncc_v2_admin_helper_render_page( $args )
    {

        self::ncc_v2_admin_helper_show_header();

        var_dump($_POST);

        echo '<form method="post">';

        settings_errors();

        settings_fields( $args['settingsFields'] );
        do_settings_sections( $args['settingsSections'] );

        submit_button($args['submitText']);
        submit_button('Switch APIs', 'secondary', 'switchAPI');

        echo '</form>';

    }

    public static function ncc_v2_admin_helper_show_header()
    {
        $header = '';
        $header .= '<div class="wrap">';
        $header .= '<div id="icon-themes" class="icon32"></div>';
        $header .= '<h2>' . NCC_TITLE . '</h2>';
        $header .= '</div>';

        echo $header;
    }


    public static function ncc_v2_admin_helper_api_check()
    {
        if ( get_option(NCC_V2_OPTION_GROUP) )
        {
            $apiID = get_option(NCC_V2_OPTION_GROUP);
            $apiID = $apiID['ncc_v2_admin_options_api'];

            return $apiID;
        }else
        {
            return false;
        }
    }

    public static function ncc_v2_admin_helper_save_options( $args )
    {
        $apiName = $args['ncc_v2_admin_which_settings_helper'];


        switch($apiName)
        {
            case ( $apiName == 'api' ):

                $optionName = 'ncc_v2_admin_options_api';
                $apiID = $args[NCC_V2_OPTION_GROUP][$optionName];

                $optionData = array(
                    'values'    => array(
                                    $optionName => $apiID
                    )
                );

                ncc_v2_wp_settings_builder::ncc_v2_up_settings_builder_add_option( $optionData );

                break;
            case ( $apiName == 'twitter' ):
                break;
            case ( $apiName == 'flickr' ):
                break;
            case ( $apiName == 'lastfm' ):
                break;
            default:
                break;
        }

    }
    //TODO: try and find a way to just delete or update the api field only
    public static function ncc_v2_admin_helper_switch_api()
    {
        if (get_option(NCC_V2_OPTION_GROUP))
        {
            $nullNotDelete = array(
                'ncc_v2_admin_options_api'  => null
            );
            ncc_v2_wp_settings_builder::ncc_v2_up_settings_builder_add_option($nullNotDelete);
            delete_option(NCC_V2_OPTION_GROUP);
        }
    }

}
