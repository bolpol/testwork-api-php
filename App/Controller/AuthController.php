<?php
/**
 * Created by PhpStorm.
 * User: pirno
 * Date: 2/12/2019
 * Time: 3:01 PM
 */

namespace App\Controller;


use App\Model\UserModel as User;

class AuthController extends UserController
{
    public function register(array $data)
    {
        return parent::create($data);
    }

    public function login(array $data)
    {
        $user = User::where('email', htmlspecialchars(trim($data['email'])))->first();
        if($this->checkPassword(htmlspecialchars(trim($data['password'])), $user->password)) {
            $token = hash('sha512', $user->id . $user->name . time());
            $user->session = $token;
            $user->update();
            //var_dump($_SESSION);
            return "User authorised, token: " . $token;
        } else return "User Not authorised";
    }

    protected function checkPassword($password, $known_hash)
    {
        return hash_equals($known_hash, hash('sha512', htmlspecialchars(trim($password))));
    }
}