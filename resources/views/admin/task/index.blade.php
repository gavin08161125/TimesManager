@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@endsection

@section('main')
<div class="container">

    {{-- <a class="btn btn-success" href="/admin/project/task/create/id">新增工作</a> --}}

    {{-- 抓取的id從indexfunction接過來，透過Form表單抓取id 把值post進create頁面 --}}
    <form action="/admin/project/task/create/{{$request->id}}" neme="id" id="id">
        <button class="btn btn-success " neme="id" id="id" value="{{$request->id}}">新增工作</button>
    </form>
    <hr>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>專案</th>
                <th>名稱</th>
                <th>開始時間</th>
                <th>結束時間</th>
                <th>總時長</th>
                <th>執行者</th>
                <th>任務點數</th>
                <th>編輯</th>
                <th>刪除</th>
                <th>任務結束</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td>{{$task->project_id}}</td>
                <td>{{$task->name}}</td>
                <td>{{$task->startingtime}}</td>
                <td>{{$task->deadline}}</td>
                <td>{{$task->totaltime}}</td>
                <td>{{$task->picker}}</td>
                <td>{{$task->task_point}}</td>
                <td><a class="btn btn-primary" href="/admin/project/task/edit/{{$task->id}}">編輯</td>
                <td><a class="btn btn-danger" href="/admin/project/task/destroy/{{$task->id}}">刪除</td>

                <td>

                    <form action="/admin/project/calculation/{{$task->user_id}}" >
                        <button value="{{$task->task_point}}" class="btn btn-primary" name="task_point" id="task_point">任務結束
                        </button>
                        <input type="number" value="{{$task->user_id}}" name="user_id" id="user_id" hidden>
                        <input type="number" value="{{$task->project_id}}"  name="project_id" id="project_id" hidden>
                        <input type="number" value="{{$task->id}}" name="id" id="id" hidden>
                    </form>

                </td>

            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

<script>
    $.noConflict();
    jQuery( document ).ready(function( $ ) {
        $('#myTable').DataTable();
    });
    // Code that uses other library's $ can follow here.
</script>
@endsection
