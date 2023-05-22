

<?php
$username = "Mia";
$password = "30";

$userpass = "$username:$password";
$url = 'http://localhost/php-nivo-2/c3/auth.php';


$curl = curl_init();
curl_setopt($curl,CURLOPT_URL,$url);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_USERPWD,$userpass);
$response = curl_exec($curl);
curl_close($curl);

if(curl_errno($curl)){
    echo "There has been an error:". curl_errno($curl) ."<br>";
}

$http_code = curl_getinfo($curl,CURLINFO_HTTP_CODE);

echo "HTTP status code: $http_code <br>";