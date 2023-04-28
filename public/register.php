<?php
include '../config/config.php';

$member = [];

#Collect member data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member['firstname'] = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $member['lastname'] = isset($_POST['lastname']) ? $_POST['lastname'] : '';
    $member['email'] = isset($_POST['email']) ? $_POST['email'] : '';
    $member['password'] = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';

    $sql = "INSERT INTO member (name, lastname, email, password)
        VALUES (:name, :lastname, :email, :password);";
    $pdo = new PDO($dsn, $username, $password, $options);

    function register($sql, $pdo, $member) {
        try {
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':name', $member['firstname']);
        $statement->bindValue(':lastname', $member['lastname']);
        $statement->bindValue(':email', $member['email']);
        $statement->bindValue(':password', $member['password']);
        $statement->execute();
        header("Location: login-form.html");
        exit;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    register($sql, $pdo, $member);
}