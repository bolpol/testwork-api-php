<?php
namespace App\Controller;

use App\Model\UserModel as User;

/**
 * Created by PhpStorm.
 * User: pirno
 * Date: 2/11/2019
 * Time: 12:35 PM
 */

class UserController
{
    /**
     * @param $user_id
     * @return mixed
     */
    public function get($user_id)
    {
        return User::find($user_id)->first();
    }

    /**
     * @param array $data
     * @return bool
     */
    protected function create(array $data)
    {
        //var_dump(hash('sha512', htmlspecialchars(trim($data['password']))));
        ///exit;
        $category = new User();
        $category->name = htmlspecialchars(trim($data['name']));
        $category->email = htmlspecialchars(trim($data['email']));
        $category->password = hash('sha512', htmlspecialchars(trim($data['password'])));
        $category->save();
        return true;
    }
}