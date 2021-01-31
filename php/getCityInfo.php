<?php
	$executionStartTime = microtime(true) / 1000;
    
    $url='https://api.opencagedata.com/geocode/v1/json?q=' . $_REQUEST['city'] . '&countrycode=' . $_REQUEST['ISO_A2'] . '&limit=1&key=bb4794c7e4904295a7295c68d3f11967';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL,$url);

	$result=curl_exec($ch);

	curl_close($ch);

	$decode = json_decode($result,true);	

	$output['status']['code'] = "200";
	$output['status']['name'] = "ok";
	$output['status']['description'] = "mission saved";
	$output['status']['returnedIn'] = (microtime(true) - $executionStartTime) / 1000 . " ms";
	$output['cityData'] = $decode['results'];
	
	header('Content-Type: application/json; charset=UTF-8');

	echo json_encode($output);
?>
