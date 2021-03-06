<?php
    /**
     * Description: Callbacks for settings fields.
     *
     * Class:       ncc_v2_twitter_admin_settings_field_callbacks
     */
class ncc_v2_twitter_admin_settings_field_callbacks
{
    public static function oAuth_consumer_key( $args )
    {
        ncc_v2_twitter_settings_builder::ncc_v2_twitter_settings_builder_add_text_field($args);
    }
    public static function oAuth_consumer_secret( $args )
    {
        ncc_v2_twitter_settings_builder::ncc_v2_twitter_settings_builder_add_text_field($args);
    }
    public static function oAuth_access_token( $args )
    {
        ncc_v2_twitter_settings_builder::ncc_v2_twitter_settings_builder_add_text_field($args);
    }
    public static function oAuth_access_token_secret( $args )
    {
        ncc_v2_twitter_settings_builder::ncc_v2_twitter_settings_builder_add_text_field($args);
    }
    public static function account_twitter_user( $args )
    {
        ncc_v2_twitter_settings_builder::ncc_v2_twitter_settings_builder_add_text_field($args);
    }
    public static function cache_duration( $args )
    {
        ncc_v2_twitter_settings_builder::ncc_v2_twitter_settings_builder_add_text_field($args);
    }

}