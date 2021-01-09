<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use App\ProjectUser;
use Illuminate\Http\Request;

class ProjectUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        ProjectUser::create([
            'project_id' => $request->project_id,
            'user_id' => $request->user_id,
        ]);

        return redirect('admin/project');
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
    public function edit($id,Request $request)
    {
        //
        $project = Project::find($id);
        $projects =  Project::all();
        $users = User::all();
        $users_list = Project::find($request->id)->users;

        return view('admin.projectUser.edit', compact('project', 'projects', 'users','users_list'));
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
    public function destroy($id,Request $request)
    {
        $project = Project::find($id);
        $projects =  Project::all();
        $users = Project::find($request->id)->users;

        $delete = ProjectUser::where('user_id',$request->user_id)->where('project_id',$request->project_id);

        $delete->delete();

        return view('admin.projectUser.delete', compact('project', 'projects', 'users'));

    }
}
