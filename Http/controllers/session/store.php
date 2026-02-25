<?php

// log in the user if credentials match
use Core\Authenticator;
use Core\Database;
use Core\App;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);

// first, validate the form data
$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$signedIn = (new Authenticator($db))->attempt(
    $attributes['email'], $attributes['password']
);

// then check if user exists, if yes, then match password otherwise redirect to login page
if(! $signedIn) {
    $form->error(
        'email', 'No matching account found for this email address.'
    )->throwException();
}
redirect('/');