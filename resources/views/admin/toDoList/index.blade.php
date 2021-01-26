<?php use App\Project;?>

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap-grid.min.css"
    integrity="sha512-cKoGpmS4czjv58PNt1YTHxg0wUDlctZyp9KUxQpdbAft+XqnyKvDvcGX0QYCgCohQenOuyGSl8l1f7/+axAqyg=="
    crossorigin="anonymous" />
<style>
    body {
        position: relative;
    }

    .btn-warning {
        background-color: #6c9575 !important;
        color: white;
        border: 1px #6c9575 solid;
    }

    .btn-warning:hover::before{
    -webkit-animation: spin 1s linear 1s 2 alternate;
    animation: spin 1s linear 1s 2 alternate;
}

.close{
font-size:0px;/*使span中的文字不顯示*/
cursor:pointer;/*使鼠標指針顯示為手型*/
display:inline-block;
width:100px;
height:100px;
line-height:100px;
border-radius:50%;/*使背景形狀顯示為圓形*/
background:#FFF;
color:#8b8ab3;
text-align:center;
/**/
-webkit-animation: moving 1s linear;
animation: moving 1s linear;
}


@-webkit-keyframes moving {
    from {
        opacity: 0;
        -webkit-transform: translateY(100%);
    }
    to {
        opacity: 1;
        -webkit-transform: translateY(0%);
    }
}
@keyframes moving {
    from {
        opacity: 0;
        transform: translateY(100%);
    }
    to {
        opacity: 1;
        transform: translateY(0%);
    }
}

.detail{
    font-size: 18px;
}


</style>
@endsection


@section('main')

<div class="container">
    @if (session('alert'))
    <div class="alert alert-success ">
        {{ session('alert') }}
    </div>
    @endif

    <div class="row">
        <div class="col-6">
            <h2>新增事項</h2>
            <hr>
            <form action="/admin/to_do_list/create/{{auth()->user()->id}}" class="hidden_text" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">標題</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="content">內文</label>
                    <textarea class="form-control" id="content" rows="3" name="content" required></textarea>
                </div>

                <button class="btn btn-primary">新增</button>

            </form>

        </div>
        <div class="col-6">
            @foreach ($myLists as $myList)
            <div class="list-group">
                <button type="button" class="btn btn-warning btn-sm detail" data-toggle="modal"
                    data-target="#exampleModalLong{{$myList->id}}">
                    事項詳細
                </button>
                <a href="#" data-toggle="modal"
                    class="list-group-item list-group-item-action flex-column align-items-start ">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{$myList->title}}</h5>
                        <small>{{$myList->created_at}}</small>

                    </div>
                    <p class="mb-1">{{$myList->content}}</small>

                </a>

                <div class="modal fade" id="exampleModalLong{{$myList->id}}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">編輯事項</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/admin/to_do_list/update/{{$myList->id}}">
                                <div class="modal-body">
                                    <h5>創建日期：{{$myList->created_at}}</h5>
                                    <hr>
                                    <h5>標題:</h5><input type="text" class="form-control" id="title" name="title"
                                        value="{{$myList->title}}" required>
                                    <hr>

                                    <h5>描述:</h5>
                                    <textarea class="form-control" id="content" rows="3" name="content"
                                        required>{{$myList->content}}</textarea>
                                </div>
                                <div class="modal-footer">
                                    <button class='btn btn-success'>儲存</button>
                                    <a class='btn btn-danger ' href="/admin/to_do_list/destroy/{{$myList->id}}" onclick="javescript: return del();">刪除</a>
                                    <button type="button" class="btn btn-secondary " data-dismiss="modal">關閉</button>
                                </div>
                            </form>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>


</div>



</div>


@endsection




@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"
    integrity="sha512-XKa9Hemdy1Ui3KSGgJdgMyYlUg1gM+QhL6cnlyTe2qzMCYm4nAZ1PsVerQzTTXzonUR+dmswHqgJPuwCq1MaAg=="
    crossorigin="anonymous">
</script>

<script>
       //點擊刪除按鈕跳出提示確認(button上綁定onclick="javascript:return del();)
       function del() {
        var msg = "您真的確定要刪除此事項嗎！？";
        if (confirm(msg)==true){
        return true;
        }else{
        return false;
        }
    }


</script>





@endsection
