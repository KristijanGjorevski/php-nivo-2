<?php


 function getOpenWeatherData($city,$mode){

    
    $url = "https://api.openweathermap.org/data/2.5/weather";
    
    $api_key = "47870745f4f5557ad3a379eb67b1abfc";
    
    $data = [
        'q' => $city,
        'appid' => $api_key,
        'mode' => $mode,
        'units' => 'metric'
    ];


    $curl = curl_init();
    curl_setopt($curl,CURLOPT_URL,$url . '?' . http_build_query($data));
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($curl);
    curl_close($curl);


    switch ($mode) {
        case 'html':
            return $response;
            break;
        
        case 'json':
            return json_decode($response,true);
            break;
    }
 }

