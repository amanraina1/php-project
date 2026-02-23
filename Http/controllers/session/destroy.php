<?php

use Core\Authenticator;
use Core\Database;
use Core\App;

$db = App::resolve(Database::class);

// log the user out.
(new Authenticator($db))->logout();

redirect('/');