<?php
namespace App\Model;
/**
 * Created by PhpStorm.
 * User: pirno
 * Date: 2/11/2019
 * Time: 11:14 AM
 */

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model as Model;

require_once dirname(dirname(__DIR__)) . '/config.php';


class UserModel extends Model {

    protected $table = 'users';

    public $timestamps = false;

    public function __construct()
    {
        $capsule = new Capsule;
        $capsule->addConnection(CONNECTION);
        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
    }
}