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
        <h2>對話管理</h2>
        <hr>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>對話內容</th>
                    <th>刪除 </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($talks as $talk)

                <tr>
                    {{-- 對話內容 --}}
                    <td>{{Str::limit($talk->content,'36','...')}}</td>
                    {{-- 刪除 --}}
                    <td>
                        <a class='btn btn-danger btn-sm' href="/admin/talk/destroy/{{$talk->id}}"
                            onclick="javascript:return del();">刪除
                        </a>
                    </td>


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



      //點擊刪除按鈕跳出提示確認(button上綁定onclick="javascript:return del();)
      function del() {
        var msg= "確定要刪除此專案嗎！？"

        if ( confirm(msg) == true){
        return true;
        }else{
        return false;
        }
    }


    </script>




    @endsection
