<?php
session_start();

if (isset($_SESSION['name'])) {
    unset($_SESSION['name']);
}
?>

<html>
<head>
    <title>Thank you for using Reaching!</title>
</head>
<body>
    <h1>Thank you for using Reaching!</h1>
    <p>You will be redirected to the home page in 3 seconds.</p>

    <script>
        setTimeout(function() {
            window.location.href = "index.html";
        }, 3000);
    </script>
</body>
</html>