<?php
/**
* ncc_v2_twitter_admin_helper.php
*
* Description: 
*
* @author dbroadaw / 
*/
class ncc_v2_twitter_admin_helper
{
    public static function render_page()
    {
        self::render_page_header();
        self::render_page_body();

    }

    public static function render_page_header()
    {
        $header = '';
        $header .= '<div class="wrap">';
        $header .= '<div id="icon-themes" class="icon32"></div>';
        $header .= '<h2>Twitter Options</h2>';
        $header .= '</div>';

        echo $header;

    }

    public static function render_page_body()
    {
        if(isset($_POST['submit']))
        {
            self::save_post_data($_POST);
        }

        echo '<form method="post">';

        settings_errors();

        settings_fields( NCC_V2_TWITTER_OPTION_GROUP );
        do_settings_sections( NCC_V2_TWITTER_OPTION_GROUP );

        submit_button();

        echo '</form>';
    }

    public static function save_post_data( $post )
    {
        $errors = array();
        $save_data = array();

        $post = $post['ncc_v2_twitter_admin_options'];

        if ( $post['ncc_v2_twitter_admin_options_oauth_consumer_key'] == '' ||
                $post['ncc_v2_twitter_admin_options_oauth_consumer_secret'] == '' ||
                    $post['ncc_v2_twitter_admin_options_oauth_access_token'] == '' ||
                        $post['ncc_v2_twitter_admin_options_oauth_access_token_secret'] == '' )
                        {
                            $errors['oAuth'] = '<strong>All oAuth</strong> fields are required.';
                        } else {
                                $save_data['ncc_v2_twitter_admin_options_oauth_consumer_key']
                                    = $post['ncc_v2_twitter_admin_options_oauth_consumer_key'];
                                $save_data['ncc_v2_twitter_admin_options_oauth_consumer_secret']
                                    =  $post['ncc_v2_twitter_admin_options_oauth_consumer_secret'];
                                $save_data['ncc_v2_twitter_admin_options_oauth_access_token']
                                    =  $post['ncc_v2_twitter_admin_options_oauth_access_token'];
                                $save_data['ncc_v2_twitter_admin_options_oauth_access_token_secret']
                                    =  $post['ncc_v2_twitter_admin_options_oauth_access_token_secret'];
                        }
        if ( $post['ncc_v2_twitter_admin_options_account_twitter_user'] == '' ||
                strlen($post['ncc_v2_twitter_admin_options_account_twitter_user']) > 16  )
                {
                    $errors['twitter'] = '<strong>Twitter User</strong> cannot be empty or longer than 15 characters.';
                } else {
                    $save_data['ncc_v2_twitter_admin_options_account_twitter_user']
                        = $post['ncc_v2_twitter_admin_options_account_twitter_user'];
                }
        if ( $post['ncc_v2_twitter_admin_options_cache_duration'] == '' ||
            (!is_numeric($post['ncc_v2_twitter_admin_options_cache_duration'])) )
                {
                    $errors['cache'] = '<strong>Cache Duration</strong> must not be empty and must be a numeric value.';
                } else {
                   $save_data['ncc_v2_twitter_admin_options_cache_duration']
                       = $post['ncc_v2_twitter_admin_options_cache_duration'];
                }

        update_option(NCC_V2_TWITTER_OPTION_GROUP, $save_data);

        if ( isset($errors['oAuth']) ||
                isset($errors['twitter']) ||
                    isset($errors['cache']) )
                    {
                        $html = null;

                        $html .= '<div class="error">';
                        $html .= '<p><strong>Please correct the following errors:</strong>';

                        foreach ($errors as $value) {
                            $html .= '<p>';
                            $html .= $value;
                            $html .= '</p>';
                        }

                        $html .= '</div>';

                        echo $html;
                    } else {
                        $html = null;

                        $html = '<div class="updated">';
                        $html .= '<p>All settings have been updated.</p>';
                        $html .= '</div>';

                        echo $html;
                    }
    }
}
