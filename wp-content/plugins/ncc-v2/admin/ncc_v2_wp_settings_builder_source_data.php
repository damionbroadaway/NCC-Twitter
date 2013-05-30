<?php
/**
* ncc_v2_wp_seetings_builder_source_data.php
*
* Description: 
*
* @author dbroadaw / 
*/
class ncc_v2_wp_settings_builder_source_data
{

    public static function menus()
    {
        $newMenu = array(
            array(
                'pageTitle'         => 'Nerdery Code Challenge v2.0',
                'menuTitle'         => 'NCC Options',
                'cap'               => 'administrator',
                'slug'              => 'ncc_v2_admin_options',
                'callbackClass'     => 'ncc_v2_admin',
                'callbackMethod'    => 'ncc_v2_admin_menu_page'
            )
        );

        return $newMenu;
    }

    public static function sections()
    {
        $newSections = array(
            array(
                'slug'             => 'ncc_v2_admin_options_section_api',
                'title'            => 'API Selection',
                'callbackClass'    => 'ncc_v2_admin',
                'callbackMethod'   => 'ncc_v2_admin_create_option_select_service_section_callback',
                'optionGroup'      => 'ncc_v2_admin_options'
            )
        );

        return $newSections;
    }

    /**
     * @return array
     */
    public static function fields()
    {
        $newFields = array(
            array(
                'slug'              =>'ncc_v2_admin_options_twitter',
                'title'             =>'Twitter',
                'callbackClass'     =>'ncc_v2_admin',
                'callbackMethod'    =>'ncc_v2_admin_create_option_select_api_twitter_callback',
                'optionGroup'       =>'ncc_v2_admin_options',
                'section'           =>'ncc_v2_admin_options_section_api'
            ),
            array(
                'slug'              =>'ncc_v2_admin_options_flickr',
                'title'             =>'Flickr',
                'callbackClass'     =>'ncc_v2_admin',
                'callbackMethod'    =>'ncc_v2_admin_create_option_select_api_flickr_callback',
                'optionGroup'       =>'ncc_v2_admin_options',
                'section'           =>'ncc_v2_admin_options_section_api'
            ),
            array(
                'slug'              =>'ncc_v2_admin_options_lastfm',
                'title'             =>'last.fm',
                'callbackClass'     =>'ncc_v2_admin',
                'callbackMethod'    =>'ncc_v2_admin_create_option_select_api_lastfm_callback',
                'optionGroup'       =>'ncc_v2_admin_options',
                'section'           =>'ncc_v2_admin_options_section_api'
            )
        );

        return $newFields;
    }

    public static function page()
    {
        $renderPage = array(
            'settingsFields'                            => 'ncc_v2_admin_options',
            'settingsSections'                          => 'ncc_v2_admin_options',
            'ncc_v2_admin_which_settings_helper_value'  => 'api',
            'submitText'                                => 'Save API Selection &amp; Continue'
        );

        return $renderPage;
    }

}
