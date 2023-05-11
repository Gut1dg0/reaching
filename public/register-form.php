<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta names="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta property="og:title" content="Reaching, the best solution for WhatsApp Business Platform"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="https://reaching.tech"/>
        <title>Reaching, the best solution for WhatsApp Business Platform</title>
    </head>
    <body>
        <header>
            <hgroup>
                <h1>Welcome to <a href="index.html">Reaching</a></h1>
                <p>The best solution for WhatsApp business Platform</p>
            </hgroup>
        </header>
        <form action="../src/register.php" method="post">
            <p>
                <label for="firstname">Name</label>
                <input type="text" id="firstname" name="firstname">
            </p>
            <p>
                <label for="lastname">Lastname</label>
                <input type="text" id="lastname" name="lastname">
            </p>
            <p>
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </p>
            <button type="submit">Register</button>
        </form>
        <?php if(isset($_SESSION['email_error'])) {
            echo $_SESSION['email_error'];
            unset($_SESSION['email_error']);
        }
        ?>
    </body>
</html>