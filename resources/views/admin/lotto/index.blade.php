@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

@endsection


@section('main')

<div class="container">
    <div class="container">
        <table id="myTable" class="display">
            <h1>中獎列表</h1>
            <hr>
            <thead>
                <tr>
                    <th>獎項</th>
                    <th>中獎者</th>
                    <th>中獎時間</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listOfAwards as $award)
                <tr>
                    {{-- 獎項 --}}
                    <td>{{$award->prize}}</td>
                    {{-- 中獎者 --}}
                    <td>{{$award->awarded}}</td>
                    {{-- 中獎時間 --}}
                    <td>{{$award->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- 抽獎 --}}
    @if ($user->point >= 10)

    <a class='btn btn-success' href="/admin/lotto/game/{{$user->id}}" onclick="javascript:return del();">點我抽獎
    </a>

    @endif

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
        var msg = "抽獎須扣除10點任務點數，確定抽獎嗎?！？";
        if (confirm(msg)==true){
        return true;
        }else{
        return false;
        }
    }

    </script>


    @endsection
