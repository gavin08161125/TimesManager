@extends('layouts.app')

@section('css')

@endsection

@section('main')
<div class="container">
    <h2>點數歷程>主管核發點數查詢</h2>
    <hr>
    <form action="/admin/point_log/detail_manager" method="get">
        @csrf

        <div class="form-group" hidden>
            <label for="user">名稱</label>
            <input class="form-control" id="user" name="user" value="{{$user}}" readonly>
        </div>

        <div class="form-group">
            <label for="project">專案名稱</label>
                <select class="form-control" id="project" name="project">
                    @foreach ($projects as $project)
                    <option value="{{$project->id}}">{{$project->title}}</option>
                    @endforeach
                </select>
        </div>

        <button class="btn btn-primary ">查詢</button>

    </form>
</div>
@endsection

@section('js')

@endsection
