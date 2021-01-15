<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use App\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $productUser = ProjectUser::find($request->user_id);

        //新增專案成員
        //判斷專案內是否已有該成員名單
        if (ProjectUser::where('project_id', $request->project_id)->where('user_id', $request->user_id)->exists()) {

            //如有該成員名單跳出訊息
            return redirect()->back()->with('alert', '該成員已在專案內!');
        } else {
            ProjectUser::create([
                'project_id' => $request->project_id,
                'user_id' => $request->user_id,
            ]);

            return redirect()->back()->with('alert', '新增成功!');
        }

        // return redirect('admin/project');
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
    public function edit($id, Request $request)
    {
        //抓出目前專案
        $project = Project::find($id);
        //抓出所有使用者
        $users = User::all();
        //抓出目前專案成員
        $users_list = Project::find($request->id)->users;

        return view('admin.projectUser.edit', compact('project', 'users', 'users_list'));
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

    public function deleteMember(Request $request)
    {

        //抓取指定成員
        $deleteMember = ProjectUser::where('user_id', $request->user_id)->where('project_id', $request->project_id);

        //抓取主管本身
        $mySelf = ProjectUser::where('user_id', auth()->user()->id)->where('project_id', $request->project_id);

        //增加判斷防呆，免去刪除自己(待改良)
        if($deleteMember == $mySelf){

            return redirect()->back()->with('alert', '無法刪除移除此成員!');

        }else{
            //刪除指定成員
            $deleteMember->delete();
            return redirect()->back()->with('alert', '刪除成功!');

        }



        // //挑選專案擁有者(待改良)

        // $users_list = Project::find($request->id)->users;

        //     if ($request->input('name') == $request->owner){
        //         return 'NOOOOOOOOOOO';
        //         return redirect()->back()->with('alert', '無法刪除移除專案擁有者!');

        //     }else{
        //         $deleteMember->delete();
        //         return redirect()->back()->with('alert', '刪除成功!');
        //     }


        return redirect('admin/project');
    }


    public function deleteSelect($id, Request $request)
    {

        //抓出目前專案
        $project = Project::find($id);

        //抓出目前專案所有成員
        $users = Project::find($request->id)->users;


        return view('admin.projectUser.delete', compact('project', 'users'));
    }
}
