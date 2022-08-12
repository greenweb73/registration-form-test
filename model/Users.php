<?php
namespace Model;

class Users {

    public function __construct()
    {
        $this->users = require $_SERVER['DOCUMENT_ROOT'] . '/data/users.php';
    }

    public function getAll() {
        return $this->users;
    }

    public function findUserByEmail(string $email) {
        $result = null;

        foreach ($this->users as $user) {

            if ($user['email'] === $email) {
                $result = $user;
            }

        }
        return $result;
    }
}
