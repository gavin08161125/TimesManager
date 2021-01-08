@extends('layouts.app')

@section('css')

@endsection

@section('main')
<div class="container">
    <h2>新增專案</h2>
    <hr>
    <form action="/admin/project/store" method="post">
        @csrf
        <div class="form-group">
            <label for="title">專案名稱</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="startingtime">開始時間</label>
<<<<<<< Updated upstream
            <input type="date"   class="form-control" id="startingtime" name="startingtime"  required>
        </div>
        <div class="form-group">
            <label for="deadline">結束時間</label>
            <input type="date"  class="form-control" id="deadline" name="deadline" required>
=======
            <input type="date" class="form-control" id="startingtime" name="startingtime" required>
        </div>
        <div class="form-group">
            <label for="deadline">結束時間</label>
            <input type="date" class="form-control" id="deadline" name="deadline" required>
>>>>>>> Stashed changes
        </div>

        <div class="form-group">
            <label for="owner">建立人</label>
            <input type="text" class="form-control" id="owner" name="owner" value="{{$myself}}" required disabled>
        </div>

        <div class="form-group">
            <label for="description">描述</label>
            <textarea class="form-control" id="description" rows="3" name="description" required></textarea>
        </div>

        <button class="btn btn-primary">新增</button>
    </form>
</div>
@endsection

@section('js')

@endsection
