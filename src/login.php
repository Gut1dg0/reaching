<?php
session_start();
include '../config/config.php';

$member = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member['email'] = $_POST['email'];
    $member['password'] = $_POST['password'];

    $sql = "SELECT password FROM member
            WHERE email = :email";

    $pdo = new PDO($dsn, $username, $password, $options);

    function login($sql, $pdo, $member) {
        try {
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':email', $member['email']);
        $statement->execute();
        $hash = $statement->fetchColumn();
        $result = password_verify($member['password'], $hash);
        if ($result) {
            header("Location: ../public/h.html");
        } else {
            header("Location: ../public/e.html");
        }
        } catch (PDOException $e) {
            throw $e;
        }
    }

    login($sql, $pdo, $member);
}