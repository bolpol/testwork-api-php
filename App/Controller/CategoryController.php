<?php
namespace App\Controller;

use App\Model\CategoryModel as Category;
use App\Modifier\Auth;

/**
 * Created by PhpStorm.
 * User: pirno
 * Date: 2/11/2019
 * Time: 12:39 PM
 */


class CategoryController
{
    use Auth;

    public function get($id)
    {
        return Category::find($id);
    }

    public function getIdByName($name) {
        return Category::where('name', $name)->first();
    }

    // Add new entries to a database through an HTML form with PHP.
    public function create(array $data)
    {
        Auth::check($data['token']);
        $category = new Category();
        $category->name = $data['name'];
        $category->save();
        return true;
    }

    // View all entries in a database and print them to an HTML document.
    public function read()
    {
        return Category::all();
    }

    // Update
    public function update(array $data)
    {
        Auth::check($data['token']);
        $category = Category::find($data['id']);
        $category->name = $data['name'];
        $category->save();
        return true;
    }

    public function delete(array $data)
    {
        Auth::check($data['token']);
        return Category::destroy($data['id']);
    }

}