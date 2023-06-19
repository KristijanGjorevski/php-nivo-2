<h2><?= (isset($_SESSION['oldData']['id']))? 'Update' : 'Create'; ?> Student</h2>

<form action="/student-create" method="POST">
    <input type="hidden" name="id" value= "<?php $_SESSION['oldData'] ?? '' ?>">
    <input type="text" name="ime" placeholder="Ime" value="<?= $_SESSION['error']['ime'] ?? $_SESSION['oldData']['ime'] ?? '' ?>">
    <input type="text" name="prezime" placeholder="Prezime" value="<?= $_SESSION['error']['prezime'] ?? $_SESSION['oldData']['prezime'] ?? '' ?>">
    <input type="text" name="godini" placeholder="Godini" value="<?= $_SESSION['error']['godini'] ?? $_SESSION['oldData']['godini'] ?? '' ?>">
    <input type="text" name="email" placeholder="Email" value="<?= $_SESSION['error']['email'] ?? $_SESSION['oldData']['email'] ?? '' ?>">
    <button type="submit"><?= (isset($_SESSION['oldData']['id']))? 'Update' : 'Create'; ?> User</button>
</form>