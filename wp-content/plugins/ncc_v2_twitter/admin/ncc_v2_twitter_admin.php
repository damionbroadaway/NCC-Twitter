<?php
/**
* ncc_v2_twitter_admin.php
*
* Description: 
*
* @author dbroadaw / 
*/
class ncc_v2_twitter_admin
{
    function __construct()
    {
        $this->ncc_v2_twitter_admin_includes();
        add_action('init', array($this, 'ncc_v2_twitter_admin_add_cpt'));
        add_action('admin_init', array($this, 'ncc_v2_twitter_admin_add_settings'));
        add_action('admin_init', array($this, 'ncc_v2_twitter_admin_add_styles'));
        add_action('admin_menu', array($this, 'ncc_v2_twitter_admin_add_menu'));
    }

    public function ncc_v2_twitter_admin_includes()
    {
        include_once ( 'ncc_v2_twitter_admin_helper.php' );
        include_once ( 'ncc_v2_twitter_admin_settings_section_callbacks.php' );
        include_once ( 'ncc_v2_twitter_admin_settings_field_callbacks.php' );
    }

    public function ncc_v2_twitter_admin_add_cpt()
    {
        ncc_v2_twitter_settings_builder::ncc_v2_twitter_settings_builder_add_cpt('tweet', ncc_v2_twitter_admin_settings_data::cpt());
    }

    public function ncc_v2_twitter_admin_add_menu()
    {
        ncc_v2_twitter_settings_builder::ncc_v2_twitter_settings_builder_add_sub_pages(ncc_v2_twitter_admin_settings_data::menu());
    }

    public function ncc_v2_twitter_admin_add_settings()
    {
        ncc_v2_twitter_settings_builder::ncc_v2_twitter_settings_builder_add_sections(ncc_v2_twitter_admin_settings_data::section());
        ncc_v2_twitter_settings_builder::ncc_v2_twitter_settings_builder_add_fields(ncc_v2_twitter_admin_settings_data::fields());
    }

    public function ncc_v2_twitter_admin_add_styles()
    {
        wp_enqueue_style('ncc_v2_twitter_admin', NCC_V2_TWITTER_PLUGIN_URL . 'inc/ncc_v2_twitter_admin.css');
    }

    public function ncc_v2_twitter_admin_page_callback()
    {
        ncc_v2_twitter_admin_helper::render_page();
    }


}

$ncc_v2_twitter_admin = new ncc_v2_twitter_admin();
