<?php
/**
* ncc_v2_admin_settings_section_callbacks.php
*
* Description: 
*
* @author dbroadaw / 
*/
class ncc_v2_twitter_admin_settings_section_callbacks
{
    public static function oAuth()
    {
        $html = '';
        $html .= 'This is the oAuth section.';

        echo $html;
    }

    public static function account()
    {
        $html = '';
        $html .= 'This is the account section.';

        echo $html;
    }

    public static function cache()
    {
        $html = '';
        $html .= 'This is the cache section.';

        echo $html;
    }
}