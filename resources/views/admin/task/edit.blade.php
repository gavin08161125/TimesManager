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
            <select type="text" class="form-control" id="project_id" name="project_id"
                readonly required>
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
            <label for="totaltime">總時長</label>
            <input type="number" class="form-control" id="totaltime" name="totaltime" value="{{$task->totaltime}}"
                required>
        </div>
        <div class="form-group">
            <label for="picker">執行者</label>
            <select type="text" class="form-control" id="picker" name="picker" required>
                @foreach ($members as $member)
                <option value="{{$task->picker}}">{{$member->name}}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">儲存</button>
    </form>
</div>
@endsection

@section('js')

@endsection
