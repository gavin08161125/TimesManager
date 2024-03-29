<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
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

        if(User::find(auth()->user()->id)->authority == 1){

        $tasks = Project::find($request->id)->tasks;

        // $porject = Project::get();

        return view('admin.task.index', compact('tasks', 'request'));
        }elseif(User::find(auth()->user()->id)->authority == 2){

        $tasks = Project::find($request->id)->tasks;

        return view('admin.task.index', compact('tasks', 'request'));
        }

        $porject = Project::get();

        $tasks = Project::find($request->id)->tasks;

        return view('admin.task.employee', compact('tasks', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        //

        // $myProject = ProjectUser::get()->where('user_id',auth()->user()->id);
        $myProject = Project::find($request->id);

        $myTasks = TasK::find(auth()->user()->id);

        $project_id = ProjectUser::find(auth()->user()->id);

        $projectsUsers =  Project::find($request->id)->users;

        // dd($projectsUsers);

        // $project = (Project::find(auth()->user()->id)->project_id);

        $projects = Project::get();

        $members = Project::get();

        return view('admin.task.create', compact('myProject', 'projectsUsers'));
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
        Task::create([
            'name' => $request->name,
            'project_id' => $request->project_id,
            'startingtime' => $request->startingtime,
            'deadline' => $request->deadline,
            'totaltime' => $request->totaltime,
            'picker' => $request->picker,
            'description' => $request->description,
            'task_point'=> $request->task_point,
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

        $tasks = Task::find($request->id);
        $taskDatas = $request->all();

        $tasks->update($taskDatas);

        return redirect()->route('taskHome', [$request->project_id]);
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
