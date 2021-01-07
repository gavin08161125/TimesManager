<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {

        $projects = Project::get();
        return view('admin.project.index', compact('projects'));
    }

    public function create(Request $request)
    {
        $myself = auth()->user()->email;
        return view('admin.project.create', compact('myself'));
    }

    public function store(Request $request)
    {
        $projects= $request->all();
        Project::create($projects);

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


