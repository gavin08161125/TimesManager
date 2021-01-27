@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link href="{{ asset('css/lottery.css') }}" rel="stylesheet">
<style>
    #main {
        padding: 0 !important;
    }

    .filter {
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        position: relative;
        top: 0;
        left: 0;
    }

    h1 {
        margin-top: 20px;
    }
</style>
@endsection


@section('main')

<div class="filter" hidden>
    <div class="turntable">

        <span class="pointer"></span>
    </div>
</div>

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
    <button class='btn btn-success start' onclick="javascript:return lottory();">點我抽獎
    </button>
    @else
    <button class='btn btn-success start' onclick="alert('點數不足10點，無法抽獎！！');">點我抽獎
    </button>
    {{-- href="/admin/lotto/game/{{$user->id}}" --}}
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

    //點擊按鈕跳出抽獎提示確認並執行動作(button上綁定onclick="javascript:return lottory();)
    function lottory() {
    // 开始

        var msg = "抽獎須扣除10點任務點數，確定抽獎嗎?！？";
        if (confirm(msg)==true){
            var filter = $('.filter');
            var start = $('.start');
            var container = $('.container')
            run($('.pointer'));

            // 点击后禁用
            $(this).attr('disabled', 'disabled');
            //點擊按鈕移除hidden屬性
            filter.removeAttr('hidden');
            container.attr('hidden','hidden');
            //延遲刷新時間
            setTimeout('window.location.href="game/{{$user->id}}";',2000);

            return true;
            }else{
            return false;
            }

    }



    //lottery test
    // 假设iEnd是请求获得的奖品结果
        var iEnd = -1;
        setTimeout(function(){
            iEnd = Math.floor(Math.random() * 8);
            console.log(iEnd);
        }, 2000);

// 旋转
    function run(oPointer){
        var deg = 0, iSpeed = 20, timer = null, arr = [0, 90, 120, 180, 210, 270, 300, 330], circle = 5;
        timer = setInterval(function(){

        deg += iSpeed;
        if(deg >= 360){
            deg = deg % 360;
            circle--;
            circle <= 0 && (iSpeed *= 0.7);
        }

        if(iEnd !== -1 && circle <= 0 && Math.abs(arr[iEnd] - deg) <= iSpeed){
            clearInterval(timer);
            deg = arr[iEnd];
        }

        oPointer.css({
            'transform': 'rotate('+ deg +'deg)',
            'webkitTransform': 'rotate('+ deg +'deg)',
            'mozTransform': 'rotate('+ deg +'deg)'
        });

    }, 20);
}


    </script>

    @endsection
