<?php
    require_once 'endpoint.php';

//  $city = @$_POST['city'];
//  $mode = @$_POST['mode'];

if(isset($_POST['city'])){
    $city = $_POST['city'];
    $mode = $_POST['mode'];

$response =  getOpenWeatherData($city,$mode);

// echo '<pre>';
// print_r($response);
// echo '</pre>';

}

if(isset($mode) && $mode === 'json'){ ?>

<div class="container">
     <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>City Name</th>
                <th>Main description</th>
                <th>Description</th>
                <th>Temperature</th>
                <th>Wind Speed</th>
                <th>Humidity</th>
                <th>Weather Icon Image</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php $r_icon = $response['weather'][0]['icon'];?>
                <?php $icon = "http://openweathermap.org/img/w/$r_icon.png"; ?>

                <td><?= $response['name'] ?></td>
                <td><?= $response['weather'][0]['main'] ?></td>
                <td><?= $response['weather'][0]['description'] ?></td>
                <td><?= $response['main']['temp'] ?></td>
                <td><?= $response['wind']['speed'] ?></td>
                <td><?= $response['main']['humidity'] ?></td>
                <td><img src="<?= $icon ?>" alt="weather image"></td>

            </tr>
        </tbody>
     </table>
</div>

<?php
} else { 
    if(isset($city)){
?>
    <div class="container"><?= $response?></div>
<?php
    }
}
?>
<div class="container" >
    <form method="post">
        <div class="col-md-6">
            <label for="city">City Name</label>
            <input  type="text" class="from-control" name="city" value="">
        </div>
        <div class="col-md-6">
            <label for="mode">Select Mode</label>
            <select name="mode" class="form-control">
                <option value="html">HTML</option>
                <option value="json">JSON</option>
            </select>
        </div>

        <div class="col-md-12 mt-3">
            <input class="btn btn-block btn-warning" type="submit" value="Get API">
        </div>
    </form>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">