<?php

class AuthController {
    private $userModel;


    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function login($email, $password) {
        $user = $this->userModel->findByEmail($email);

        if (!$user) {
            return false;
        }

        if (!$password_verify($password, $user['password'])) {
            return false;
        }

        return $user;
    }
}