<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


<h1>Homepage</h1>

<ul>
    <li><a href="/home">Home</a></li>
    <li><a href="/student-form">Create a Student</a></li>
    <li><a href="#">UNDER_CONSTRUCTION</a></li>
    <li><a href="/">Root</a></li>
</ul>
<?php

$lista = ''


?>

<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Godini</th>
            <th>Email</th>
            <th>Edit Student</th>
            <th>Delete Student</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($data as $key => $value){ ?>
        <tr>
            <td><?=$value['ime']?></td>
            <td><?=$value['prezime']?></td>
            <td><?=$value['godini']?></td>
            <td><?=$value['email']?></td>
            <td><a href="/student/<?= $value['id'];?>/edit">Edit User</a></td> 
            <td><a href="/student/<?= $value['id'];?>/delete">Delete User</a></td> 
        </tr>
        <?php
        }
        ?>  
    </tbody>
</table>
