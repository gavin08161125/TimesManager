@extends('layouts.app')

@section('css')
<link href="{{ asset('css/Dashboard(Employee).css') }}" rel="stylesheet">
<link href="{{ asset('css/template.css') }}" rel="stylesheet">

@endsection

@section('main')

<div class="container d-flex">
    <div class="leftSide">
        <div class="greeting d-flex">
            <img src="{{asset('img/people-l.png')}}" width="80px">

            <!-- Button trigger modal -->
            <button class="greeting-windows " data-toggle="modal" data-target="#exampleModal">
                {{$talks}}</button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">增加對話</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/admin/talk/create/{{auth()->user()->id}}" method="POST">
                            @csrf
                            <div class="modal-body">

                                <h5>增加對話:</h5><input type="text" class="form-control" id="content" name="content"
                                    required>

                            </div>
                            <div class="modal-footer">
                                <button class='btn btn-success'>新增</button>
                                <button type="button" class="btn btn-secondary " data-dismiss="modal">關閉</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="projects_owned ">
            <!-- use table套件 -->
            <table>
                <thead>
                    <tr>
                        <th>所有專案</th>
                        <th>剩餘任務</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($projects as $project)
                    <tr>
                        <th>{{$project->title}}</th>
                        <th>{{count($project->tasks->where('status','1'))}}</th>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
        <div class="prompt-box d-flex">
            <!-- Button trigger modal -->
            <button class="prompt-windows" data-toggle="modal" data-target="#exampleModal2">
                {{$talks2}}</button>
            <img src="{{asset('img/people-r-29.png')}}" width="100px">
             <!-- Modal -->
             <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLongTitle2" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLongTitle">增加對話</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <form action="/admin/talk/create/{{auth()->user()->id}}" method="POST">
                         @csrf
                         <div class="modal-body">

                             <h5>增加對話:</h5><input type="text" class="form-control" id="content" name="content" required>

                         </div>
                         <div class="modal-footer">
                             <button class='btn btn-success'>新增</button>
                             <button type="button" class="btn btn-secondary " data-dismiss="modal">關閉</button>
                         </div>
                     </form>

                 </div>
             </div>
         </div>
        </div>
    </div>
    <div class="rightSide">
        <div class="personal-inform d-flex">
            <table style="width:80%">
                <tbody>
                    <th>姓名&ensp;&ensp;&ensp;&ensp;</th>
                    <td>{{$user->name}}</td>
                    </tr>
                    <tr>
                        <th>業務職掌</th>
                        <td>{{$user->position}}</td>
                    </tr>
                    <tr>
                        <th>所屬部門</th>
                        <td>{{$user->department}}</td>
                    </tr>
                    <tr>
                        <th>員工編號</th>
                        <td>{{$user->id}}</td>
                    </tr>
                    <tr>
                        <th>聯絡電話</th>
                        <td>{{$user->phone}}</td>
                    </tr>
                    <tr>
                        <th>電子信箱</th>
                        <td>{{$user->email}}</td>
                    </tr>
                </tbody>
            </table>
            <div class="personal-photo"></div>
        </div>
        <!-- pie chart套件 -->
        <div class="point-section d-flex">
            <div class="point-box">目前<br>點數<br>
                {{$user->point}}
            </div>
            <a href="/admin/to_do_list/{{auth()->user()->id}}">
                <div class="diary-box">工作<br>日誌</div>
            </a>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
    integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
    integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

@endsection
