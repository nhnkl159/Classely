<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use \App\Models\UsersModel as UsersModel;
use \App\Models\Register as Register;
use \App\Models\Schools as Schools;
use \App\Models\TempUsers as TempUsers;


class AuthController extends Controller
{
    use RegistersUsers;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logoutUser');
    }

    
    /**
     * Shows register page.
     *
     * @return void
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Shows login page.
     *
     * @return void
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */

    public function loginUser(Request $request)
    {
        if ($request->ajax())
        {
            $credentials = [
                'username' => $request['auth_username'],
                'password' => $request['auth_password'],
            ];

            if(Auth::attempt($credentials, ($request['auth_remember'] == 'on') ? true : false)) 
            {
                return response()->json([
                    'status' => true,
                    'message' => 'משתמש התחבר בהצלחה ! מעביר אותך לאתר...'
                ]);
            }
            else
            {
                return response()->json([
                    'status' => false,
                    'message' => 'תעודת הזהות או הסיסמה שגויים.'
                ]);
            }
        }
    }

    /**
     * Handle an logout attempt.
     *
     * @return void
     */

    public function logoutUser()
    {
        Auth::logout();
        
        return redirect('/login');
    }

    /**
     * Handle a register new student to the system attempt.
     * 
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */

     public function registerUser(Request $request)
     {
        if ($request->ajax())
        {
            ///Valiidate if all inputs are fine
            $this->validate($request, [
                'auth_schoolnum' => 'required|integer',
                'auth_username' => 'required|string|max:255',
                'auth_password' => 'required|string|min:6|confirmed',
                'auth_tos' => 'required'
            ], 
            [
                'auth_schoolnum.required' => 'שדה מספר בית הספר הוא חובה.',
                'auth_schoolnum.integer' => 'מספר בית ספר לא קיים.',
                'auth_username.required' => 'שדה שם המשתמש הוא חובה.',
                'auth_password.required' => 'שדה הסיסמה ואימות סיסמה הוא חובה.',
                'auth_password.confirmed' => 'שדה הסיסמה אינו זהה לאימות סיסמה.',
                'auth_password.min' => 'הסיסמא צריכה להיות באורך של מינימום 6 תווים.',
                'auth_tos.required' => 'כדי להירשם לאתר עליך להסכים לתנאי השימוש.',
            ]
            );
            
            //Save inputs into vars
            $school_number = $request['auth_schoolnum'];
            $username = $request['auth_username'];
            $password = $request['auth_password'];
            
            //Check if school is exist so we acn register this user.
            if(!Schools::where('school_number', $school_number)->exists())
            {
                return response()->json([
                    'status' => false,
                    'message' => 'מספר בית ספר לא קיים.'
                ]);
            }

            $school_data = Schools::where('school_number', $school_number)->first();

            if(Register::where('username', $username)->exists())
            {
                return response()->json([
                    'status' => false,
                    'message' => 'תעודת זהות כבר קיימת במערכת, פנה לבית הספר כדי לקבל פרטים נוספים.'
                ]);
            }

            if(!TempUsers::where('id', $username)->where('school_id', $school_data->id)->exists())
            {
                return response()->json([
                    'status' => false,
                    'message' => 'תעודת זהות לא קיימת במערכת, פנה לבית הספר כדי לקבל פרטים נוספים.'
                ]);
            }

            $user_data = TempUsers::where('id', $username)->where('school_id', $school_data->id)->first();

            $array_user_data = json_decode($user_data->data,true);

            //Create User.
            $the_user = Register::create([
                'school_id' => $school_data->id,
                'status' => 0,
                'username' => $username,
                'password' => Hash::make($password),
                'role_id' => $user_data->role_id,
                'details' => '{ "description": "תלמיד בבית ספר", "firstName": "", "lastName": "", "address": "", "city": "", "zipcode": "", "phoneNumber": "", "gender": "", "dateOfBirth": "" }',
                'avatar' => 'avatar-boy1.svg',
                'reset_key' => str_random(10),
            ]);

            $user_id = json_decode($the_user, true)['id'];

            $the_user->classes_students()->attach($array_user_data['classes']);
            $the_user->students_subjects()->attach($array_user_data['subjects']);

            TempUsers::find($username)->delete();

            return response()->json([
                'status' => true,
                'message' => 'משתמש נרשם בהצלחה !'
            ]);
        }
     }



}
