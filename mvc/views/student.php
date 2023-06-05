<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eden Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <h1>Student</h1>

    <table class='table table-striped table-dark'>
        <thead class="thead-light">
            <tr>
                <th class="col">ID</th>
                <th class="col">Ime</th>
                <th class="col">Prezime</th>
                <th class="col">Godini</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $student['id'] ?? 'Not found' ?></td>
                <td><?= $student['ime'] ?? 'Not found' ?></td>
                <td><?= $student['prezime'] ?? 'Not found' ?></td>
                <td><?= $student['godini'] ?? 'Not found' ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>