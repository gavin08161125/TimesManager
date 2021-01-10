@extends('layouts.app')

@section('css')

@endsection

@section('main')
<div class="container">
    <h2>編輯專案</h2>
    <a href="/admin/project/task/" class="btn btn-info">工作項目(Tasks)</a>
    <hr>
    <form action="/admin/project/update/{{$data->id}}" method="post">
        @csrf
        <div class="form-group">
            <label for="title">專案名稱</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$data->title}}" required>
        </div>
        <div class="form-group">
            <label for="startingtime">開始時間</label>
            <input type="datetime-local" class="form-control" id="startingtime" name="startingtime" value="{{date('Y-m-d\TH:i',strtotime($data->startingtime))}}" required>
        </div>
        <div class="form-group">
            <label for="deadline">結束時間</label>
            <input type="datetime-local" class="form-control" id="deadline" name="deadline" value="{{date('Y-m-d\TH:i',strtotime($data->deadline))}}" required>
        </div>

        <div class="form-group">
            <label for="owner">建立人</label>
            <input type="text" class="form-control" id="owner" name="owner" value="{{$myself}}"required disabled>
        </div>

        <div class="form-group">
            <label for="description">描述</label>
            <textarea class="form-control" id="description" rows="3" name="description" required>{{$data->description}}</textarea>
        </div>

        <button class="btn btn-primary">儲存</button>
    </form>
</div>
@endsection

@section('js')

@endsection
