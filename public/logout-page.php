<?php
echo "Thanks for using Reaching!";

if (isset($_SESSION['name'])) {
    unset($_SESSION['name']);
}

sleep(5);

header("Location: index.html");