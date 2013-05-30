<?php

class ncc_v2_twitter_api
{
    private $consumerKey;
    private $consumerSecret;
    private $accessToken;
    private $tokenSecret;
    private $twitterUser;
    public  $status;

    function __construct()
    {
        $this->get_oAuth_params();
    }

    private function get_oAuth_params()
    {
        if ( get_option(NCC_V2_TWITTER_OPTION_GROUP) )
        {
            $oAuth_param_data = get_option(NCC_V2_TWITTER_OPTION_GROUP);

            $this->consumerKey
                = $oAuth_param_data['ncc_v2_twitter_admin_options_oauth_consumer_key'];
            $this->consumerSecret
                = $oAuth_param_data['ncc_v2_twitter_admin_options_oauth_consumer_secret'];
            $this->accessToken
                = $oAuth_param_data['ncc_v2_twitter_admin_options_oauth_access_token'];
            $this->tokenSecret
                = $oAuth_param_data['ncc_v2_twitter_admin_options_oauth_access_token_secret'];
            $this->twitterUser
                = $oAuth_param_data['ncc_v2_twitter_admin_options_account_twitter_user'];
        } else {
            $this->status = false;
        }

    }

    private function oAuth_hash()
    {
        $oauth_hash = '';
        $oauth_hash .= 'count=20&';
        $oauth_hash .= 'oauth_consumer_key=' . $this->consumerKey . '&';
        $oauth_hash .= 'oauth_nonce=' . time() . '&';
        $oauth_hash .= 'oauth_signature_method=HMAC-SHA1&';
        $oauth_hash .= 'oauth_timestamp=' . time() . '&';
        $oauth_hash .= 'oauth_token=' . $this->accessToken . '&';
        $oauth_hash .= 'oauth_version=1.0&';
        $oauth_hash .= 'screen_name=' . $this->twitterUser;

        return $oauth_hash;
    }
    private function oAuth_base()
    {
        $base = '';
        $base .= 'GET';
        $base .= '&';
        $base .= rawurlencode('https://api.twitter.com/1.1/statuses/user_timeline.json');
        $base .= '&';
        $base .= rawurlencode($this->oAuth_hash());

        return $base;
    }
    private function oAuth_key()
    {
        $key = '';
        $key .= rawurlencode($this->consumerSecret);
        $key .= '&';
        $key .= rawurlencode( $this->tokenSecret);

        return $key;
    }
    private function oAuth_signature()
    {
        $signature = base64_encode(hash_hmac('sha1', $this->oAuth_base(), $this->oAuth_key(), true));
        $signature = rawurlencode($signature);

        return $signature;
    }
    private function oAuth_header()
    {
        $oauth_header = '';
        $oauth_header .= 'oauth_consumer_key="' . $this->consumerKey . '", ';
        $oauth_header .= 'oauth_nonce="' . time() . '", ';
        $oauth_header .= 'oauth_signature="' . $this->oAuth_signature() . '", ';
        $oauth_header .= 'oauth_signature_method="HMAC-SHA1", ';
        $oauth_header .= 'oauth_timestamp="' . time() . '", ';
        $oauth_header .= 'oauth_token="' . $this->accessToken . '", ';
        $oauth_header .= 'oauth_version="1.0"';

        return $oauth_header;
    }

    private function get_twitter_json()
    {
        $curl_header = array("Authorization: Oauth {$this->oAuth_header()}", 'Expect:');

        $curl_request = curl_init();
        curl_setopt($curl_request, CURLOPT_HTTPHEADER, $curl_header);
        curl_setopt($curl_request, CURLOPT_HEADER, false);
        curl_setopt($curl_request, CURLOPT_URL, 'https://api.twitter.com/1.1/statuses/user_timeline.json?count=20&screen_name=internetwizzzrd');
        curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, false);

        $json = curl_exec($curl_request);
        curl_close($curl_request);

        return $json;
    }

    public function get_tweets()
    {
        return $this->get_twitter_json();
    }

}
