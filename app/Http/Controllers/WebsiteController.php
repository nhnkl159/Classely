<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\models\UsersModel;

class WebsiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewsettings()
    {
        if(!Auth::user()->status)
        {
            $data = json_decode(Auth::user()->details, true);
            if(!empty(Auth::user()->email) && !empty($data['firstName']) && !empty($data['lastName']) && !empty($data['address']) && !empty($data['city']) && !empty($data['zipcode']) && !empty($data['dateOfBirth']) && !empty($data['phoneNumber']))
            {
                $avatar = '';
                if($data['gender'] == 0)
                {
                    $avatar = 'avatar-boy'.rand(1,7).'.svg';
                }
                else
                {
                    $avatar = 'avatar-girl'.rand(1,7).'.svg';
                }
                UsersModel::updateUserStatus(Auth::user()->id, true);
                UsersModel::updateUserAvatar(Auth::user()->id, $avatar);
                return redirect('/');
            }
        }
        return view('global.settings');
    }

    public function viewnoticeboard()
    {
        return view('global.noticeboard');
    }

    public function viewteachers()
    {
        return view('global.teachers');
    }

    public function viewstudentscontact()
    {
        return view('global.studentscontact');
    }

    public function viewroutine()
    {
        return view('global.routine');
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
