<?php


$str_as_json = '
    {
        "professor" : {
            "name" :    "Kristijan",
            "lastname" : "Gjorevski",
            "age" : "43",
            "email" : "kiko.g@gmail.com",
            "languages" : ["PHP","MYSQL","HTML"]
        }
    }
'; 

$json = json_decode($str_as_json);

$json_encode = json_encode($json);

echo "<pre>";
print_r($json);
echo "</pre>";
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
    <h1>Profesori</h1>
    <h3>Kurs na predavanje</h3>

    <ul>
        <li></li>
    </ul>
</body>
</html>