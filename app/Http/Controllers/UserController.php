<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function usersController(){
        $allUsers = User::all();

        return view('admin.users.index' ,compact('allUsers'));
    }


    public function createDapartment(Request $request){
        $updeteUser = User::find($request->id)->id;

        Department::create([
            'user_id'=>  $updeteUser,
            'department' => $request->department,
            'position' => $request->position,
        ]);

    }

    public function updateDapartment(Request $request){

        $updeteUser = User::find($request->id)->id;

        Department::find($updeteUser) -> update([
            'user_id'=>  $updeteUser,
            'department' => $request->department,
            'position' => $request->position,
        ]);

    }

    public function authority(Request $request){

        $updeteUser = User::find($request->id);

        User::find($updeteUser) -> update([
            'authority'=>  $request->authority,
        ]);

    }

}
