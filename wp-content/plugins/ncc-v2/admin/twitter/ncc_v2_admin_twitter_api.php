<?php
/**
* ncc_v2_admin_twitter_api.php
*
* Description: 
*
* @author dbroadaw / 
*/
class ncc_v2_admin_twitter_api
{

    public $consumerKey;
    public $consumerSecret;
    public $accessToken;
    public $accessTokenSecret;
    public $url;

    function __construct()
    {

    }

    public function notarealfunction()
    {
        $consumerKey = 'wGp6i8zIC1S22nGpLI5qA';
        $consumerSecret = 'Ic04riEzx49rftqF0EtGycKpWx82KAyrFjBT5Ts8';
        $accessToken = '17599289-D8scO3o78J5NZbEDTWybAYwog9Ea9QJumZRkrGo0b';
        $accessTokenSecret = '0y4L0v54DWiW6pGX2M7YolPYwi7oVoy4k2ma2NB9wRc';

        $oauth_hash = '';
        $oauth_hash .= 'oauth_consumer_key=' . $consumerKey . '&';
        $oauth_hash .= 'oauth_nonce=' . time() . '&';
        $oauth_hash .= 'oauth_signature_method=HMAC-SHA1&';
        $oauth_hash .= 'oauth_timestamp=' . time() . '&';
        $oauth_hash .= 'oauth_token=' . $accessToken . '&';
        $oauth_hash .= 'oauth_version=1.0';

        $base = '';
        $base .= 'GET';
        $base .= '&';
        $base .= rawurlencode('https://api.twitter.com/1.1/statuses/user_timeline.json');
        $base .= '&';
        $base .= rawurlencode($oauth_hash);


        $key = '';
        $key .= rawurlencode($consumerSecret);
        $key .= '&';
        $key .= rawurlencode($accessTokenSecret);

        $signature = base64_encode(hash_hmac('sha1', $base, $key, true));
        $signature = rawurlencode($signature);

        $oauth_header = '';
        $oauth_header .= 'oauth_consumer_key="' . $consumerKey . '", ';
        $oauth_header .= 'oauth_nonce="' . time() . '", ';
        $oauth_header .= 'oauth_signature="' . $signature . '", ';
        $oauth_header .= 'oauth_signature_method="HMAC-SHA1", ';
        $oauth_header .= 'oauth_timestamp="' . time() . '", ';
        $oauth_header .= 'oauth_token="' . $accessToken . '", ';
        $oauth_header .= 'oauth_version="1.0"';

        $curl_header = array("Authorization: Oauth {$oauth_header}", 'Expect:');

        $curl_request = curl_init();
        curl_setopt($curl_request, CURLOPT_HTTPHEADER, $curl_header);
        curl_setopt($curl_request, CURLOPT_HEADER, false);
        curl_setopt($curl_request, CURLOPT_URL, 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=internetwizzzrd');
        curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, false);

        $json = curl_exec($curl_request);
        curl_close($curl_request);
    }

}
