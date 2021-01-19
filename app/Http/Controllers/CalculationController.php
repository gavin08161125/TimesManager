<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;

use App\Project;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class CalculationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addPoint(Request $request, $id)
    {
        //


    }


    public function feedBack(Request $request, $id)
    {
        //抓取任務對應到相對專案(hasOne)
        $product = Task::find($id)->project;
        //抓取任務
        $reviewer = User::find(auth()->user()->id)->name;

        $task = Task::find($id);
        return view('admin.task.point.point', compact('task', 'product','reviewer'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function calculation(Request $request, $id)
    {
        //抓取任務結束的request資料並且更新到欄位
        $catchData = Task::find($id)->update([
            'reviewer' => $request->reviewer,
            'add_point' => $request->add_point,
            'feedback' => $request->feedback,
        ]);

        //狀態值改變成2，讓按鈕disabled

        Task::find($id)->update(['status' => '2']);


        //抓取該任務執行者並將點數相加
        $sumPoint = Task::get()->where('picker', $request->picker)->sum('add_point');

        //把相加後的點數更新至使用者總點數
        $returnToUserPoint = User::where('name', $request->picker)->update(['point' => $sumPoint]);

        //回傳project的id回taskindex頁面，才能抓取對應的任務列表
        $projects = Task::find($id)->project_id;
        return redirect()->route('taskHome', [$projects]);



        //ajax區(已被更換)

        // $click = Task::find($request->input('task_id'))->update(['status' => '2']);

        // $returnPoint=Task::find($request->input('task_id'))->task_point;

        // $addPoint=Task::find($request->input('task_id'))->update(['add_point' => $returnPoint]);

        // $sumPoint = Task::get()->where('picker',$request->input('picker'))->sum('add_point');

        // $returnToUserPoint = User::where('name',$request->input('picker'))->update(['point' => $sumPoint]);
    }

    public function updatePoint()
    {
        //抓取該任務執行者並將點數相加
        $sumPoint = Task::get()->where('picker', auth()->user()->name)->sum('add_point');

        //把相加後的點數更新至使用者總點數
        $returnToUserPoint = User::where('name', auth()->user()->name)->update(['point' => $sumPoint]);

        return redirect()->back();
    }


    public function endProject($id)
    {





        //專案狀態值改變成2，讓按鈕disabled
        $click = Project::find($id)->update(['status' => 2]);

        //將結束專案下的Task之狀態改變成2，讓Task按鈕disabled
        $taskEnd = Task::whereIn('project_id', [$id])->update(['status' => 2]);

        return redirect()->back();
    }
}
