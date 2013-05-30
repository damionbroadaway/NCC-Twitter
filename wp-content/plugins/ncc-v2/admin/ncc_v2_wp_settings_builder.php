<?php

include_once ( 'ncc_v2_wp_settings_builder_source_data.php' );

class ncc_v2_wp_settings_builder
{
    function __construct()
    {

    }

    /**
     * @param $args
     */
    public static function ncc_v2_wp_settings_builder_add_pages($args)
    {
        foreach($args as $value)
        {
            add_menu_page(
                $value['pageTitle'],
                $value['menuTitle'],
                $value['cap'],
                $value['slug'],
                array(
                    $value['callbackClass'],
                    $value['callbackMethod']
                )
            );
        }
    }

    public static function ncc_v2_wp_settings_builder_add_sub_pages($args)
    {
        foreach ($args as $value) {
            add_submenu_page(
                $value['parentSlug'],
                $value['pageTitle'],
                $value['menuTitle'],
                $value['cap'],
                $value['menuSlug'],
                array(
                    $value['callbackClass'],
                    $value['callbackMethod']
                )
            );
        }

    }

    public static function ncc_v2_wp_settings_builder_add_sections( $args = array() )
    {
        foreach ( $args as $value )
        {
            add_settings_section(
                $value['slug'],
                $value['title'],
                array(
                    $value['callbackClass'],
                    $value['callbackMethod']
                ),
                $value['optionGroup']
            );
        }
    }
    public static function ncc_v2_wp_settings_builder_add_fields( $args )
    {
        foreach ( $args as $value ) {
            add_settings_field(
                $value['slug'],
                $value['title'],
                array(
                    $value['callbackClass'],
                    $value['callbackMethod']
                ),
                $value['optionGroup'],
                $value['section'],
                $value
            );
            register_setting(
                $value['optionGroup'],
                $value['slug']
            );
        }

    }
    public static function ncc_v2_wp_settings_builder_dropdown ( $args, $values )
    {
        $drop = '';
        $drop .= '<select name="' . $args['optionGroup'] . '[' . $args['slug'] . ']" id="' . $args['slug'] . '">';
        $drop .= '<option value="">Please Select...</option>';
        foreach ($values as $dropValues) {
            $drop .= '<option value="' . $dropValues['id'] . '">' . $dropValues['name'] . '</option>';
        }
        $drop .= '</select>';

        return $drop;

    }

    public static function ncc_v2_wp_settings_builder_radio ( $args )
    {
        $html = '';
        $html .= '<input type="checkbox" name="' . $args['optionGroup'] . '[' . $args['slug'] . ']" id="' . $args['slug'] . '" />';

        echo $html;
    }

    public static function ncc_v2_up_settings_builder_add_option( $args )
    {

            if ( !get_option( NCC_V2_OPTION_GROUP ) )
            {
                update_option( NCC_V2_OPTION_GROUP, $args['values'] );
            }


    }
}