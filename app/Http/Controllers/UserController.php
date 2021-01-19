<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use App\Project;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{



    public function profile(){

        //admin
        if(User::find(auth()->user()->id)->authority == 1){
            $user = User::find(auth()->user()->id);
            $projects = Project::all();


            return view('admin.profile.admin' ,compact('user' ,'projects'));
        }elseif (User::find(auth()->user()->id)->authority == 2){
            $user = User::find(auth()->user()->id);
            $projects =User::find(auth()->user()->id)->projects ;

            return view('admin.profile.employee' ,compact('user' ,'projects'));
        }elseif (User::find(auth()->user()->id)->authority == 3){

            $user = User::find(auth()->user()->id);
            $projects =User::find(auth()->user()->id)->projects ;

            return view('admin.profile.employee' ,compact('user' ,'projects'));
        }




    }


    //
    public function index(){
        //抓取全部人員資料
        $users = User::all();

        return view('admin.usersController.index' ,compact('users'));
    }

    public function edit($id){
        //抓取全部人員資料
        $user = User::find($id);

        return view('admin.usersController.edit' ,compact('user'));
    }

    public function update(Request $request,$id){
        //抓取對應ID人員資料
        $user = User::find($id);
        //抓取$request資料
        $update = $request->all();
        //將舊資料更新為$request資料
        $userUpdate = $user->update($update);

        return redirect()->back()->with('alert', '更新成功!');
    }


    public function destroy($id){
        $users = User::find($id);
        $users->delete();

        return redirect()->back()->with('alert', '刪除人員成功!');
    }



    public function usersController(){
        $users = User::all();

        return view('admin.users.index' ,compact('users'));
    }

    public function pointLog($id){
        //抓取全部人員資料
        if(User::find(auth()->user()->authority == '1')){

            $tasks = Task::all();

            return view('admin.pointLog.index' ,compact('tasks'));

        }elseif(User::find(auth()->user()->authority == '2')){
            //
            $tasks = Project::find($id)->tasks;
            $reviewer = Task::all()->where('reviewer',auth()->user()->name);

            return view('admin.pointLog.index2' ,compact('tasks' , 'reviewer'));

        }else{
            //抓取執行者為自己的任務
            $tasks = Task::all()->where('picker',auth()->user()->name);

            return view('admin.pointLog.index' ,compact('tasks'));
        }

    }

}
