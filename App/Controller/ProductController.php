<?php
namespace App\Controller;

use App\Model\ProductCategoryModel;
use App\Model\ProductModel as Product;
use App\Modifier\Auth;

/**
 * Created by PhpStorm.
 * User: pirno
 * Date: 2/11/2019
 * Time: 12:39 PM
 */


/**
 * Class ProductController
 * @package App\Controller
 */
class ProductController
{
    use Auth;

    public function get(int $id)
    {
        return Product::find($id);
    }

    // Add new entries to a database through an HTML form with PHP.
    public function create(array $data)
    {
        Auth::check($data['token']);
        $categories = new CategoryController();
        $product = new Product();
        $product->name = trim(htmlspecialchars($data['name']));
        if($product->save()) {
            $list = explode(',', $data['categories']);
            foreach ($list as $key=>$value) {
                $list[$key] = trim(htmlspecialchars($value));
                $cat_id = $categories->getIdByName(trim(htmlspecialchars($value)))->id;
                if(!is_null($cat_id)) {
                    $prod_cat = new ProductCategoryModel();
                    $prod_cat->prod_id = $product->id;
                    $prod_cat->cat_id = $cat_id;
                    $prod_cat->save();
                }
            }
            return true;
        }
        else
            return false;
    }

    // View all entries in a database and print them to an HTML document.
    public function read()
    {
        return Product::all();
    }

    // Update
    public function update(array $data)
    {
        Auth::check($data['token']);
        $product = Product::find($data['id']);
        $product->name = $data['name'];
        $product->save();
        return true;
    }

    public function delete(array $data)
    {
        Auth::check($data['token']);
        return Product::destroy($data['id']);
    }

}