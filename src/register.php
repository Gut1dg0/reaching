<?php
include '../config/config.php';

$member = [];
$errors = [
    'firstname' => '',
    'lastname' => '',
    'email' => '',
    'password' => ''
];

#Collect member data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member['firstname'] = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $member['lastname'] = isset($_POST['lastname']) ? $_POST['lastname'] : '';
    $member['email'] = isset($_POST['email']) ? $_POST['email'] : '';
    $member['password'] = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';

    $errors['firstname'] = mb_strlen($member['firstname']) > 1;
    $errors['lastname'] = mb_strlen($member['lastname']) > 1;
    $errors['email'] = filter_var($member['email'], FILTER_VALIDATE_EMAIL) ? true : false;
    $errors['password'] = mb_strlen($member['password']) > 8;

    $invalid = implode($errors);

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
        header("Location: ../public/login-form.html");
        exit;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    if($errors['firstname'] & $errors['lastname'] & 
    $errors['email'] & $errors['password']) {
        register($sql, $pdo, $member);
    } else {
        header("Location: ../public/index.html");
    }
}