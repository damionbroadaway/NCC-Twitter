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
                $html .= '<p>' . $tweet->text . '</p>';
                var_dump($tweet->entities);
                $html .= '<footer>';
                    $html .= '<p><a href="http://www.twitter.com/' . $tweet->user->screen_name . '" target="_blank">@' . $tweet->user->screen_name . '</a>&nbsp;|&nbsp;';
                    $html .= '<a href="#" target="_blank">View on Twitter</a></p>';
                $html .= '</footer>';
            $html .= '</article>';
        }

        echo $html;


    }

    private function ncc_v2_twitter_tweets_link_finder($tweet)
    {

    }
}

$ncc_v2_twitter_tweets = new ncc_v2_twitter_tweets();