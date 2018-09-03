<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

use App\Models\Schools as Schools;
use App\Models\UsersModel as UsersModel;
use App\Models\Subjects as Subjects;
use App\Models\Classes as Classes;
use App\Models\Routine as Routine;
use App\Models\GlobalMessages;

class APIController extends Controller
{
    public function __construct()
    {
        //add excepts.
        $this->middleware('auth');
    }

    /**
    * Handle the noticeboard json api
    * 
    * @param  \Illuminate\Http\Request $request
    *
    * @return Response
    */
    public function noticeboard_json(Request $request)
    {
        if ($request->ajax())
        {
            $page_num = $request['page_number'];

            \Illuminate\Pagination\Paginator::currentPageResolver(function () use ($page_num) {
                return $page_num;
            });

            $messages = Schools::find(Auth::user()->school_id)->globalmessages()->orderBy('created_at', 'desc')->paginate(6);

            if(isset($request['totalpage']))
            {
                return $messages->lastPage();
            }

            return view('api.noticeboard')->with('messages', $messages);;
        }
    }

    /**
    * Handle the notice json api
    * 
    * @param  \Illuminate\Http\Request $request
    *
    * @return Response
    */
    public function notice_json(Request $request)
    {
        if ($request->ajax())
        {
            if(isset($request['id']))
            {
                $message_id = $request['id'];

                $message_data = GlobalMessages::find($message_id);

                if(Auth::user()->school_id == $message_data->school_id)
                {
                    if(!empty($message_data) && $message_data != null)
                    {
                        return response()->json([
                            'status' => true,
                            'title' => $message_data->title,
                            'by' => 'הנהלת בית הספר',
                            'type' => 'הודעה כללית',
                            'created_at' => humanTiming($message_data->created_at),
                            'body' => htmlspecialchars(strip_tags($message_data->body))
                        ]);
                    }
                }
                else
                {
                    return response()->json([
                        'status' => false,
                        'message' => 'אין גישה'
                    ], 500);
                }
            }

        }
    }

    /**
    * Handle the teachers json api
    * 
    * @param  \Illuminate\Http\Request $request
    *
    * @return Response
    */
    public function teachers_json(Request $request)
    {
        if ($request->ajax())
        {
            //TODO: Add Role Check
            $user_id = Auth::user()->id;

            //Subjects
            $subjects_ids = UsersModel::find($user_id)->students_subjects()->get();

            $teachers = collect();

            foreach($subjects_ids as $subject)
            {
                $teachers = $teachers->merge(Subjects::find($subject->id)->teachers()->get());
            }

            //Class
            $class_id = UsersModel::find($user_id)->student_class()->first();
            $teacher = Classes::find($class_id->id)->teacher()->get();

            $teachers = $teachers->merge($teacher);

            $teachers = $teachers->unique('id');

            $teachers = $teachers->map(function ($item, $key) {
                return collect($item)->except(['username', 'password', 'reset_key', 'remember_token', 'created_at', 'updated_at', 'role_id', 'status', 'school_id', 'pivot'])->toArray();
            });

            return response()->json([
                'status' => true,
                'data' => $teachers
            ]);
        }
    }

    /**
    * Handle the studentscontact json api
    * 
    * @param  \Illuminate\Http\Request $request
    *
    * @return Response
    */
    public function studentscontact_json(Request $request)
    {
        if ($request->ajax())
        {
            //TODO: Add Role Check
            $user_id = Auth::user()->id;

            $class_id = UsersModel::find($user_id)->student_class()->first();
            $students = Classes::find($class_id->id)->students()->get();

            $students = $students->map(function ($item, $key) {
                return collect($item)->except(['username', 'password', 'reset_key', 'remember_token', 'created_at', 'updated_at', 'role_id', 'status', 'school_id', 'pivot'])->toArray();
            });

            return response()->json([
                'status' => true,
                'data' => $students
            ]);
        }
    }

    /**
    * Handle the routine json api
    * 
    * @param  \Illuminate\Http\Request $request
    *
    * @return Response
    */
    public function routine_json(Request $request)
    {
        if ($request->ajax())
        {
            $user_id = Auth::user()->id;
            //Student
            if(Auth::user()->role_id == 5)
            {
                $tempArr = [];
                $class_id = UsersModel::find($user_id)->student_class()->first();
                $routine = Routine::where('class_id', $class_id->id)->get();
                
                foreach($routine as $class)
                {
                    $subject = Subjects::where('id', $class->subject_id)->first();
                    $tempArr[] = [
                      'title' => $subject->name,
                      'dow' => [$class->day_id-1],
                      'start' => $class->time_start,
                      'end' => $class->time_end,
                      'color' => $class->color,
                    ];
                }

                return response()->json($tempArr);
            }
            return response()->json([
                'status' => false
            ], 500);
        }
    }
}