<?php
/**
* ncc_v2_twitter_tweets.php
*
* Description: 
*
* @author dbroadaw / 
*/
class ncc_v2_twitter_tweets
{
    function __construct()
    {
        $this->ncc_v2_twitter_tweets_init();
    }

    public function ncc_v2_twitter_tweets_init()
    {
        include_once ( 'ncc_v2_twitter_api.php');
    }

    public function ncc_v2_twitter_tweets_show()
    {

        $tweets = null;

         if ( false === ($tweets = get_transient('ncc_v2_twitter_cache') ) )
        {
            $api = new ncc_v2_twitter_api();
            $tweets = $api->get_tweets();

            $cache_in_seconds = self::ncc_v2_twitter_tweets_cache_to_seconds();
            set_transient('ncc_v2_twitter_cache', $tweets, $cache_in_seconds);
            echo 'json';
        } else
        {
            $tweets = get_transient('ncc_v2_twitter_cache');
            echo 'transient';
        }

        $tweets = json_decode($tweets);
        //var_dump($tweets);

        $html = null;

        foreach ( $tweets as $tweet ) {
            $html .= '<article>';
                $html .= '<header>';
                    $html .= '<h1>' . self::ncc_v2_twitter_tweets_date_formatter($tweet->created_at) . '</h1>';
                $html .= '</header>';
                $html .= '<p>' . self::ncc_v2_twitter_tweets_tweet_parser($tweet) . '</p>';
                //var_dump($tweet->entities);
                $html .= '<footer>';
                    $html .= '<p><a href="http://www.twitter.com/' . $tweet->user->screen_name . '" target="_blank">@' . $tweet->user->screen_name . '</a>&nbsp;|&nbsp;';
                    $html .= '<a href="http://www.twitter.com/' . $tweet->user->screen_name . '/status/' . $tweet->id_str . '" target="_blank">View on Twitter</a></p>';
                $html .= '</footer>';
                /* a little debug */
                //$html .= self::grab_dump($tweet);
            $html .= '</article>';
        }

        echo $html;


    }

    private function grab_dump($var)
    {
        ob_start();
        var_dump($var);
        return ob_get_clean();
    }

    private function ncc_v2_twitter_tweets_date_formatter($tweet_date)
    {
        $date = new DateTime($tweet_date);
        $date->setTimezone(new DateTimeZone('America/Chicago'));
        $formatted_date = $date->format('l, F m, Y @ h:ia');

        return $formatted_date;
    }

    private function ncc_v2_twitter_tweets_tweet_parser($tweet)
    {

        $text_to_parse = $tweet->text;

        $link_parsed_text
                = self::ncc_v2_twitter_tweets_link_finder($text_to_parse);

        $mention_parsed_text
                = self::ncc_v2_twitter_tweets_mention_finder($link_parsed_text);

        $hashtag_parsed_text
                = self::ncc_v_twitter_tweets_hashtag_finder($mention_parsed_text);


        return $hashtag_parsed_text;

    }

    private function ncc_v2_twitter_tweets_link_finder($tweet_text)
    {
        $parsed_text = preg_replace('!(http|https)(s)?:\/\/[a-zA-Z0-9.?&_/]+!',
                                    '<a href="\\0" target="_blank">\\0</a>',
                                    $tweet_text);

        return $parsed_text;
    }

    private function ncc_v2_twitter_tweets_mention_finder($tweet_text)
    {
        $parsed_text = preg_replace('/(^|\s)@([a-z0-9_]+)/i',
                                    '$1<a href="http://www.twitter.com/$2" target="_blank">@$2</a>',
                                    $tweet_text);

        return $parsed_text;
    }

    private function ncc_v_twitter_tweets_hashtag_finder($tweet_text)
    {
        $parsed_text = preg_replace('/(^|\s)#(\w*[a-zA-Z_]+\w*)/',
                                    '\1<a href="http://www.twitter.com/search?q=%23\2&src=hash" target="_blank">#\2</a>',
                                    $tweet_text);

        return $parsed_text;

    }

    private function ncc_v2_twitter_tweets_cache_to_seconds()
    {
        if ( get_option( NCC_V2_TWITTER_OPTION_GROUP ) )
        {
            $options = get_option( NCC_V2_TWITTER_OPTION_GROUP );
            $cache_minutes = $options['ncc_v2_twitter_admin_options_cache_duration'];
        } else
        {
            $cache_minutes = 0;
        }

        $cache_minutes = $cache_minutes * 60;

        return $cache_minutes;
    }
}

$ncc_v2_twitter_tweets = new ncc_v2_twitter_tweets();