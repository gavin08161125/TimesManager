@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

@endsection


@section('main')

<div class="container">
    <div class="container">
        @if (session('alert'))
        <div class="alert alert-success">
            {{ session('alert') }}
        </div>
        @endif
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>編號</th>
                    <th>姓名</th>
                    <th>部門</th>
                    <th>職務</th>
                    <th>信箱</th>
                    <th>任務點數</th>
                    <th>電話</th>
                    <th>權限</th>
                    <th>創建時間</th>
                    <th>功能 </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user)

                <tr>
                    {{-- 編號 --}}
                    <td>{{$user->id}}</td>
                    {{-- 姓名 --}}
                    <td>{{$user->name}}</td>
                    {{-- 部門 --}}
                    <td>{{$user->department}}</td>
                    {{-- 職務 --}}
                    <td>{{$user->position}}</td>
                    {{-- 信箱 --}}
                    <td>{{$user->email}}</td>
                    {{-- 任務點數 --}}
                    <td>{{$user->point}}</td>
                    {{-- 電話 --}}
                    <td>{{$user->phone}}</td>
                    {{-- 帳號權限 --}}
                    <td>{{$user->authority}}</td>
                    {{-- 創建時間 --}}
                    <td>{{$user->created_at}}</td>
                    {{-- 功能 --}}
                    <td>
                        <a class='btn btn-success btn-sm ' href="/admin/user/edit/{{$user->id}}">編輯
                        </a>

                        <a class='btn btn-danger btn-sm' href="/admin/user/destroy/{{$user->id}}"
                            onclick="javascript:return del();">刪除
                        </a>
                    </td>

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
    // Code that uses other library's $ can follow here.


     //點擊刪除按鈕跳出提示確認(button上綁定onclick="javascript:return del();)
     function del() {
        var msg = "您真的確定要刪除此人員嗎！？";
        if (confirm(msg)==true){
        return true;
        }else{
        return false;
        }
    }



    </script>

    @endsection
