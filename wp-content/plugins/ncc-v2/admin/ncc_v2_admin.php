<?php
/**
 * SHORT CLASS DESCRIPTION
 *
 * @package PROJECT NAME
 * @author dbroadaw
 * @version $Id$
 */
 class ncc_v2_admin{

    public function __construct(){
        add_action('admin_menu', array($this, 'ncc_v2_admin_menu'));
        add_action('admin_init', array($this, 'ncc_v2_admin_init'));
        include_once('ncc_v2_wp_settings_builder.php');
    }

    public function ncc_v2_admin_menu()
    {
        ncc_v2_wp_settings_builder::ncc_v2_wp_settings_builder_add_pages(ncc_v2_wp_settings_builder_source_data::menus());
    }

    public function ncc_v2_admin_menu_page()
    {
        include_once ( 'ncc_v2_admin_helper.php' );

        ncc_v2_admin_helper::ncc_v2_admin_helper_check_post();

    }

     public function ncc_v2_admin_init()
     {

         ncc_v2_wp_settings_builder::ncc_v2_wp_settings_builder_add_sections(ncc_v2_wp_settings_builder_source_data::sections());
         ncc_v2_wp_settings_builder::ncc_v2_wp_settings_builder_add_fields(ncc_v2_wp_settings_builder_source_data::fields());
     }

     public function ncc_v2_admin_create_option_select_service_section_callback()
     {
         $html = '';
         $html .= 'Please select which API you will be integrating.';
         echo $html;
     }
     public function ncc_v2_admin_create_option_select_api_twitter_callback( $args )
     {
         $api = get_option('ncc_v2_available_apis');

         var_dump($api);

         $html = '';
         $html .= '<input type="checkbox" name="' . $args['optionGroup'] . '[api][]" id="' . $args['slug'] . '" value="' . $args['slug'] . '" />';
     }

     public function ncc_v2_admin_create_option_select_api_flickr_callback( $args )
     {
         $args['values'] = array(
             'apiID'        => 2,
             'apiName'      =>'Flickr'
         );

         ncc_v2_wp_settings_builder::ncc_v2_wp_settings_builder_radio($args);
     }

     public function ncc_v2_admin_create_option_select_api_lastfm_callback( $args )
     {
         $args['values'] = array(
             'apiID'        => 3,
             'apiName'      =>'last.fm'
         );

         ncc_v2_wp_settings_builder::ncc_v2_wp_settings_builder_radio($args);
     }
}

$ncc_v2_admin = new ncc_v2_admin();