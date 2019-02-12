<?php
/**
 * Created by PhpStorm.
 * User: pirno
 * Date: 2/12/2019
 * Time: 3:39 PM
 */

namespace App\Modifier;


use App\Model\UserModel;
use Gridonic\JsonResponse\ErrorJsonResponse;

/**
 * Trait Auth
 * @package App\Modifier
 */
trait Auth
{
    /**
     * @param $token - authorised token
     */
    public static function check($token)
    {
        if(!is_null(UserModel::where('session', htmlspecialchars(trim($token)))->first())) {
            (new ErrorJsonResponse([], 'Not valid token', 'Error title', 500, 'Bed request', []))->send();
            exit;
        }
    }
}