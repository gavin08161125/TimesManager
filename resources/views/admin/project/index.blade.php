@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<style>
    .card {
        margin: 20px;
    }
</style>
@endsection


@section('main')
<div class="container">
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>標題</th>
                <th>專案開始時間</th>
                <th>專案截止時間</th>
                <th>專案總計時間</th>
                <th>描述</th>
                <th>擁有者</th>
                <th>功能</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr>
                <td>{{$project->title}}</td>
                <td>{{$project->startingtime}}</td>
                <td>{{$project->deadline}}</td>
                <td>{{$project->totaltime}}</td>
                <td>{{$project->description}}</td>
                <td>{{$project->owner}}</td>
                <td><a class='btn btn-success' href="/admin/project/edit/{{$project->id}}">編輯</a><a
                        class='btn btn-danger' href="/admin/project/destroy/{{$project->id}}">刪除</a></td>
            </tr>
            @endforeach
        </tbody>

    </table>
    <a class='btn btn-success'href="/admin/project/create" class="btn btn-sm">新增</a>
</div>


@endsection


@section('js')

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@endsection

