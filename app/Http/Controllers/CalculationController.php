<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;

use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class CalculationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function calculation(Request $request){

    

        $click = Task::find($request->input('task_id'))->update(['status' => '2']);

        $returnPoint=Task::find($request->input('task_id'))->task_point;

        $addPoint=Task::find($request->input('task_id'))->update(['add_point' => $returnPoint]);

        $sumPoint = Task::get()->where('user_id',$request->input('user_id'))->sum('add_point');

        $returnToUserPoint = User::find($request->input('user_id'))->update(['point' => $sumPoint]);


        return redirect()->route('taskHome', [$request->input('project_id')]);
    }
}
