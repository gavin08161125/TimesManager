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
        return view('admin.project.create');
    }

    public function store(Request $request)
    {
        $projects= $request->all();
        Project::create($projects);

        return redirect('/admin/project/');
    }

    public function edit($id)
    {
        $data = Project::find($id);

        return view('admin.project.edit',compact('data'));
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


