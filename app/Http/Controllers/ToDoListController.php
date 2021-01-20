<?php

namespace App\Http\Controllers;

use App\ToDoList;
use Illuminate\Http\Request;

class ToDoListController extends Controller
{
    //
    public function index() {

        $myLists=ToDoList::all()->where('user_id',auth()->user()->id);

        return view('admin.toDoList.index' , compact('myLists'));
    }

    public function addList(Request $request,$id) {

        //建立工作事項
        ToDoList::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('alert','新增成功');
    }

    public function updateList(Request $request,$id) {



        //建立工作事項
        ToDoList::find($request->id)->update([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('alert','修改成功');
    }


    public function deleteList(Request $request,$id) {

        //建立工作事項
        ToDoList::find($request->id)->delete();


        return redirect()->back()->with('alert','刪除成功');
    }


}


