<?php
    /**
     * Description: Loads all admin functionality.
     *
     * Class:       ncc_v2_twitter_admin
     */
class ncc_v2_twitter_admin
{
    /**
     *  Class construct sets includes, adds settings pages and data.
     */
    function __construct()
    {
        $this->ncc_v2_twitter_admin_includes();
        add_action('admin_init', array($this, 'ncc_v2_twitter_admin_add_settings'));
        add_action('admin_init', array($this, 'ncc_v2_twitter_admin_add_styles'));
        add_action('admin_menu', array($this, 'ncc_v2_twitter_admin_add_menu'));
        ncc_v2_twitter_admin_editor_shortcode_button::init();
    }

    /**
     * Description:  Includes files required for admin functionality.
     * Function:     ncc_v2_twitter_admin_includes
     *
     */
    public function ncc_v2_twitter_admin_includes()
    {
        include_once ( 'ncc_v2_twitter_admin_helper.php' );
        include_once ( 'ncc_v2_twitter_admin_settings_section_callbacks.php' );
        include_once ( 'ncc_v2_twitter_admin_settings_field_callbacks.php' );
        include_once ( 'ncc_v2_twitter_admin_editor_shortcode_button.php');
    }

    /**
     * Description:  Adds menu item to Dashboard.
     * Function:     ncc_v2_twitter_admin_add_menu
     *
     */
    public function ncc_v2_twitter_admin_add_menu()
    {
        ncc_v2_twitter_settings_builder::ncc_v2_twitter_settings_builder_add_sub_pages(ncc_v2_twitter_admin_settings_data::menu());
    }

    /**
     * Description:  Adds settings fields and sections.
     * Function:     ncc_v2_twitter_admin_add_settings
     *
     */
    public function ncc_v2_twitter_admin_add_settings()
    {
        ncc_v2_twitter_settings_builder::ncc_v2_twitter_settings_builder_add_sections(ncc_v2_twitter_admin_settings_data::section());
        ncc_v2_twitter_settings_builder::ncc_v2_twitter_settings_builder_add_fields(ncc_v2_twitter_admin_settings_data::fields());
    }

    /**
     * Description:  Includes CSS for admin.
     * Function:     ncc_v2_twitter_admin_add_styles
     *
     */
    public function ncc_v2_twitter_admin_add_styles()
    {
        wp_enqueue_style('ncc_v2_twitter_admin', NCC_V2_TWITTER_PLUGIN_URL . 'inc/ncc_v2_twitter_admin.css');
    }

    /**
     * Description:  Renders settings page.
     * Function:     ncc_v2_twitter_admin_page_callback
     *
     */
    public function ncc_v2_twitter_admin_page_callback()
    {
        ncc_v2_twitter_admin_helper::render_page();
    }
}

    /**
     * Instatiate class.
     */
$ncc_v2_twitter_admin = new ncc_v2_twitter_admin();
