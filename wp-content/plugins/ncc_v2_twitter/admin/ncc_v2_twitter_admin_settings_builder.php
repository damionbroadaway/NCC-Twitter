<?php

class ncc_v2_twitter_settings_builder
{
    function __construct()
    {

    }

    public static function ncc_v2_twitter_settings_builder_add_cpt($name, $args)
    {
        register_post_type($name, $args);
    }
    /**
     * @param $args
     */
    public static function ncc_v2_twitter_settings_builder_add_pages($args)
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

    public static function ncc_v2_twitter_settings_builder_add_sub_pages($args)
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

    public static function ncc_v2_twitter_settings_builder_add_sections( $args = array() )
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
    public static function ncc_v2_twitter_settings_builder_add_fields( $args )
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

    public static function ncc_v2_twitter_settings_builder_add_text_field( $args )
    {
        $html = '';
        $option = get_option(NCC_V2_TWITTER_OPTION_GROUP);
        if (isset($option[$args['slug']]))
        {
            $option = $option[$args['slug']];
        } else{
            $option = '';
        }

        if ( $option != '' )
        {
            $html .= '<input class="' . $args['class'] . '" type="text" name="' . NCC_V2_TWITTER_OPTION_GROUP . '[' . $args['slug'] . ']" id="' . $args['slug'] . '" value="' . $option . '" />';
        } else
        {
            $html .= '<input class="' . $args['class'] . '" type="text" name="' . NCC_V2_TWITTER_OPTION_GROUP . '[' . $args['slug'] . ']" id="' . $args['slug'] . '" />';
        }

        $html .= '<p class="description">' . $args['desc'] . '</p>';

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