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
        $api = new ncc_v2_twitter_api();
        $tweets = $api->get_tweets();
        $tweets = json_decode($tweets);
        //var_dump($tweets);

        $html = null;

        foreach ( $tweets as $tweet ) {
            $html .= '<article>';
                $html .= '<header>';
                    $html .= '<h1>' . $tweet->created_at . '</h1>';
                $html .= '</header>';
                $html .= '<p>' . self::ncc_v2_twitter_tweets_tweet_parser($tweet) . '</p>';
                //var_dump($tweet->entities);
                $html .= '<footer>';
                    $html .= '<p><a href="http://www.twitter.com/' . $tweet->user->screen_name . '" target="_blank">@' . $tweet->user->screen_name . '</a>&nbsp;|&nbsp;';
                    $html .= '<a href="#" target="_blank">View on Twitter</a></p>';
                $html .= '</footer>';
                /* a little debug */
                $html .= self::grab_dump($tweet);
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

    private function ncc_v2_twitter_tweets_tweet_parser($tweet)
    {

        $text_to_parse = $tweet->text;

        if ( !empty($tweet->entities->urls) || isset($tweet->retweeted_status) )
        {
            $text_to_parse = self::ncc_v2_twitter_tweets_link_finder($text_to_parse, $tweet);
        }

        if ( !empty($tweet->entities->user_mentions) )
        {
            $text_to_parse = self::ncc_v2_twitter_tweets_mention_finder($text_to_parse, $tweet);
        }

        return $text_to_parse;

    }

    private function ncc_v2_twitter_tweets_link_finder($tweet_text, $tweetObj)
    {
        $text_with_html = $tweet_text;
        $url_source = null;

        if ( isset($tweetObj->retweeted_status) )
        {
            $url_source = $tweetObj->retweeted_status->entities->urls;
        } else
        {
            $url_source = $tweetObj->entities->urls;
        }

        foreach ( $url_source as $value ) {
            $search_in = $tweetObj->text;
            $search_for = $value->url;
            $replace_with = '<a href="' . $value->url . '" target="_blank">' . $value->url . '</a>';
            $text_with_html = str_replace( $search_for, $replace_with ,$search_in );
        }

        return $text_with_html;

    }

    private function ncc_v2_twitter_tweets_mention_finder($tweet_text,$tweetObj)
    {
        $text_with_html = $tweet_text;
        foreach ( $tweetObj->entities->user_mentions as $value ) {
            $search_in = $tweetObj->text;
            $search_for = $value->screen_name;
            $replace_with = '<a href="http://www.twitter.com/' . $value->screen_name . '" target="_blank">' . $value->screen_name . '</a>';
            $text_with_html = str_replace( $search_for, $replace_with ,$search_in );
        }

        return $text_with_html;
    }
}

$ncc_v2_twitter_tweets = new ncc_v2_twitter_tweets();