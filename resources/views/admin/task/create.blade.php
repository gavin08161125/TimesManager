@extends('layouts.app')

@section('css')

@endsection

@section('main')
<div class="container">
    <h2>新增工作項目</h2>
    <hr>
    <form action="/admin/task/store" method="post">
        @csrf
        {{-- {{$productType}} --}}
        <div class="form-group">
            <label for="project_id">專案</label>
            <select type="text" class="form-control" id="project_id" name="project_id" required>
                @foreach ($projects as $project)
                <option value="{{$project->id}}">{{$project->title}}</option>
                @endforeach
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
            <label for="totaltime">總時長</label>
            <input type="number" class="form-control" id="totaltime" name="totaltime" required>
        </div>
        <div class="form-group">
            <label for="picker">執行者</label>
            <input class="form-control" id="picker" name="picker" value=""   required>
        </div>

        <button class="btn btn-primary">新增</button>
    </form>
</div>
@endsection

@section('js')

@endsection
