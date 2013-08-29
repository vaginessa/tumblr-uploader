<?php
/**************************************************
	#  tumblr-uploader &copy;  lolimilk.com
	#  upload.php  Created on 2013.08.06
	#  Weibo: http://weibo.com/614520789
***************************************************/
include('tumblr.class.php');
include('config.php');
function curl_data($url,$data){
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $tmpInfo = curl_exec($curl);
    curl_close($curl);
    return $tmpInfo;
}
 if(isset($_FILES['data']['tmp_name'])){
$route=$_FILES['data']['tmp_name'];
 
$headers = array("Host" => "http://api.tumblr.com/", "Content-type" => "application/x-www-form-urlencoded", "Expect" => "");
$params = array("data" => array(file_get_contents("$route"), file_get_contents("$route")),"type" => "photo");

oauth_gen("POST", "http://api.tumblr.com/v2/blog/$blogname/post", $params, $headers);
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://api.tumblr.com/v2/blog/$blogname/post");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: " . $headers['Authorization'],
    "Content-type: " . $headers["Content-type"],
    "Expect: ")
);
 
$params = http_build_query($params);
 
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
 
$response = curl_exec($ch);
$form = "api.tumblr.com/v2/blog/".$blogname."/posts/photo?api_key=".$api_key."";
$var = '';
$json = curl_data($form,$var);
$form_url_info = json_decode($json,true);
//echo $form."<br>";
echo '<img src="'.$form_url_info["response"]["posts"]["0"]["photos"][0]["original_size"]["url"].'">';
//print $response;
}
?>