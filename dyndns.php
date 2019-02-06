<?php
include_once 'privateVars.php';
define('apiKey', $key);
define('email', 'justus.croskery@gmail.com');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://ipecho.net/plain");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
define('ip', curl_exec($ch));
curl_close($ch);

function makeCurlRequest($baseURL, $httpArray = [], $put = false)
{
    $params = '';
    if (!empty($httpArray) && !$put) {
        $params = http_build_query($httpArray);
    }
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $baseURL . $params);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	if($put){
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($curl, CURLOPT_POSTFIELDS,json_encode($httpArray));
	}
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'X-Auth-Email: ' . email,
        'X-Auth-Key: ' . apiKey,
        'Content-Type: application/json',
    ));
    $response = json_decode(curl_exec($curl), true);
    curl_close($curl);
    return $response;
}
function changeIp($name)
{
    $response = makeCurlRequest('https://api.cloudflare.com/client/v4/zones/', []);
    $zoneid = $response['result'][0]['id'];

    $arrayPassed = [
        'type' => 'A',
        'name' => $name
    ];
    $response = makeCurlRequest('https://api.cloudflare.com/client/v4/zones/' . $zoneid . '/dns_records?', $arrayPassed);
    $recordid = $response['result'][0]['id'];

    $response = makeCurlRequest('https://api.cloudflare.com/client/v4/zones/' . $zoneid . '/dns_records/' . $recordid);
    $currentIp = $response['result']['content'];
    if (ip == $currentIp) {
        echo $response['result']['name'] . ' has already been updated.';
    } else {
		echo $response['result']['name'] . ' must be updated.';
		$arrayPassed = [
			'type' => 'A',
			'name' => $name,
			'content' => ip,
			'proxied' => true
		];
		$response = makeCurlRequest('https://api.cloudflare.com/client/v4/zones/' . $zoneid . '/dns_records/' . $recordid, $arrayPassed, true);
		print_r($response);
    }
}
$domains = ['olmmcc.tk', 'www.olmmcc.tk', 'mail.olmmcc.tk'];
foreach($domains as $domain){
	changeIp($domain);
}
