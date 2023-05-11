<?php
session_start();

include '../config/config.php';

$member = [];

#Collect member data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member['firstname'] = $_POST['firstname'];
    $member['lastname'] = $_POST['lastname'];
    $member['email'] = $_POST['email'];
    $member['password'] = $_POST['password'];

    $hashed_password = password_hash($member['password'], PASSWORD_DEFAULT);

    $valid['firstname'] = strlen($member['firstname']) > 1;
    $valid['lastname'] = strlen($member['lastname']) > 1;
    $valid['email'] = filter_var($member['email'], FILTER_VALIDATE_EMAIL);
    
    $password_validation = [
        'uppercase' => preg_match('@[A-Z]@', $member['password']),
        'lowercase' => preg_match('@[a-z]@', $member['password']),
        'number' => preg_match('@[0-9]@', $member['password']),
        'specialchars' => preg_match('@[^\w]@', $member['password']),
    ];
    
    $valid['password'] = $password_validation['uppercase'] && $password_validation['lowercase']
    && $password_validation['number'] && $password_validation['specialchars'];

    $sql = "INSERT INTO member (name, lastname, email, password)
        VALUES (:name, :lastname, :email, :password);";
    $pdo = new PDO($dsn, $username, $password, $options);

    function register($sql, $pdo, $member, $password) {
        try {
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':name', $member['firstname']);
        $statement->bindValue(':lastname', $member['lastname']);
        $statement->bindValue(':email', $member['email']);
        $statement->bindValue(':password', $password);
        $statement->execute();
        header("Location: ../public/login-form.php");
        exit;
        } catch (PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                $_SESSION['email_error'] = "An account with that email already exists";
                header("Location: ../public/register-form.php");
                exit;
            } else {
                throw $e;
            }
        }
    }

    if(!$valid['firstname'] || !$valid['lastname'] || !$valid['email'] || !$valid['password']) {
        header("Location: ../public/register-form.php");
    } else {
        register($sql, $pdo, $member, $hashed_password);
    }
}