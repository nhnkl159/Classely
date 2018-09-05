<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


use App\models\UsersModel;
use App\models\Classes;
use App\models\GlobalMessages as GlobalMessages;
use App\models\Schools as Schools;

class WebsiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function checkRole()
    {
        //Check if our user has student role id
        if(UsersModel::checkUserForRole(Auth::user()->id, UsersModel::ROLE_STUDENT))
        {
            return redirect('/student/dashboard');
            
        }
    }

    public static function getRoleName($role_id)
    {
        if($role_id == UsersModel::ROLE_ROOT)
        {
            return 'root';
        }
        else if($role_id == UsersModel::ROLE_ADMIN)
        {
            return 'admin';
        }
        else if($role_id == UsersModel::ROLE_TEACHER)
        {
            return 'teacher';
        }
        else if($role_id == UsersModel::ROLE_PARENT)
        {
            return 'parent';
        }
        else if($role_id == UsersModel::ROLE_STUDENT)
        {
            return 'student';
        }
        else if($role_id == UsersModel::ROLE_BANNED)
        {
            return 'banned';
        }
    }
}
