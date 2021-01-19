
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


        <h2>點數歷程</h2>
        <hr>

        <table id="myTable2" class="display">
            <thead>
                <tr>
                    <th>獲得日期</th>
                    <th>任務名稱</th>
                    <th>專案</th>
                    <th>核發主管</th>
                    <th>花費時間</th>
                    <th>獲得點數</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($tasks as $task)
                <tr>
                    {{-- 獲得日期 --}}
                    <td>{{$task->updated_at}}</td>
                    {{-- 任務名稱 --}}
                    <td>{{$task->name}}</td>
                    {{-- 專案 --}}
                    <td>{{$task->project->title}}</td>
                    {{-- 核發主管 --}}
                    <td>{{$task->project->owner}}</td>
                    {{-- 花費時間 --}}
                    <td>{{$task->totaltime}}</td>
                    {{-- 獲得點數 --}}
                    <td>{{$task->add_point}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>


                <h2>核發點數</h2>
            <hr>
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>獲得日期</th>
                        <th>任務名稱</th>
                        <th>專案</th>
                        <th>核發主管</th>
                        <th>花費時間</th>
                        <th>核發點數</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($reviewer as $reviewer)
                    <tr>
                        {{-- 獲得日期 --}}
                        <td>{{$reviewer->updated_at}}</td>
                        {{-- 任務名稱 --}}
                        <td>{{$reviewer->name}}</td>
                        {{-- 專案 --}}
                        <td>{{$reviewer->project->title}}</td>
                        {{-- 核發主管 --}}
                        <td>{{$reviewer->project->owner}}</td>
                        {{-- 花費時間 --}}
                        <td>{{$reviewer->totaltime}}</td>
                        {{-- 核發點數 --}}
                        <td>{{$reviewer->add_point}}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>


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

    $.noConflict();
    jQuery( document ).ready(function( $ ) {
        $('#myTable2').DataTable();
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
        var msg = "您真的確定要刪除此專案嗎！？";
        if (confirm(msg)==true){
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
