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
        var_dump($tweets);
    }
}

$ncc_v2_twitter_tweets = new ncc_v2_twitter_tweets();