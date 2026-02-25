<?php

namespace Core;

class Authenticator
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function attempt($email, $password)
    {
        // match the credentials
        $user = $this->db->query("select * from users where email = :email", ['email' => $email])->find();

        if($user) {
            // we have a user, and need to verify hashed password
            if(password_verify($password, $user['password'])) {
                $this->login(['email' => $email]);
                return true;
            }
        }
        return false;
    }

    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}