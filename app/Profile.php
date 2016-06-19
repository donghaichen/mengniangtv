<?php
/**
 * Created by PhpStorm.
 * User: donghai
 * Date: 16/6/19
 * Time: 00:38
 */

namespace App;
use Illuminate\Database\Eloquent\Model as Eqloquent;

class Profile extends Eqloquent
{
    protected $table = 'user_profile';

}