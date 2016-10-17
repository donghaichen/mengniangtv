<?php

namespace App\Controllers\Auth;

use App\User;
use Clovers\View\View;
use App\Controllers\BaseController;


class AuthController extends BaseController
{
   public function register()
   {
       $this->view = View::make('auth.register')->with('video',User::all());
   }
}
