@extends('layouts.app')

@section('css')

@endsection

@section('main')
<div class="container">
    <h2>任務>結算任務</h2>
    <hr>
    <form action="/admin/project/task/add_point/{{$task->id}}" method="post">
        @csrf
        <div class="form-group">
            <label for="project_id">專案</label>
            <input type="text" class="form-control" id="project_id" name="project_id" disabled
                value="{{$product->title}}" required>
        </div>

        <div class="form-group">
            <label for="title">任務</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$task->name}}" disabled required>
        </div>


        <div class="form-group">
            <label for="picker">執行者</label>
            <input type="text" class="form-control" id="picker" name="picker" readonly value="{{$task->picker}}"
                required>

        </div>

        <div class="form-group">
            <label for="picker">審核人</label>
            <input type="text" class="form-control" id="reviewer" name="reviewer" readonly value="{{$reviewer}}"
                required>

        </div>

        <div class="form-group">
            <label for="task_point">獎勵點數</label>
            <input type="number" class="form-control" id="add_point" name="add_point" value="" min="0" max="5"
                required>
        </div>

        <div class="form-group">
            <label for="feedback">任務反饋</label>
            <textarea class="form-control" id="feedback" name="feedback" value="" required></textarea>
        </div>




        <button value="{{$task->task_point}}" class="btn btn-primary  pointBtn" @if ($task->status == 2 ) disabled
            @endif
            data-picker="{{$task->picker}}" data-projectid="{{$task->project_id}}"
            data-taskid="{{$task->id}}" onclick="javascript:return del();">任務結束</button>

    </form>
</div>



@endsection

@section('js')

<script>
    $(".pointBtn").click(function(){
        console.log($(this).data('picker'))
        var picker= $(this).data('picker');
        var projectId = $(this).data('projectid');
        var taskId = $(this).data('taskid');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: 'GET',
            url: `http://127.0.0.1:8000/admin/project/calculation/${projectId}`,
            data:{
                // picker: $(this).data('picker'),
                project_id: $(this).data('projectid'),
                // task_id: $(this).data('taskid'),
                },

      });

    });


    function del() {
        var msg = "送出後點數會增加至任務執行者？確定嗎？";
        if (confirm(msg)==true){
        return true;
        }else{
        return false;
        }
    }
</script>

@endsection
