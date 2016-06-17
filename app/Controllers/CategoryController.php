<?php
/**
 * Created by PhpStorm.
 * User: donghai
 * Date: 16/6/17
 * Time: 16:25
 */

namespace App\Controllers;
use App\Category;
class CategoryController
{
    public function show()
    {
        $category = Category::all();
        foreach($category as $k){
            echo ('<li>' . $k->name . $k->parent);
        }

    }

}