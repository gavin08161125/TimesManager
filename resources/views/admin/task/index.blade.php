@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<style>
    .progress {
        font-size: 18px;
        height: 40px;
    }

    .progress-bar {
        border-right: 0.5px white dashed;
    }


    .color:nth-child(n) {

        background: #974F44 !important;
    }

    .color:nth-child(2n) {
        background: #ADA299 !important;
    }

    .color:nth-child(3n) {
        background: #93C7CB !important;
    }

    .color:nth-child(4n) {
        background: #E59D58 !important;
    }

    .color:nth-child(5n) {
        background: #CEC8C2 !important;
    }

    .color:nth-child(6n) {
        background: #E5B959 !important;
    }

    .color:nth-child(7n) {
        background: #809B82 !important;
    }
</style>

@endsection

@section('main')

<div class="container">


    {{-- 進度條 --}}
    <h3>任務進度</h3>
    <div class="progress">
        @foreach ($tasks as $task)
        @if($task->status == 2 )
        <div class="progress-bar progress-bar-striped  bg-danger color" role="progressbar" style="width: 100%;"
            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$task->name}}</div>
        @endif
        @endforeach
    </div>


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
                <th>預計獲得點數</th>
                <th>實際獲得點數</th>
                <th>編輯</th>
                <th>刪除</th>
                <th>任務結束</th>
                <th>任務詳細</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td>{{Str::limit($task->project->title,'18','...')}}</td>
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
                <td><a class="btn btn-danger" href="/admin/project/task/destroy/{{$task->id}}"
                        onclick="javascript:return del();">刪除</td>

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

                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal"
                        data-target="#exampleModalLong{{$task->id}}">
                        任務詳細
                    </button>
                </td>




                <div class="modal fade" id="exampleModalLong{{$task->id}}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">任務詳細</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5>專案名稱：{{$task->project->title}}</h5>
                                <hr>
                                <h5>任務名稱：{{$task->name}}</h5>
                                <hr>
                                <h5>預計獲得點數：{{$task->task_point}}</h5>
                                <hr>
                                <h5>實際獲得點數：{{$task->add_point}}</h5>
                                <hr>
                                <h5>任務敘述：</h5>
                                <textarea cols="55" rows="15" readonly>{{$task->description}}</textarea>
                                <hr>
                                <h5>任務反饋</h5>
                                <textarea cols="55" rows="10" readonly>{{$task->feedback}}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary " data-dismiss="modal">關閉</button>
                            </div>
                        </div>
                    </div>
                </div>

            </tr>
            @endforeach

        </tbody>
    </table>
    {{-- 抓取的id從indexfunction接過來，透過Form表單抓取id 把值post進create頁面 --}}
    <form action="/admin/project/task/create/{{$request->id}}" neme="id" id="id">
        <button class="btn btn-success " neme="id" id="id" value="{{$request->id}}">新增工作</button>
    </form>
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
