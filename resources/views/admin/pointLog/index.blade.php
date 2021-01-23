
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@endsection


@section('main')

<div class="container">
    <div class="container">


            <h2>點數歷程</h2>
            <hr>

            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>獲得日期</th>
                        <th>任務名稱</th>
                        <th>專案</th>
                        <th>核發主管</th>
                        <th>任務花費時間</th>
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

            <a href="/admin/pointLog/detail_request
            " class="btn btn-success"> 點數詳細</a>


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
    </script>

    @endsection
