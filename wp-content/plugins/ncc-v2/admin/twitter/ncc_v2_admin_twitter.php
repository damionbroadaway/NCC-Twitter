<?php
/**
* ncc_v2_admin_twitter.php
*
* Description: 
*
* @author dbroadaw / 
*/
class ncc_v2_admin_twitter
{
    function __construct()
    {
        self::ncc_v2_admin_twitter_init();
    }

    public static function ncc_v2_admin_twitter_init()
    {
        include_once ( 'ncc_v2_wp_settings_builder_source_data_twitter.php' );
        ncc_v2_wp_settings_builder::ncc_v2_wp_settings_builder_add_sections(ncc_v2_wp_settings_builder_source_data_twitter::sections());
    }

    public function ncc_v2_admin_twitter_section_callback()
    {
        $html = '';
        $html .= 'Here be your Twitter settings. Set them.';

        echo $html;
    }

}

$ncc_v2_admin_twitter = new ncc_v2_admin_twitter();
