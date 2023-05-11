<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?= $_SESSION['name'] ?></title>
    </head>
    <body>
        <nav>
            <ul>
                <a href="#"><li><?= $_SESSION['name'] ?></li></a>
                <a href="logout-page.php"><li>Log out</li></a>
            </ul>
        </nav>
        <h1>You succesfully logged in <?= $_SESSION['name'] ?>!</h1>
    </body>
</html>