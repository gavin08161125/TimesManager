<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use App\Project;
use App\ProjectUser;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;

class ProjectController extends Controller
{
    public function index()
    {
        if(User::find(auth()->user()->id)->authority == 1){
        //anmin
        //抓取所有專案
        $projects = Project::get();

        $myself = auth()->user()->name;
        return view('admin.project.index', compact('projects','myself'));
        }elseif(User::find(auth()->user()->id)->authority == 2){
        //主管
        //抓取目前使用者的所有專案
        $projects =User::find(auth()->user()->id)->projects;

        $myself = auth()->user()->name;
        return view('admin.project.index', compact('projects','myself'));
        }elseif(User::find(auth()->user()->id)->authority == 3){

        //組員
        $projects =User::find(auth()->user()->id)->projects;

        $myself = auth()->user()->name;
        return view('admin.project.employee', compact('projects','myself'));
        }

    }

    public function create()
    {
        //抓取目前使用者姓名
        $myself = auth()->user()->name;
        return view('admin.project.create', compact('myself'));
    }

    public function store(Request $request)
    {
        $projects= Project::create($request->all());

        //建立專案時建立專案與擁有者之資料
        ProjectUser::create([
            'user_id' => auth()->user()->id,
            'project_id' => $projects->id
        ]);

        return redirect('/admin/project/');
    }

    public function edit($id)
    {
        //抓取對應專案
        $project = Project::find($id);
        //抓取所有成員
        $users= User::all();
        return view('admin.project.edit',compact('project','users'));
    }


    public function update(Request $request, $id)
    {
        //更新專案
        $products = Project::find($id);
        $update = $request->all();
        $products->update($update);

        //更新專案時更新專案擁有者關聯
        ProjectUser::where('project_id',$id)->where('user_id',$request->input('user_id'));

        return redirect('/admin/project/');
    }

    public function destroy($id)
    {
        //刪除專案時刪除專案任務
        $deleteTask = Task::where('project_id',Project::find($id)->id);
        $deleteTask->delete();;

        //刪除專案時刪除專案成員
        $deleteAllMenber = ProjectUser::where('project_id',$id) ;
        $deleteAllMenber->delete();

        //刪除專案
        $products = Project::find($id);
        $products->delete();

        return redirect('/admin/project/');
    }

}


