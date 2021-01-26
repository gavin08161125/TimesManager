<?php

namespace App\Http\Controllers;

use App\Talk;
use App\Task;
use App\User;
use App\Project;
use App\Department;
use App\ProjectUser;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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

        //刪除使用者
        $users = User::find($id);
        $users->delete();

        //刪除使用者時刪除其專案關聯
        $userTasks = ProjectUser::all()->where('user_id',$id);
        foreach($userTasks as $userTask){
            $userTask->delete();
        }

        return redirect()->back()->with('alert', '刪除人員成功!');
    }


    public function usersController()
    {
        //
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function pointLog()
    {
        //抓取全部人員資料
        //admin
        if (User::find(auth()->user()->authority == '1')) {

            //全部任務
            $tasks = Task::all();

            //使用者(主管以上)
            $managers = User::all()->filter(function ($value, $key) {
                return $value->authority < 3;
            });

            //使用者(員工)
            $members = User::all()->filter(function ($value, $key) {
                return $value->authority == 3;
            });


            return view('admin.pointLog.index', compact('tasks', 'managers','members'));
            //主管
        } elseif (User::find(auth()->user()->authority == '2')) {
            //抓取執行者為自己的任務
            $tasks = Task::all()->where('picker', auth()->user()->name);
            //抓取自己審核的資料
            $reviewer = Task::all()->where('reviewer', auth()->user()->name);

            return view('admin.pointLog.index2', compact('tasks', 'reviewer'));
        } else {
            //抓取執行者為自己的任務
            $tasks = Task::all()->where('picker', auth()->user()->name);

            return view('admin.pointLog.index3', compact('tasks'));
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

    public function imageChange(Request $request, $id)
    {
        $imgs = $request->img;
        // dd($imgs);
        $user = User::find($id);
        $userImg = User::find($id)->img;
        $emptyImg = "https://s.yimg.com/uu/api/res/1.2/luKvlUy8pZ9gTU0SS2pXbg--~B/aD02MDQ7dz05NjA7YXBwaWQ9eXRhY2h5b24-/https://o.aolcdn.com/images/dar/5845cadfecd996e0372f/5d178cb92a30bc72bbc71c33e3605223945a5fa7/aHR0cDovL28uYW9sY2RuLmNvbS9oc3Mvc3RvcmFnZS9taWRhcy8yMGI5ZmMzMmNiOWRmYTJlMGMzYmZmNzA2NzZlNzJmNC8yMDI2MjQxMjEvd2FsbHBhcGVyLWZvci1mYWNlYm9vay1wcm9maWxlLXBob3RvLmpwZw==";
        if ($request->hasFile('img')) {

            if (file_exists(public_path() . $user->img)) {
                File::delete(public_path() . $user->img);
            }

            // $files = Storage::disk('public')->put('/images', $request->file('img'));

            $path = $this->fileUpload($imgs,'product');
            $user->img = $path;
            $user->save();

        } else {

            $user->img = $emptyImg;
            $user->save();
        }



        return redirect()->back();
    }
 public function fileUpload($file,$dir){
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if( ! is_dir('upload/')){
            mkdir('upload/');
        }
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if ( ! is_dir('upload/'.$dir)) {
            mkdir('upload/'.$dir);
        }
        //取得檔案的副檔名
        $extension = $file->getClientOriginalExtension();
        //檔案名稱會被重新命名
        $filename = strval(time().md5(rand(100, 200))).'.'.$extension;
        //移動到指定路徑
        move_uploaded_file($file, public_path().'/upload/'.$dir.'/'.$filename);
        //回傳 資料庫儲存用的路徑格式
        return '/upload/'.$dir.'/'.$filename;
    }

}
