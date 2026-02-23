<?php

// log in the user if credentials match
use Core\Authenticator;
use Core\Database;
use Core\App;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

// first, validate the form data
$form = new LoginForm();

if ($form->validate($email, $password))
{
    // then check if user exists, if yes, then match password otherwise redirect to login page
    $db = App::resolve(Database::class);

    if((new Authenticator($db))->attempt($email, $password)) {
        redirect('/');
    }

    $form->error('email', 'No matching account found for this email address.');
}

redirect('/login');