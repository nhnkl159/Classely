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
use App\Models\Attendance as Attendance;
use App\Models\Behaviour as Behaviour;
use App\Models\ExamsSchedule as ExamsSchedule;
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

            $messages = Schools::find(Auth::user()->school_id)->globalmessages()->orderBy('global_messages.created_at', 'desc')
            ->join('schools', 'schools.academic_id', '=', 'global_messages.academic_id')
            ->where('schools.id',  Auth::user()->school_id)
            ->paginate(6);

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
            if($class_id != null)
            {
                $teacher = Classes::find($class_id->id)->teacher()->get();
    
                $teachers = $teachers->merge($teacher);
    
                $teachers = $teachers->unique('id');
            }
            
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

            if($class_id != null)
            {
                $students = Classes::find($class_id->id)->students()->get();

                $students = $students->map(function ($item, $key) {
                    return collect($item)->except(['username', 'password', 'reset_key', 'remember_token', 'created_at', 'updated_at', 'role_id', 'status', 'school_id', 'pivot'])->toArray();
                });
    
                return response()->json([
                    'status' => true,
                    'data' => $students
                ]);
            }

            return response()->json([
                'status' => false
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
                $tempArr = collect();
                $class_id = UsersModel::find($user_id)->student_class()->first();
                if($class_id != null)
                {
                    $routine = Routine::where('class_id', $class_id->id)->get();
                    
                    foreach($routine as $class)
                    {
                        $subject = Subjects::where('id', $class->subject_id)->first();
                        $tempArr->push([
                            'title' => $subject->name,
                            'dow' => [$class->day_id-1],
                            'start' => $class->time_start,
                            'end' => $class->time_end,
                            'color' => $class->color,
                        ]);
                    }
                    return response()->json($tempArr);
                }
            }
            return response()->json([
                'status' => false
            ]);
        }
    }

    /**
    * Handle the attendance json api
    * 
    * @param  \Illuminate\Http\Request $request
    *
    * @return Response
    */
    public function attendance_json(Request $request)
    {
        if ($request->ajax())
        {
            $user_id = Auth::user()->id;
            //Student
            if(Auth::user()->role_id == 5)
            {
                $tempArr = collect();

                $attendance = Attendance::where('student_id', $user_id)
                ->join('schools', 'schools.academic_id', '=', 'students_attendance.academic_id')
                ->where('schools.id',  Auth::user()->school_id)
                ->get();
                
                foreach($attendance as $day)
                {
                    if($tempArr->contains('start', $day->att_date))
                    {
                        if($day->status == 1)
                        {
                            $key = $tempArr->search(function($item) use($day) {
                                return $item['start'] == $day->att_date;
                            });
                            $temp = $tempArr->toArray();
                            $temp[$key]['status'] = 1;
                            $tempArr = collect($temp);
                        }

                    }
                    else
                    {
                        $tempArr->push([
                          'start' => $day->att_date,
                          'status' => $day->status,
                        ]);
                    }
                }

                return response()->json($tempArr);
            }
            return response()->json([
                'status' => false
            ]);
        }
    }

    /**
    * Handle the behaviour json api
    * 
    * @param  \Illuminate\Http\Request $request
    *
    * @return Response
    */
    public function behaviour_json(Request $request)
    {
        if ($request->ajax())
        {
            $user_id = Auth::user()->id;
            //Student
            if(Auth::user()->role_id == 5)
            {
                $events = Behaviour::where('student_id', $user_id)->orderBy('behav_date', 'desc')
                ->join('behaviour_types', 'students_behaviour.behaviour_type', '=', 'behaviour_types.id')
                ->join('schools', 'schools.academic_id', '=', 'students_behaviour.academic_id')
                ->where('schools.id',  Auth::user()->school_id)
                ->get();

                return response()->json([
                    'status' => true,
                    'data' => $events
                ]);
            }

            return response()->json([
                'status' => false
            ]);
        }
    }

    /**
    * Handle the behaviour json api
    * 
    * @param  \Illuminate\Http\Request $request
    *
    * @return Response
    */
    public function behavior_chart(Request $request)
    {
        if ($request->ajax())
        {
            $user_id = Auth::user()->id;
            $tempArr = collect();
            $types = DB::table('behaviour_types')->get();
            //Student
            if(Auth::user()->role_id == 5)
            {
                foreach($types as $type)
                {
                    $tempArr[$type->behaviour_name] = Behaviour::where('behaviour_type', $type->id)->join('schools', 'schools.academic_id', '=', 'students_behaviour.academic_id')->where('schools.id',  Auth::user()->school_id)->count();
                }

                return response()->json([
                    'status' => true,
                    'data' => $tempArr
                ]);
            }

            return response()->json([
                'status' => false
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
    public function exams_schedule_json(Request $request)
    {
        if ($request->ajax())
        {
            $user_id = Auth::user()->id;
            //Student
            if(Auth::user()->role_id == 5)
            {
                $tempArr = collect();
                $exams = collect();
                $subjects_ids = UsersModel::find($user_id)->students_subjects()->get();

                foreach($subjects_ids as $subject)
                {
                    $events = ExamsSchedule::where('subject_id', $subject->id)
                    ->join('exams_types', 'exams_schedule.exam_type', '=', 'exams_types.id')
                    ->join('schools', 'schools.academic_id', '=', 'exams_schedule.academic_id')
                    ->where('schools.id',  Auth::user()->school_id)
                    ->get();

                    $exams = $exams->merge($events);
                }

                foreach($exams as $exam)
                {
                    $subject = Subjects::where('id', $exam->subject_id)->first();
                    $tempArr->push([
                        'title' => $exam->name . ' - '. $subject->name,
                        'start' => $exam->exam_start,
                        'end' => $exam->exam_end,
                        'color' => $exam->color,
                    ]);
                }
                return response()->json($tempArr);
                
            }
            return response()->json([
                'status' => false
            ]);
        }
    }

}
