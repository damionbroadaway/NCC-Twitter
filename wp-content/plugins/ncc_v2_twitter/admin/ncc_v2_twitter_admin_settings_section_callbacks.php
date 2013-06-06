<?php
    /**
     * Description: Settings section callbacks.
     *
     * Class:       ncc_v2_twitter_admin_settings_section_callbacks
     */
class ncc_v2_twitter_admin_settings_section_callbacks
{
    public static function oAuth()
    {
        $html = '';
        $html .= 'Enter the values from the Twitter app you created.';

        echo $html;
    }

    public static function account()
    {
        $html = '';
        $html .= 'What Twitter user would you like displayed?';

        echo $html;
    }

    public static function cache()
    {
        $html = '';
        $html .= 'How often - in minutes - should the Tweets refresh?';

        echo $html;
    }
}