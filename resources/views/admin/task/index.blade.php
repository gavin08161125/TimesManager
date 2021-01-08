@extends('layouts.app')

@section('css')
    
@endsection

@section('main')
<div class="container">
    <a class="btn btn-success" href="/admin/task/create">新增工作</a>
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
                <th>編輯</th>
                <th>刪除</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td>{{$task->pro_id}}</td>
                <td>{{$task->name}}</td>
                <td>{{$task->startingtime}}</td>
                <td>{{$task->deadline}}</td>
                <td>{{$task->totaltime}}</td>
                <td>{{$task->picker}}</td>
                <td><a class="btn btn-primary" href="/admin/task/edit/{{$task->id}}">編輯</td>
                <td><a class="btn btn-danger" href="/admin/task/destroy/{{$task->id}}">刪除</td>
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