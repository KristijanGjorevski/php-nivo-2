<?php


// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';

// if(require_auth()){
//     send();
// } else{
//     reject();
// }

// require_auth() ? send() : reject();

require_auth_db() ? send() : reject();






function require_auth()
{
    $auth_user = "admin";
    $auth_pw = "root";

    // if ( ! empty($_SERVER['PHP_AUTH_USER']) &&
    //      ! empty($_SERVER['PHP_AUTH_PW']) &&
    //      $_SERVER['PHP_AUTH_USER'] === $auth_user &&
    //      $_SERVER['PHP_AUTH_PW'] === $auth_pw
    //      ){
    //     return true;
    // } else {
    //     return false;
    // }

    return (
        ! empty($_SERVER['PHP_AUTH_USER']) &&
        ! empty($_SERVER['PHP_AUTH_PW']) &&
        $_SERVER['PHP_AUTH_USER'] === $auth_user &&
        $_SERVER['PHP_AUTH_PW'] === $auth_pw
        );

    
}

function require_auth_db(){
    return (
        ! empty($_SERVER['PHP_AUTH_USER']) &&
        ! empty($_SERVER['PHP_AUTH_PW']) &&
        checkDbUserPass($_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW'])
    );
}

function send(){
    echo getOpenWeatherData('Skopje','html');
}


function checkDbUserPass($name,$pass){

    $db = require('db_config.php');
    $cn_str = "mysql:host=127.0.0.1;dbname=php12";
    $db_username = 'root';
    $db_password = '';
    $db = new PDO($cn_str, $db_username, $db_password);


    $sql = "
    SELECT ime,prezime,godini,email
    FROM studenti
    WHERE ime = :name and godini = :password
    ";

    $query = $db->prepare($sql);


    $query->execute([
        ":name" => $name,
        ":password" => $pass
    ]);


    return $query->fetch(PDO::FETCH_ASSOC);

}

// API za da dobie korisnikot informacii od weather dokolku e logiran vo stranata
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


 function reject(){
    header('HTTP/1.0 401 Unauthorized');
    header('WWW-Authenticate: Basic realm=Access denied');

    echo 'Access denied.';
    die;
 }


?>