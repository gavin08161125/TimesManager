@extends('layouts.app')

@section('css')
    
@endsection

@section('main')
<div class="container">
    <h2>編輯工作項目</h2>
    <hr>
    <form action="/admin/task/update/{{$task->id}}" method="post">
        @csrf
        <div class="form-group">
            <label for="pro_id">專案</label>
            <input type="text" class="form-control" id="pro_id" name="pro_id" value="{{$task->pro_id}}" required>
        </div>
        <div class="form-group">
            <label for="name">工作</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$task->name}}" required>
        </div>
        <div class="form-group">
            <label for="startingtime">開始時間</label>
            <input type="datetime-local" class="form-control" id="startingtime" name="startingtime" value="{{date('Y-m-d\TH:i',strtotime($task->startingtime))}}" required>
        </div>

        <div class="form-group">
            <label for="deadline">結束時間</label>
            <input type="datetime-local" class="form-control" id="deadline" name="deadline" value="{{ date('Y-m-d\TH:i',strtotime($task->deadline))}}" required>
        </div>

        <div class="form-group">
            <label for="totaltime">總時長</label>
            <input type="number" class="form-control" id="totaltime" name="totaltime" value="{{$task->totaltime}}" required>
        </div>
        <div class="form-group">
            <label for="picker">執行者</label>
            <input type="text" class="form-control" id="picker" name="picker" value="{{$task->picker}}" required>
        </div>

        <button class="btn btn-primary">儲存</button>
    </form>
</div>
@endsection

@section('js')
    
@endsection