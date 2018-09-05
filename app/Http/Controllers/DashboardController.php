<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\models\GlobalMessages as GlobalMessages;
use App\models\Schools as Schools;

class DashboardController extends Controller
{
    public function __construct()
    {
        //add excepts.
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
            $globalmessages = new GlobalMessages;
            $messages = Schools::find(Auth::user()->school_id)->globalmessages()->take(5)->orderBy('created_at', 'desc')->get();
            return view('student.dashboard')->with('messages', $messages);
        }
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
}
