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
    @csrf
    <h2>刪除專案成員</h2>
    <hr>
    <form action="/admin/project/add_member/destroy/{{$project->id}}" method="post">
        @csrf
        @method('get')
        {{-- <div class="form-group">
            <label for="exampleInputEmail1">專案名稱</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$project->id}}" required readonly>
        </div> --}}

        <div class="form-group">
            <label for="exampleInputPassword1">專案名稱</label>
            <select class="form-control" id="project_id" name="project_id"  >
                <option class="form-control" value="{{$project->id}}" required readonly>
                    {{$project->title}}
                </option>

            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">專案擁有者</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$project->owner}}" required disabled>
        </div>


        <div class="form-group">
            <label for="exampleInputPassword1">刪除專案成員</label>
            <select class="form-control" id="user_id" name="user_id" >
                @foreach ($users as $list)
                <option class="form-control" value="{{$list->id}}" required>
                    {{$list->name}}
                </option>
                @endforeach
            </select>
        </div>




        <div class="form-group form-check">

        </div>
        <button type="submit" class="btn btn-success">刪除</button>
        <a class="btn btn-success" href="/admin/project/">回上一頁</a>
    </form>

</div>



@endsection

@section('js')

@endsection
