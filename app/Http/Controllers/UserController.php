<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{


    //
    public function index(){
        //抓取全部人員資料
        $users = User::all();

        return view('admin.users.index' ,compact('users'));
    }

    public function edit($id){
        //抓取全部人員資料
        $user = User::find($id);

        return view('admin.users.edit' ,compact('user'));
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

}
