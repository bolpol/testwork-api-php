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


class ProductModel extends Model {

    protected $table = 'products';

    public $timestamps = false;

    public function __construct()
    {
        $capsule = new Capsule;
        $capsule->addConnection(CONNECTION);
        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function categories()
    {
        return $this
            ->hasMany('App\Model\ProductCategoryModel', 'prod_id', 'id')->get();
    }

}