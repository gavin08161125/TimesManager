@extends('layouts.app')

@section('css')

@endsection

@section('main')
<div class="container">
    <h2>編輯工作項目</h2>
    <hr>
    <form action="/admin/project/task/update/{{$task->id}}" method="post">
        @csrf
        <div class="form-group">
            <label for="project_id">專案</label>
            <select type="text" class="form-control" id="project_id" name="project_id" readonly required>
                <option value="{{$task->project_id}}">
                    {{$projects->title}}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="name">工作</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$task->name}}" required>
        </div>
        <div class="form-group">
            <label for="startingtime">開始時間</label>
            <input type="datetime-local" class="form-control" id="startingtime" name="startingtime"
                value="{{date('Y-m-d\TH:i',strtotime($task->startingtime))}}" required>
        </div>

        <div class="form-group">
            <label for="deadline">結束時間</label>
            <input type="datetime-local" class="form-control" id="deadline" name="deadline"
                value="{{ date('Y-m-d\TH:i',strtotime($task->deadline))}}" required>
        </div>

        <div class="form-group">
            <label for="totaltime">總共時長(小時)</label>
            <input type="number" class="form-control" id="totaltime" name="totaltime" value="{{$task->totaltime}}"
                required>
        </div>

        <div class="form-group">
            <label for="task_point">預計任務點數</label>
            <input type="number" class="form-control" id="task_point" name="task_point" value="{{$task->task_point}}"
                min="0" max="5" required>
        </div>

        {{-- <div class="form-group">
            <label for="user_id">員工編號</label>
            <select type="text" class="form-control" id="option" name="user_id" required>
                @foreach ($members as $member)
                <option value="{{$member->id}}" >{{$member->name}}</option>
                @endforeach
            </select>
        </div> --}}

        <div class="form-group">
            <label for="picker">執行者</label>
            <select type="text" class="form-control" id="option" name="picker" required>
                @foreach ($members as $member)
                <option value="{{$member->name}}">{{$member->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">描述</label>
            <textarea class="form-control" id="description" rows="3" name="description" required>{{$task->description}}</textarea>
        </div>

        <button class="btn btn-primary saveBtn" data-userid="userid" >儲存</button>
    </form>
</div>



@endsection

@section('js')
<script>
//  $(".pointBtn").click(function(){
//         console.log($(this).data('userid'))

//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });

//         $.ajax({
//             method: 'POST',
//             url: `http://127.0.0.1:8000/admin/project/update/{{}}`,
//             data:{
//                 user_id: $(this).data('userid'),
//                 project_id: $(this).data('projectid'),
//                 task_id: $(this).data('taskid'),
//                 },


//       });


//     });



// </script>


@endsection
