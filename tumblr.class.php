<?php
/**************************************************
	#  tumblr-uploader &copy;  lolimilk.com
	#  tumblr.class.php  Created on 2013.08.06
	#  Weibo: http://weibo.com/614520789
***************************************************/
define("CONSUMER_KEY", "GqxrJaz7dJHEubpTEsmUeM5d0m8NYpTVWnArGbP9pyCjigv3gm");
define("CONSUMER_SECRET", "9BPnSEJZqOpiIgwySS8LKjUapkI4WFv9owUwY2xbDvYtZAgIIo");
define("OAUTH_TOKEN", "pSRVDYUpjnI4LS0kKkzxqR4UqIX4P1KmSOVCjFjDuEEOlDCgAI");
define("OAUTH_SECRET", "c8rX5T5bH4I2fcNOSEXTggbxoMUeJVGninB2E9DJiNo6VcWCBP");

function oauth_gen($method, $url, $iparams, &$headers) {
    
    $iparams['oauth_consumer_key'] = CONSUMER_KEY;
    $iparams['oauth_nonce'] = strval(time());
    $iparams['oauth_signature_method'] = 'HMAC-SHA1';
    $iparams['oauth_timestamp'] = strval(time());
    $iparams['oauth_token'] = OAUTH_TOKEN;
    $iparams['oauth_version'] = '1.0';
    $iparams['oauth_signature'] = oauth_sig($method, $url, $iparams);
    $oauth_header = array();
    foreach($iparams as $key => $value) {
        if (strpos($key, "oauth") !== false) { 
           $oauth_header []= $key ."=".$value;
        }
    }
    $oauth_header = "OAuth ". implode(",", $oauth_header);
    $headers["Authorization"] = $oauth_header;
}
 
function oauth_sig($method, $uri, $params) {
    
    $parts []= $method;
    $parts []= rawurlencode($uri);
   
    $iparams = array();
    ksort($params);
    foreach($params as $key => $data) {
            if(is_array($data)) {
                $count = 0;
                foreach($data as $val) {
                    $n = $key . "[". $count . "]";
                    $iparams []= $n . "=" . rawurlencode($val);
                    $count++;
                }
            } else {
                $iparams[]= rawurlencode($key) . "=" .rawurlencode($data);
            }
    }
    $parts []= rawurlencode(implode("&", $iparams));
    $sig = implode("&", $parts);
    return base64_encode(hash_hmac('sha1', $sig, CONSUMER_SECRET."&". OAUTH_SECRET, true));
}
?>
