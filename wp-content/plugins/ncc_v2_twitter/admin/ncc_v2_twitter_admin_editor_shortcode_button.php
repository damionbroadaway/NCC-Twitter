<?php
class ncc_v2_twitter_admin_editor_shortcode_button
{
    public static function init(){
        add_filter('mce_external_plugins', array('ncc_v2_twitter_admin_editor_shortcode_button','callback'));
        add_filter('mce_buttons', array('ncc_v2_twitter_admin_editor_shortcode_button','add_button'));
    }

    public static function callback($plugin_array)
    {
        $plugin_array['ncc_v2_twitter_admin_editor_shortcode_button'] = NCC_V2_TWITTER_PLUGIN_URL . '/inc/ncc_v2_twitter_admin_editor_shortcode_button.js';
        return $plugin_array;
    }
    public static function add_button($buttons)
    {
        $buttons[] = 'ncc_v2_twitter_admin_editor_shortcode_button';
        return $buttons;
    }
}