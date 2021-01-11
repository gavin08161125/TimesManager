<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use App\ProjectUser;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $tasks = Task::get();
        $porject = Project::get();

        $tasks = Project::find($request->id)->tasks;

        return view('admin.task.index', compact('tasks', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tasks = Project::find(auth()->user()->id)->tasks;



        foreach ($tasks as $task){
            $project = Project::find($task->project_id);
        };


        // $turn = (int)$request->id ;

        // dd($request->id);

        // $projects = Project::get();

        $members = Project::get();

        return view('admin.task.create', compact('project' , 'tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //
        $task = Task::find($id);
        Task::create([
            'name' => $request->name,
            'project_id' => $request->project_id,
            'startingtime' => $request->startingtime,
            'deadline' => $request->deadline,
            'totaltime' => $request->totaltime,
            'picker' => $request->picker,
        ]);


        return redirect()->route('taskHome', [$request->project_id]);
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
        $task = Task::find($id);

        $projects = Project::find($task->project_id);
        $members = Project::find($task->project_id)->users;

        return view('admin.task.edit', compact('task', 'projects', 'members'));
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

        $tasks = Task::where('project_id', $request->project_id);

        $tasks->update([
            'name' => $request->name,
            'project_id' => $request->project_id,
            'startingtime' => $request->startingtime,
            'deadline' => $request->deadline,
            'totaltime' => $request->totaltime,
            'picker' => $request->picker,
        ]);

        return redirect()->route('taskhome', [$request->project_id]);
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
        $tasks = Task::find($id);
        $projects = Task::find($id)->project_id;
        $tasks->delete();

        // return redirect('/admin/project/task/{id}');
        return redirect()->route('taskHome', [$projects]);
    }
}
