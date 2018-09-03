<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\UsersModel;
use App\models\Classes;
use App\models\GlobalMessages as GlobalMessages;
use App\models\Schools as Schools;
use Auth;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:'. UsersModel::ROLE_STUDENT);
        $this->middleware('checkstatus');
    }

    public function viewdashboard()
    {
        $globalmessages = new GlobalMessages;
        $messages = Schools::find(Auth::user()->school_id)->globalmessages()->take(5)->orderBy('created_at', 'desc')->get();
        return view('student.dashboard')->with('messages', $messages);
    }

    public function viewattendance()
    {
        return view('student.attendance');
    }
}
