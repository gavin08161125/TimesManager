@extends('layouts.app')

@section('css')

@endsection

@section('main')

<div class="container">
    <h2>新增工作項目</h2>
    <hr>
    <form action="/admin/project/task/store/{id}" method="post">
        @csrf
        @method("get")
        {{-- {{$productType}} --}}
        <div class="form-group">
            <label for="project_id">專案</label>
            <select type="text" class="form-control" id="project_id" name="project_id" required>
                {{-- <option value="{{$project->id}}">{{$project->title}}</option> --}}
                <option value="{{$myProject->id}}" readonly>{{$myProject->title}}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="name">工作</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="startingtime">開始時間</label>
            <input type="datetime-local" class="form-control" id="startingtime" name="startingtime" required>
        </div>

        <div class="form-group">
            <label for="deadline">結束時間</label>
            <input type="datetime-local" class="form-control" id="deadline" name="deadline" required>
        </div>

        <div class="form-group">
            <label for="totaltime">總共時長(小時)</label>
            <input type="number" class="form-control" id="totaltime" name="totaltime" min="0" required>
        </div>

        <div class="form-group">
            <label for="task_point">任務點數</label>
            <input type="number" class="form-control" id="task_point" name="task_point" min="0" max="5" required>
        </div>

        <div class="form-group" hidden>
            <label for="user_id">員工編號</label>
            <select class="form-control" id="user_id" name="user_id" required readonly>
                @foreach ($projectsUsers as $projectsUser)
                <option value="{{$projectsUser->id}}">
                    {{$projectsUser->id}}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="picker">執行者</label>
            <select class="form-control" id="picker" name="picker" required>
                @foreach ($projectsUsers as $projectsUser)
                <option value="{{$projectsUser->name}}">{{$projectsUser->name}}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">新增</button>
    </form>
</div>
@endsection

@section('js')

@endsection
