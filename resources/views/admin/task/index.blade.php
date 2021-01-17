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
                <th>預計獲得任務點數</th>
                <th>實際獲得任務點數</th>
                <th>編輯</th>
                <th>刪除</th>
                <th>任務結束</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td>{{$task->project->title}}</td>
                <td>{{$task->name}}</td>
                <td>{{$task->startingtime}}</td>
                <td>{{$task->deadline}}</td>
                <td>{{$task->totaltime}}</td>
                <td>{{$task->picker}}</td>
                <td>{{$task->task_point}}</td>
                <td>{{$task->add_point}}</td>
                {{-- <a class="btn btn-primary" href="/admin/project/task/edit/{{$task->id}}" > --}}
                <td>
                    <form action="/admin/project/task/edit/{{$task->id}} "> <button class="btn btn-primary "
                            @if($task->status == 2) disabled @endif >編輯</button></form>
                </td>
                <td><a class="btn btn-danger" href="/admin/project/task/destroy/{{$task->id}}" onclick="javascript:return del();" >刪除</td>

                <td>

                    {{-- <button value="{{$task->task_point}}" class="btn btn-primary pointBtn"@if ($task->status == 2 )
                    disabled @endif
                    data-picker="{{$task->picker}}" data-projectid="{{$task->project_id}}"
                    data-taskid="{{$task->id}}" onclick="location.reload()">任務結束</button> --}}


                    <form action="/admin/project/task/feedback/{{$task->id}}">
                        <button class="btn btn-primary pointBtn" @if ($task->status == 2 )
                            disabled @endif
                            data-picker="{{$task->picker}}" data-projectid="{{$task->project_id}}"
                            data-taskid="{{$task->id}}" >任務結束</button>
                    </form>
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>
</div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

<script>
    $.noConflict();
    jQuery( document ).ready(function( $ ) {
        $('#myTable').DataTable();
    });


    function del() {
        var msg = "您真的確定要刪除此任務嗎！？";
        if (confirm(msg)==true){
        return true;
        }else{
        return false;
        }
    }

    // $(".pointBtn").click(function(){
    //     console.log($(this).data('picker'))
    //     var picker= $(this).data('picker');
    //     var projectId = $(this).data('projectid');
    //     var taskId = $(this).data('taskid');

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     $.ajax({
    //         method: 'GET',
    //         url: `http://127.0.0.1:8000/admin/project/calculation/${projectId}`,
    //         data:{
    //             picker: $(this).data('picker'),
    //             project_id: $(this).data('projectid'),
    //             task_id: $(this).data('taskid'),
    //             },

    //   });


    // });


</script>
@endsection
