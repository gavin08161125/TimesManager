<?php use App\Project;?>

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
    <div class="container">

        <form class="hidden_text" action="/admin/project/store" method="post" hidden>
            <h2>新增專案</h2>
            <hr>
            @csrf
            <div class="form-group">
                <label for="title">專案名稱</label>
                <input type="text" class="form-control" id="title" name="title" required>
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
                <label for="owner">建立人</label>
                <input type="text" class="form-control" id="owner" name="owner" value="{{$myself}}" required readonly>
            </div>

            <div class="form-group">
                <label for="description">描述</label>
                <textarea class="form-control" id="description" rows="3" name="description" required></textarea>
            </div>
            <button class="btn btn-primary">新增</button>
        </form>


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

                    <td>
                        @if (floor((strtotime($project->deadline)-strtotime($project->startingtime))/3600) >= 1)
                        還有{{floor((strtotime($project->deadline)-strtotime($project->startingtime))/3600)}} 小時

                        @elseif(floor((strtotime($project->deadline)-strtotime($project->startingtime))/3600)+1 >0 &&
                        floor((strtotime($project->deadline)-strtotime($project->startingtime))/3600)+1 <= 1 )
                            {{floor((strtotime($project->deadline)-strtotime($project->startingtime))/60 )}} 分鐘 @else 鬧?
                            @endif </td> <td>{{$project->description}}</td>
                    <td>{{$project->owner}}</td>
                    <td><a class='btn btn-success btn-sm ' href="/admin/project/edit/{{$project->id}}">編輯</a>
                        <a class='btn btn-danger btn-sm' href="/admin/project/destroy/{{$project->id}}">刪除</a>
                        <a class='btn btn-success btn-sm' href="/admin/project/add_member/edit/{{$project->id}}">新增成員</a>
                        <a class='btn btn-danger btn-sm' href="/admin/project/add_member/destroy/{{$project->id}}">刪除成員</a></td>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>

        <button class='btn btn-success  btn-sm add_project'>新增</button>
        <button class="btn btn-success  btn-sm remove_add">取消新增</button>


        {{-- href="/admin/project/create" --}}
    </div>


    @endsection


    @section('js')

    <!-- #region datatables files -->


    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <script>
        $.noConflict();
    jQuery( document ).ready(function( $ ) {
        $('#myTable').DataTable();
    });
    // Code that uses other library's $ can follow here.
    </script>
    <script>
        var add = document.querySelector('.add_project')
    var hidden= document.querySelector('.remove_add')

     add.addEventListener('click', evt =>{

         var hidden_text = document.querySelector('.hidden_text')
         if(hidden_text.hasAttribute('hidden')){
            hidden_text.removeAttribute('hidden')
         }
        //  }else{
        //     hidden_text.setAttribute('hidden', 'hidden')
        //  }

     });

     hidden.addEventListener('click', evt =>{
        var hidden_text = document.querySelector('.hidden_text')
        hidden_text.setAttribute('hidden', 'hidden')
     });


    </script>

    @endsection
