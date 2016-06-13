<?php
/**
 * Created by PhpStorm.
 * User: donghai
 * Date: 16/3/11
 * Time: 11:15
 */

namespace App\Controllers;
use Illuminate\Database\Capsule\Manager as Capsule;

class DatabaseController
{
    public function createTable()
    {


        Capsule::schema()->create('users', function($table)
        {
            $table->increments('id');
            $table->string('username', 40);
            $table->string('email')->unique();
            $table->timestamps();
        });
    }
}