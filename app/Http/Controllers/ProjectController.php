<?php

namespace App\Http\Controllers;



use App\ProjectUser;
use Illuminate\Http\Request;
use App\User;
use App\Project;
use phpDocumentor\Reflection\Types\This;

class ProjectController extends Controller
{
    public function index()
    {



        // $user = User::find(1);
        // $singleProjects=ProjectUser::get()->where('user_id',auth()->user()->id);

        // foreach($singleProjects as $singleProject){
        //     $singleProjectId = $singleProject->project_id;
        // }


        // $projects = Project::get();

        $projects =User::find(auth()->user()->id)->projects;


        // dd($projects);
        $myself = auth()->user()->email;

        return view('admin.project.index', compact('projects','myself'));


        // $project = auth()->user();

    }

    public function create(Request $request)
    {
        $myself = auth()->user()->email;
        return view('admin.project.create', compact('myself'));
    }

    public function store(Request $request)
    {
        $projects= Project::create($request->all());

        ProjectUser::create([
            'user_id' => auth()->user()->id,
            'project_id' => $projects->id
        ]);

        return redirect('/admin/project/');
    }

    public function edit($id)
    {
        $myself = auth()->user()->email;
        $data = Project::find($id);

        return view('admin.project.edit',compact('data','myself'));
    }




    public function update(Request $request, $id)
    {
        $products = Project::find($id);
        $update = $request->all();
        $products->update($update);

        return redirect('/admin/project/');
    }

    public function destroy($id)
    {
        $products = Project::find($id);
        $products->delete();
        return redirect('/admin/project/');
    }

}


