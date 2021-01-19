@extends('layouts.app')

@section('css')

@endsection

@section('main')
<div class="container">
    @if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
    @endif
    <h2>編輯人員</h2>
    <hr>
    <form action="/admin/user/update/{{$user->id}}" method="post">
        @csrf
        <div class="form-group">
            <label for="id">人員編號</label>
            <input type="text" class="form-control" id="id" name="id" value="{{$user->id}}" required>
        </div>

        <div class="form-group">
            <label for="name">姓名</label>
            <input class="form-control" id="name" name="name" value="{{$user->name}}" required>
        </div>

        <div class="form-group">
            <label for="email">信箱</label>
            <input class="form-control" id="email" name="email" value="{{$user->email}}" required>
        </div>

        <div class="form-group">
            <label for="department">部門</label>
            <input class="form-control" id="department"name="department" value="{{$user->department}}" required>
        </div>

        <div class="form-group">
            <label for="position">職務</label>
            <input class="form-control" id="position"name="position" value="{{$user->position}}" required>
        </div>

        <div class="form-group">
            <label for="phone">電話</label>
            <input class="form-control" id="phone"name="phone" value="{{$user->phone}}" required>
        </div>

        <div class="form-group">
            <label for="point">任務點數</label>
            <input type="text" class="form-control" id="point" name="point" value="{{$user->point}}" >
        </div>

        <div class="form-group">
            <label for="authority">權限</label>
            <select type="text" class="form-control" id="authority" name="authority" value="{{$user->authority}}" required>

                <option value="1" @if ($user->authority ==  1)   selected  @endif >管理者</option>
                <option value="2" @if ($user->authority ==  2)   selected  @endif >主管</option>
                <option value="3" @if ($user->authority ==  3)   selected  @endif >員工</option>


            </select>
        </div>




        <button class="btn btn-primary">更新</button>
        <a class="btn btn-primary" href="/admin/user/">回上一頁</a>
    </form>
</div>
@endsection

@section('js')

@endsection
