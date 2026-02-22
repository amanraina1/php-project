<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

// validate the form inputs
$errors = [];
if (! Validator::email($email)) {
    $errors['email'] = "Please provide a valid email address";
}

if(! Validator::string($password, 7, 255)) {
    $errors['password'] = "Please provide a password of at least 7 characters";
}

if(! empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);
// check if the account already exists
$users = $db->query("select * from users where email = :email", [
    'email' => $_POST['email']
])->find();

// if yes, redirect to login page
if($users) {

    header('location: /');
    exit();
} else {

    // if not, save one to the db, and then login user and redirect
    $db->query("insert into users(email, password) values (:email, :password)", [
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ]);

    // user has logged in
    $_SESSION['user'] = [
        'email' => $email
    ];

    header('location: /');
    exit();
}