<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;

use App\Models\UsersModel as UsersModel;



class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

        /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(Auth::user()->role_id == 5)
        {
            return view('student.noticeboard');
        }
    }

    public function indexsettings()
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


    public function indextudentscontact()
    {
        return view('global.studentscontact');
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
    * Handle a update settings function for user requests.
    * 
    * @param  \Illuminate\Http\Request $request
    *
    * @return Response
    */

    public function updatesettings(Request $request)
    {
        $email = '';
        $details = [];
        $password = '';

        if ($request->ajax())
        {
            if(isset($request['settings_email']))
            {
                $email = $request['settings_email'];

                if(!UsersModel::checkUserStatus(Auth::user()->id))
                {
                    if(empty($email))
                    {
                        return response()->json([
                            'status' => false,
                            'message' => 'לאחר הרישום למערכת חובה להוסיף דואר אלקטרוני ופרטים אישיים !'
                        ]);
                    }
                }
            }

            if(isset($request['settings_firstname']) || isset($request['settings_lastname']) || isset($request['settings_address']) || isset($request['settings_city']) || isset($request['settings_zipcode']) || isset($request['settings_dateOfBirth']) || isset($request['settings_phone']))
            {
                if(!UsersModel::checkUserStatus(Auth::user()->id))
                {
                    if(empty($request['settings_firstname']) || empty($request['settings_lastname']) || empty($request['settings_address']) || empty($request['settings_city']) || empty($request['settings_zipcode']) || empty($request['settings_dateOfBirth']) || empty($request['settings_phone']))
                    {
                        return response()->json([
                            'status' => false,
                            'message' => 'לאחר הרישום למערכת חובה להוסיף דואר אלקטרוני ופרטים אישיים !'
                        ]);
                    }
                }

                $details = [
                    'firstName' => $request['settings_firstname'],
                    'lastName' =>$request['settings_lastname'],
                    'address' =>$request['settings_address'],
                    'city' =>$request['settings_city'],
                    'zipcode' =>$request['settings_zipcode'],
                    'gender' =>$request['settings_gender'],
                    'dateOfBirth' =>$request['settings_dateOfBirth'],
                    'phoneNumber' =>$request['settings_phone'],
                ];
            }

            if(isset($request['settings_password']) || isset($request['settings_password_new']) || isset($request['settings_password_new_confirmation']))
            {
            ///Valiidate if all inputs are fine
            $this->validate($request, [
                'settings_password' => 'required|string|min:6',
                'settings_password_new' => 'required|string|min:6|confirmed'
            ], 
            [
                'settings_password.required' => 'שדה הסיסמה ואימות סיסמה הוא חובה.',
                'settings_password.min' => 'הסיסמא צריכה להיות באורך של מינימום 6 תווים.',
                'settings_password_new.required' => 'שדה הסיסמה ואימות סיסמה הוא חובה.',
                'settings_password_new.min' => 'הסיסמא צריכה להיות באורך של מינימום 6 תווים.',
                'settings_password_new.confirmed' => 'שדה הסיסמה אינו זהה לאימות סיסמה.',
            ]
            );

                $current_password = $request['settings_password'];
                $new_password = $request['settings_password_new'];

                $user_data = UsersModel::find(Auth::user()->id);

                if(!Hash::check($current_password, $user_data->password))
                {
                    return response()->json([
                        'status' => false,
                        'message' => 'סיסמא נוכחית לא נכונה !'
                    ]);
                }

                if(!UsersModel::checkUserStatus(Auth::user()->id))
                {
                    if(empty($email))
                    {
                        return response()->json([
                            'status' => false,
                            'message' => 'לאחר הרישום למערכת חובה להוסיף דואר אלקטרוני ופרטים אישיים !'
                        ]);
                    }
                }

                $password = Hash::make($new_password);
            }

            
            UsersModel::updateUserDetails(Auth::user()->id, $email, $details, $password);

            return response()->json([
                'status' => true,
                'message' => 'פרטים שונו בהצלחה !'
            ]);
        }
    }
}
