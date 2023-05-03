<?php
session_start();
include '../config/config.php';

$member = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member['email'] = $_POST['email'];
    $member['password'] = $_POST['password'];

    $sql = "SELECT password, name FROM member
            WHERE email = :email";

    $pdo = new PDO($dsn, $username, $password, $options);

    function login($sql, $pdo, $member) {
        try {
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':email', $member['email']);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        $result = password_verify($member['password'], $data['password']);
        if ($result) {
            header("Location: ../public/home.php");
        } else {
            header("Location: ../public/e.html");
        }
        } catch (PDOException $e) {
            throw $e;
        }
        return $data;
    }

    $data = login($sql, $pdo, $member);

    $_SESSION['name'] = $data['name'];
}