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
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                    data-target="#exampleModalLong{{$myList->id}}">
                    事項詳細
                </button>
                <a href="#" data-toggle="modal" class="list-group-item list-group-item-action flex-column align-items-start ">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{$myList->title}}</h5>
                        <small>{{$myList->created_at}}</small>

                    </div>
<<<<<<< HEAD
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
                                    <a class='btn btn-danger ' href="/admin/to_do_list/destroy/{{$myList->id}}">刪除</a>
                                    <button type="button" class="btn btn-secondary " data-dismiss="modal">關閉</button>
                                </div>
                            </form>
                            </button>
=======
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
                            <a class='btn btn-danger ' href="/admin/to_do_list/destroy/{{$myList->id}}" onclick="javascript:return del();">刪除</a>
                            <button type="button" class="btn btn-secondary " data-dismiss="modal">關閉</button>
>>>>>>> 67089e62270a812a61faa54372440823d2e4391c
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <button class='btn btn-success add_project'>新增</button>
            <button class="btn btn-success remove_add">取消新增</button>
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
        var msg = "您真的確定要刪除此事項嗎！？";
        if (confirm(msg)==true){
        return true;
        }else{
        return false;
        }
    }


</script>





@endsection
