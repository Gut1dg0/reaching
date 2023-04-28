<?php
define('DEV', true);
define("DOC_ROOT", '/reaching/public/');
define("ROOT_FOLDER", 'public');

#Database settings
$type = 'mysql';
$server = 'localhost';
$db = 'reaching';
$port = '8888';
$charset = 'utf8mb4';
$username = 'guti';
$password = 'UA.UB(7Uc34T]fOl';
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";