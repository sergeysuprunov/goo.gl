<? 
header("Access-Control-Allow-Origin: *");
define ("AUTH_KEY","YOUR_API_KEY");
define ("API_URL","https://www.googleapis.com/urlshortener/v1/url");
function send($long_url=FALSE, $short_url=FALSE) {
	$ku = curl_init();
	curl_setopt($ku,CURLOPT_SSL_VERIFYPEER,FALSE);
	curl_setopt($ku,CURLOPT_SSL_VERIFYHOST,FALSE);
	curl_setopt($ku,CURLOPT_RETURNTRANSFER,TRUE);
	if($long_url) {
		curl_setopt($ku,CURLOPT_POST,TRUE);
		curl_setopt($ku,CURLOPT_POSTFIELDS,json_encode(array("longUrl"=>$long_url)));
		curl_setopt($ku,CURLOPT_HTTPHEADER,array("Content-Type:application/json"));
		curl_setopt($ku,CURLOPT_URL,API_URL."?key=".AUTH_KEY);
	}
	elseif($short_url) {
		curl_setopt($ku,CURLOPT_URL,API_URL."?key=".AUTH_KEY."&shortUrl=".$short_url."&projection=ANALYTICS_CLICKS");
	}	
	$result = curl_exec($ku);
	curl_close($ku);
	return json_decode($result);
}
echo send($_POST['url'])->id;
?>