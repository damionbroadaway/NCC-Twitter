<?php
/**
* ncc_v2_wp_settings_builder_source_data_twitter.php
*
* Description: 
*
* @author dbroadaw / 
*/

class ncc_v2_wp_settings_builder_source_data_twitter
{
    public static function sections()
    {
        $newSection = array(
            array(
                'slug'             => 'ncc_v2_admin_options_section_twitter',
                'title'            => 'Twitter Settings',
                'callbackClass'    => 'ncc_v2_admin_twitter',
                'callbackMethod'   => 'ncc_v2_admin_twitter_section_callback',
                'optionGroup'      => 'ncc_v2_admin_options'
            )
        );

        return $newSection;
    }

    public static function field()
    {

    }

    public static function page()
    {
        $renderPage = array(
            'settingsFields'                            => 'ncc_v2_admin_options',
            'settingsSections'                          => 'ncc_v2_admin_options',
            'ncc_v2_admin_which_settings_helper_value'  => 'twitter',
            'submitText'                                => 'Save Twitter Settings'
        );

        return $renderPage;
    }
}
