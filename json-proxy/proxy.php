<?php

$url = $_GET['url'];

$data = $_GET;

unset($data['url']);

$url = $url . '?' . http_build_query($data);

header('Content-type: application/json');

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] );

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);

$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

curl_close($curl);

http_response_code($httpcode);

echo $response;

?>
