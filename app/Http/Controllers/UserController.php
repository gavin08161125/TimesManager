<?php

namespace App\Http\Controllers;

use App\Talk;
use App\Task;
use App\User;
use App\Project;
use App\Department;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{


    public function profile()
    {

        //判斷對話是否為0以上
        if (count(Talk::all()) > 0) {
            //admin
            if (User::find(auth()->user()->id)->authority == 1) {
                //抓取所有小人對話
                $talks = Talk::all()->random()->content;
                $talks2 = Talk::all()->random()->content;

                $user = User::find(auth()->user()->id);
                $projects = Project::all();

                return view('admin.profile.admin', compact('user', 'projects', 'talks', 'talks2'));
                //主管
            } elseif (User::find(auth()->user()->id)->authority == 2) {
                //抓取所有小人對話
                $talks = Talk::all()->random()->content;
                $talks2 = Talk::all()->random()->content;

                $user = User::find(auth()->user()->id);
                $projects = User::find(auth()->user()->id)->projects;



                return view('admin.profile.employee', compact('user', 'projects', 'talks', 'talks2'));
                //組員
            } elseif (User::find(auth()->user()->id)->authority == 3) {
                //抓取所有小人對話
                $talks = Talk::all()->random()->content;
                $talks2 = Talk::all()->random()->content;

                $user = User::find(auth()->user()->id);
                $projects = User::find(auth()->user()->id)->projects;



                return view('admin.profile.employee', compact('user', 'projects', 'talks', 'talks2'));
            }
            //如果對話為0
        } elseif (User::find(auth()->user()->id)->authority == 1) {

            $talks = '點我可以新增對話唷！';
            $talks2 = '點我點我，說說話！';

            $user = User::find(auth()->user()->id);
            $projects = User::find(auth()->user()->id)->projects;



            return view('admin.profile.admin', compact('user', 'projects', 'talks', 'talks2'));
        } else {

            //抓取所有小人對話
            $talks = '點我可以新增對話唷！';
            $talks2 = '點我點我，說說話！';

            $user = User::find(auth()->user()->id);
            $projects = User::find(auth()->user()->id)->projects;


            return view('admin.profile.employee', compact('user', 'projects', 'talks', 'talks2'));
        }
    }


    //
    public function index()
    {
        //抓取全部人員資料
        $users = User::all();

        return view('admin.usersController.index', compact('users'));
    }

    public function edit($id)
    {
        //抓取全部人員資料
        $user = User::find($id);

        return view('admin.usersController.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        //抓取對應ID人員資料
        $user = User::find($id);
        //抓取$request資料
        $update = $request->all();
        //將舊資料更新為$request資料
        $userUpdate = $user->update($update);

        return redirect()->back()->with('alert', '更新成功!');
    }


    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();

        return redirect()->back()->with('alert', '刪除人員成功!');
    }


    public function usersController()
    {
        //
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function pointLog($id)
    {
        //抓取全部人員資料
        if (User::find(auth()->user()->authority == '1')) {

            $tasks = Task::all();

            return view('admin.pointLog.index', compact('tasks'));
        } elseif (User::find(auth()->user()->authority == '2')) {
            //
            $tasks = Task::all()->where('picker', auth()->user()->name);
            $reviewer = Task::all()->where('reviewer', auth()->user()->name);

            return view('admin.pointLog.index2', compact('tasks', 'reviewer'));
        } else {
            //抓取執行者為自己的任務
            $tasks = Task::all()->where('picker', auth()->user()->name);

            return view('admin.pointLog.index', compact('tasks'));
        }
    }

    //Talk小人說話相關
    public function indexTalk(Request $request)
    {
        if (User::find(auth()->user()->id)->authority == 1) {
            //抓取所有
            $talks = Talk::all();
        } else {
            //抓取自己創建的對話
            $talks = Talk::all()->where('user_id', auth()->user()->id);
        }

        return view('admin.talk.index', compact('talks'));
    }

    public function createTalk(Request $request)
    {
        $talks = Talk::create([
            'user_id' => auth()->user()->id,
            'content' => $request->content,
        ]);

        return redirect()->back();
    }

    public function deleteTalk($id)
    {
        $talks = Talk::find($id);
        $talks->delete();
        return redirect()->back();
    }
}
