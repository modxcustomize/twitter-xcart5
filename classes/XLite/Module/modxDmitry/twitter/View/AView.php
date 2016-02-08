<?php
namespace XLite\Module\modxDmitry\twitter\View;
 
abstract class AView extends \XLite\View\AView implements \XLite\Base\IDecorator
{
    protected function getThemeFiles()
    {
    
      $list = parent::getThemefiles();
       
      return $list;
 
    }

    /**
     * Return TWiTTeR Data
     *
     * @return array
     */
    protected function getTWTTRData()
    {
    	$consumer_key = "j0xwATWiD0jtUcoPZtBq4356gpndT";
	    $consumer_secret  = "5XostkgybifrUjAx4TCjiV4356bV91QPdProoaygQDhrm5utAQ7U5B";
	    $oauth_access_token         = "46525345662441-4356B5pBfDhWzqXBWsBCKVA3T3tJJZt0fl9P5ESxrG2";
	    $oauth_access_token_secret  = "WqMgPYc43569x2SqSsplq4356BzYHH1c0CRZ5vEWK3WjBvTHg5kb7";
	
	    $twitter_timeline           = "user_timeline";  //  mentions_timeline / user_timeline / home_timeline / retweets_of_me
	
    	//  create request
        $request = array(
            'screen_name'       => '34c4356456r432105',
            'count'             => '1'
        );

	    $oauth = array(
	        'oauth_consumer_key'        => $consumer_key,
	        'oauth_nonce'               => time(),
	        'oauth_signature_method'    => 'HMAC-SHA1',
	        'oauth_token'               => $oauth_access_token,
	        'oauth_timestamp'           => time(),
	        'oauth_version'             => '1.0'
	    );

    	//  merge request and oauth to one array
        $oauth = array_merge($oauth, $request);

		//prepare data
		$r = array();
		ksort($oauth);
		foreach ($oauth as $key => $value) {
		        $r[] = "$key=" . rawurlencode($value);
		}

    	//  do some magic
        $base_info              = 'GET' . "&" . rawurlencode("https://api.twitter.com/1.1/statuses/$twitter_timeline.json") . '&' . rawurlencode(implode('&', $r)); 
                          //buildBaseString("https://api.twitter.com/1.1/statuses/$twitter_timeline.json", 'GET', $oauth);
        $composite_key          = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
        $oauth_signature            = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
        $oauth['oauth_signature']   = $oauth_signature;

		//buildAuthorizationHeader
		$r = 'Authorization: OAuth ';
	    $values = array();
	    foreach ($oauth as $key => $value) $values[] = "$key=\"" . rawurlencode($value) . "\"";
	    $r.= implode(', ', $values);
	

    	//  make request
        $header = array($r, 'Expect:');
        $options = array( CURLOPT_HTTPHEADER => $header,
                          CURLOPT_HEADER => false,
                          CURLOPT_URL => "https://api.twitter.com/1.1/statuses/$twitter_timeline.json?". http_build_query($request),
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_SSL_VERIFYPEER => false);

        $feed = curl_init();
        curl_setopt_array($feed, $options);
        $json = json_decode(curl_exec($feed));
        curl_close($feed);
		//print_r($json);
    	$ret = '';
		foreach($json as $twet){ //print_r($twet);
		 	$ret.= "<li>".$twet->text;
		 	if($twet->extended_entities -> media[0])
		 		$ret.= "<img class='twitter-image' src='".$twet->extended_entities -> media[0]->media_url."' />";
		 	$ret.="</li>";
		
		}

		return $ret;//json_decode($json, true);

      
    }
    
 }