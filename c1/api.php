<?php

$api_key = "47870745f4f5557ad3a379eb67b1abfc";

$parameters = [
    'appid' => $api_key,
    'lat' => '41.59',
    'lon' => '21.25',
    'units' => 'metric'
];

$request = "https://api.openweathermap.org/data/2.5/weather";

$full_url = $request . '?' . http_build_query($parameters);


$response = file_get_contents($full_url);

$response_formated = json_decode($response,true);

echo '<pre>';
print_r($response_formated);
echo '</pre>';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>blisku do Skopje Weather</h1>

    <table>
        <thead>
            <tr>
                <td>Vidlivost</td>
                <td>Minimum tmp</td>
                <td>Maximum tmp</td>
                <td>Momentalna tmp</td>
            </tr>            
        </thead>
        <tbody>
            <tr>
                <td><?php echo $response_formated['weather'][0]['main'] ?></td>
                <td><?php echo $response_formated['main']['temp_min'] ?></td>
                <td><?php echo $response_formated['main']['temp_max'] ?></td>
                <td><?php echo $response_formated['main']['temp'] ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>