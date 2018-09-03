<?php

namespace App\Models;

use \DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UsersModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    
    //Current Roles
    public const ROLE_ROOT = 1;
    public const ROLE_ADMIN = 2;
    public const ROLE_TEACHER = 3;
    public const ROLE_PARENT = 4;
    public const ROLE_STUDENT = 5;
    public const ROLE_BANNED = 6;


    public function schools()
    {
        return $this->belongsTo('App\Models\Schools', 'id');
    }

    public function teachers_subjects()
    {
        return $this->belongsToMany('App\Models\Subjects', 'teachers_subjects', 'teacher_id');
    }

    public function students_subjects()
    {
        return $this->belongsToMany('App\Models\Subjects', 'students_subjects', 'student_id', 'subject_id');
    }

    public function student_class()
    {
        return $this->belongsToMany('App\Models\Classes', 'classes_students', 'student_id', 'class_id');
    }


    /**
     * Handle a mysql query execution that updates user details depend on settings inputs. 
     *
     * @return void
     */

     public static function updateUserDetails($user_id, $email = '', $details = [], $password = '')
     {
         //Check if user wants to update email only
         if(!empty($email))
         {
            DB::table('users')->where('id', $user_id)->update(['email' => $email]);
         }

         //Check if user wants to update details only
         if(!empty($details))
         {
            $details = json_encode($details);
            DB::table('users')->where('id', $user_id)->update(['details' => $details]);
         }

         //Check if user wants to update passsword only
         if(!empty($password))
         {
            DB::table('users')->where('id', $user_id)->update(['password' => $password]);
         }
     }

    /**
     * Handle a mysql query execution that updates user status depend on settings inputs. 
     *
     * @return void
     */

    public static function updateUserStatus($user_id, $status)
    {
        if(self::checkUserExist($user_id))
        {
            DB::table('users')->where('id', $user_id)->update(['status' => $status]);
        }
    }

    /**
     * Handle a mysql query execution that updates user random avatar depend on gender input. 
     *
     * @return void
     */

    public static function updateUserAvatar($user_id, $avatar)
    {
        if(self::checkUserExist($user_id))
        {
            DB::table('users')->where('id', $user_id)->update(['avatar' => $avatar]);
        }
    }

    /**
     * Select the user details by id and check for user role.
     *
     * @return Boolean
     */
    public static function checkUserForRole($user_id, $role_id)
    {
        $user = DB::table('users')->select('role_id')->where('id', $user_id)->first();
        if($user->role_id == $role_id)
        {
            return true;
        }

        return false;
    }

    /**
     * Select the user by id and check if he exist.
     *
     * @return array
     */
    public static function checkUserStatus($user_id)
    {
        $user = DB::table('users')->select('status')->where('id', $user_id)->first();

        if($user->status == 1)
        {
            return true;
        }
        return false;
    }

    /**
     * Select the user status by id and check if use active.
     *
     * @return array
     */
    public static function checkUserExist($user_id)
    {
        $user = DB::table('users')->where('id', $user_id)->exists();

        if($user)
        {
            return true;
        }
        return false;
    }

    /**
     * Select the user status by id and check if use active.
     *
     * @return array
     */
    public static function checkUsernameExist($user_name)
    {
        $user = DB::table('users')->where('username', $user_name)->exists();

        if($user)
        {
            return true;
        }
        return false;
    }

    /**
     * Select the user details by id and return details decoded.
     *
     * @return array
     */
    public static function getUserDetails($user_id)
    {
        $user = DB::table('users')->select('details')->where('id', $user_id)->first();

        return json_decode($user->details);
    }

}
