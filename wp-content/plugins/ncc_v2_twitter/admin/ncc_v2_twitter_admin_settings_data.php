<?php
    /**
     * Description: All admin data in the form of arrays.
     *              Passed to ncc_vw_twitter_admin_settings_builder
     *
     * Class:       ncc_v2_twitter_admin_settings_data
     */
class ncc_v2_twitter_admin_settings_data
{
    /**
     * Description:  Menu data.
     * Function:     menu
     *
     * @return array
     */
    public static function menu()
    {
        $newMenu = array(
            array(
                'parentSlug'        => 'options-general.php',
                'pageTitle'         => 'Nerdery Code Challenge v2.0 - Twitter',
                'menuTitle'         => 'NCC Twitter',
                'cap'               => 'administrator',
                'menuSlug'          => 'ncc_v2_twitter_admin_options',
                'callbackClass'     => 'ncc_v2_twitter_admin',
                'callbackMethod'    => 'ncc_v2_twitter_admin_page_callback'
            )
        );

        return $newMenu;
    }

    /**
     * Description:  Settings sections.
     * Function:     section
     *
     * @return array
     */
    public static function section()
    {
        $newSections = array(
            array(
                'slug'             => 'ncc_v2_twitter_admin_options_oath_section',
                'title'            => 'oAuth',
                'callbackClass'    => 'ncc_v2_twitter_admin_settings_section_callbacks',
                'callbackMethod'   => 'oAuth',
                'optionGroup'      => NCC_V2_TWITTER_OPTION_GROUP
            ),
            array(
                'slug'             => 'ncc_v2_twitter_admin_options_account_section',
                'title'            => 'Twitter Account',
                'callbackClass'    => 'ncc_v2_twitter_admin_settings_section_callbacks',
                'callbackMethod'   => 'account',
                'optionGroup'      => NCC_V2_TWITTER_OPTION_GROUP
            ),
            array(
                'slug'             => 'ncc_v2_twitter_admin_options_cache_section',
                'title'            => 'Cache',
                'callbackClass'    => 'ncc_v2_twitter_admin_settings_section_callbacks',
                'callbackMethod'   => 'cache',
                'optionGroup'      => NCC_V2_TWITTER_OPTION_GROUP
            ),
        );

        return $newSections;
    }

    /**
     * Description:  Settings fields for sections.
     * Function:     fields
     *
     * @return array
     */
    public static function fields()
    {
        $newFields = array(
            array(                  //oAuth Consumer Key
                'slug'              => 'ncc_v2_twitter_admin_options_oauth_consumer_key',
                'title'             => 'Consumer Key',
                'callbackClass'     => 'ncc_v2_twitter_admin_settings_field_callbacks',
                'callbackMethod'    => 'oAuth_consumer_key',
                'optionGroup'       => NCC_V2_TWITTER_OPTION_GROUP,
                'section'           => 'ncc_v2_twitter_admin_options_oath_section',
                'class'             => 'oauth',
                'desc'              => 'ex: wGp6i8zIC1S22nGpLI5qA'
            ),
            array(
                'slug'              => 'ncc_v2_twitter_admin_options_oauth_consumer_secret',
                'title'             => 'Consumer Secret',
                'callbackClass'     => 'ncc_v2_twitter_admin_settings_field_callbacks',
                'callbackMethod'    => 'oAuth_consumer_secret',
                'optionGroup'       => NCC_V2_TWITTER_OPTION_GROUP,
                'section'           => 'ncc_v2_twitter_admin_options_oath_section',
                'class'             => 'oauth',
                'desc'              => 'ex: Ic04riEzx49rftqF0EtGycKpWx82KAyrFjBT5Ts8'
            ),
            array(
                'slug'              => 'ncc_v2_twitter_admin_options_oauth_access_token',
                'title'             => 'Access Token',
                'callbackClass'     => 'ncc_v2_twitter_admin_settings_field_callbacks',
                'callbackMethod'    => 'oAuth_access_token',
                'optionGroup'       => NCC_V2_TWITTER_OPTION_GROUP,
                'section'           => 'ncc_v2_twitter_admin_options_oath_section',
                'class'             => 'oauth',
                'desc'              => 'ex: 17599289-D8scO3o78J5NZbEDTWybAYwog9Ea9QJumZRkrGo0b'
            ),array(
                'slug'              => 'ncc_v2_twitter_admin_options_oauth_access_token_secret',
                'title'             => 'Token Secret',
                'callbackClass'     => 'ncc_v2_twitter_admin_settings_field_callbacks',
                'callbackMethod'    => 'oAuth_access_token_secret',
                'optionGroup'       => NCC_V2_TWITTER_OPTION_GROUP,
                'section'           => 'ncc_v2_twitter_admin_options_oath_section',
                'class'             => 'oauth',
                'desc'              => 'ex: 0y4L0v54DWiW6pGX2M7YolPYwi7oVoy4k2ma2NB9wRc'
            ),array(
                'slug'              => 'ncc_v2_twitter_admin_options_account_twitter_user',
                'title'             => 'Twitter User',
                'callbackClass'     => 'ncc_v2_twitter_admin_settings_field_callbacks',
                'callbackMethod'    => 'account_twitter_user',
                'optionGroup'       => NCC_V2_TWITTER_OPTION_GROUP,
                'section'           => 'ncc_v2_twitter_admin_options_account_section',
                'class'             => 'twitter-user',
                'desc'              => 'ex: internetwizzzard'
            ),array(
                'slug'              => 'ncc_v2_twitter_admin_options_cache_duration',
                'title'             => 'Cache Duration',
                'callbackClass'     => 'ncc_v2_twitter_admin_settings_field_callbacks',
                'callbackMethod'    => 'cache_duration',
                'optionGroup'       => NCC_V2_TWITTER_OPTION_GROUP,
                'section'           => 'ncc_v2_twitter_admin_options_cache_section',
                'class'             => 'cache-duration',
                'desc'              => 'ex: 60 '
            )

        );

        return $newFields;
    }
}
