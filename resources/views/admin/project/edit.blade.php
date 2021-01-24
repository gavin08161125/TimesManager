@extends('layouts.app')

@section('css')

@endsection

@section('main')
<div class="container">
    <h2>編輯專案</h2>
    <hr>
    <form action="/admin/project/update/{{$project->id}}" method="post">
        @csrf
        <div class="form-group">
            <label for="title">專案名稱</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$project->title}}" required>
        </div>
        <div class="form-group">
            <label for="startingtime">開始時間</label>
            <input type="datetime-local" class="form-control" id="startingtime" name="startingtime" value="{{date('Y-m-d\TH:i',strtotime($project->startingtime))}}" required>
        </div>
        <div class="form-group">
            <label for="deadline">結束時間</label>
            <input type="datetime-local" class="form-control" id="deadline" name="deadline" value="{{date('Y-m-d\TH:i',strtotime($project->deadline))}}" required>
        </div>

        <div class="form-group">
            <label for="owner">擁有者</label>
            <input type="text" class="form-control select" id="owner" name="owner"  value="{{$project->owner}}" disabled required >

        </div>

        <div class="form-group">
            <label for="description">描述</label>
            <textarea class="form-control" id="description" rows="3" name="description" required>{{$project->description}}</textarea>
        </div>

        <button class="btn btn-primary saveBtn" >儲存</button>

    </form>
</div>
@endsection

@section('js')
{{-- <script>
     $(".saveBtn").click(function(){
            console.log($(this).arrt('data-userid'))

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: `http://127.0.0.1:8000/admin/project/update/{{$project->id}}`,
                data:{
                    user_id: $(this).data('userid'),
                    project_id: $(this).data('projectid'),
                    task_id: $(this).data('taskid'),
                    },


          });


        });




</script> --}}


@endsection
