<?php use App\Project;?>

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<style>
    .dataTable  {
        text-align: center;
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
                <label for="title"> 專案名稱</label>
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
        <br>
        <h2>專案管理</h2>
        <hr>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>標題</th>
                    <th>專案開始時間</th>
                    <th>專案截止時間</th>
                    <th>專案總計時間</th>
                    {{-- <th>描述</th> --}}
                    {{-- <th>專案任務總計</th> --}}
                    {{-- <th>已完成任務總計</th> --}}
                    <th>未完成任務</th>
                    <th>擁有者</th>
                    <th>功能 </th>
                    <th>專案狀態 </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($projects as $project)

                <tr>
                    {{-- 標題 --}}
                    <td>{{Str::limit($project->title,'18','...')}}</td>
                    {{-- 專案開始時間 --}}
                    <td>{{$project->startingtime}}</td>
                    {{-- 專案截止時間 --}}
                    <td>{{$project->deadline}}</td>
                    {{-- 專案總計時間(小時) --}}
                    <td>
                        @if (floor((strtotime($project->deadline)-strtotime($project->startingtime))/3600) >= 1)
                        還有{{floor((strtotime($project->deadline)-strtotime($project->startingtime))/3600)}} 小時

                        @elseif(floor((strtotime($project->deadline)-strtotime($project->startingtime))/3600)+1 >0 &&
                        floor((strtotime($project->deadline)-strtotime($project->startingtime))/3600)+1 <= 1 )
                            {{floor((strtotime($project->deadline)-strtotime($project->startingtime))/60 )}} 分鐘 @else
                            請檢查專案開始時間與截止時間是否正確 @endif </td> {{-- 描述 --}} {{-- <td>{{$project->description}}</td> --}}
                            {{-- 任務總計 --}} {{-- <td>{{count($project->tasks)}}</td> --}} {{-- 已完成任務總計 --}}
                            {{-- <td>{{count($project->tasks->where('status','2'))}}</td> --}} {{-- 未完成任務總計 --}} <td>
                            {{count($project->tasks->where('status','1'))}}</td>
                    {{-- 擁有者 --}}
                    <td>{{$project->owner}}</td>
                    {{-- 功能 --}}
                    <td>
                        <a class='btn btn-success btn-sm  @if($project->status == 2) disabled @endif '
                            href="/admin/project/edit/{{$project->id}}">編輯
                        </a>
                        <a class='btn btn-danger btn-sm' href="/admin/project/destroy/{{$project->id}}"
                            onclick="javascript:return del();">刪除
                        </a>
                        {{-- <a class='btn btn-success btn-sm @if($project->status == 2) disabled @endif '
                            href="/admin/project/add_member/edit/{{$project->id}}">新增成員
                        </a> --}}
                        {{-- <a class='btn btn-danger btn-sm @if($project->status == 2) disabled @endif'
                            href="/admin/project/delete_select/{{$project->id}}">刪除成員
                        </a> --}}
                        {{-- <form action="/admin/project/task/{{$project->id}}">
                        <button class='btn btn-success btn-sm' name="id" value="{{$project->id}}">工作管理</button>
                        </form> --}}
                        <a href="/admin/project/task/{{$project->id}}" class='btn btn-success btn-sm' name="project_id"
                            data-project_id="{{$project->id}}">工作管理</a>

                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#exampleModalLong{{$project->id}}">
                            專案詳細
                        </button>
                    </td>
                    <td>@if($project->status == 1 ) 未完成 @elseif($project->status == 2) 已結案 @else 請檢察專案 @endif</td>

                    <div class="modal fade" id="exampleModalLong{{$project->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">專案詳細</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>專案名稱：{{$project->title}}</h5>
                                    <hr>
                                    <h5>任務總計：{{count($project->tasks)}}</h5>
                                    <hr>
                                    <h5>已完成任務總計：{{count($project->tasks->where('status','2'))}}</h5>
                                    <hr>
                                    <h5>未完成任務總計：{{count($project->tasks->where('status','1'))}}</h5>
                                    <hr>
                                    <h5>描述</h5>
                                    <textarea cols="55" rows="10" readonly>{{$project->description}}</textarea>
                                </div>
                                <div class="modal-footer">

                                    <a class='btn btn-success  @if($project->status == 2) disabled @endif '
                                        href="/admin/project/add_member/edit/{{$project->id}}">新增成員
                                    </a>

                                    <a class='btn btn-danger  @if($project->status == 2) disabled @endif'
                                        href="/admin/project/delete_select/{{$project->id}}">刪除成員
                                    </a>

                                    <a class='btn btn-danger  @if($project->status == 2) disabled @endif'
                                        href="/admin/project/endProject/{{$project->id}}"
                                        onclick="javascript:return endProject();">封存專案</a>


                                    <button type="button" class="btn btn-secondary " data-dismiss="modal">關閉</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </tr>
                @endforeach
            </tbody>

        </table>

        <button class='btn btn-success add_project'>新增</button>
        <button class="btn btn-success remove_add">取消新增</button>
    </div>


    @endsection


    @section('js')

    <!-- #region datatables files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"
        integrity="sha512-BmM0/BQlqh02wuK5Gz9yrbe7VyIVwOzD1o40yi1IsTjriX/NGF37NyXHfmFzIlMmoSIBXgqDiG1VNU6kB5dBbA=="
        crossorigin="anonymous"></script>

    <script>
        $.noConflict();
    jQuery( document ).ready(function( $ ) {
        $('#myTable').DataTable();
    });
    // Code that uses other library's $ can follow here.

    var add = document.querySelector('.add_project')
    var hidden= document.querySelector('.remove_add')
    //點擊新增按鈕移除hidden標籤，顯示畫面上的新增專案欄位
     add.addEventListener('click', evt =>{
         var hidden_text = document.querySelector('.hidden_text')
         if(hidden_text.hasAttribute('hidden')){
            hidden_text.removeAttribute('hidden')
         }

     });
    //點擊取消新增按鈕增加hidden標籤，隱藏畫面上的新增專案欄位
     hidden.addEventListener('click', evt =>{
        var hidden_text = document.querySelector('.hidden_text')
        hidden_text.setAttribute('hidden', 'hidden')
     });

     //點擊刪除按鈕跳出提示確認(button上綁定onclick="javascript:return del();)

     function del() {
        var msg= "確定要刪除此專案嗎！？"

        if ( confirm(msg) == true){
        return true;
        }else{
        return false;
        }
    }

    //
    //點擊刪除按鈕跳出提示確認(button上綁定onclick="javascript:return del();)
    function endProject() {
        var msg = "要封存此專案嗎？\n注意:如任務點數尚未發放，封存專案將會無法再行發放任務點數！！";
        if (confirm(msg)==true){
        return true;
        }else{
        return false;
        }
    }







    </script>




    @endsection
