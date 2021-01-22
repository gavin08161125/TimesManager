<?php use Illuminate\Support\Arr;?>
@extends('layouts.app')

@section('css')
<link href="{{ asset('css/boss.css') }}" rel="stylesheet">
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
        <div class="projects_owned">
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
    </div>
    <div class="rightSide">
        <div class="personal-inform d-flex">
            <table style="width:80%">
                <tbody>
                    <tr>
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
            
                <input id="file" type="file" onchange="upload(this)" style="display: none" />
                <button type="button" class="btn chg_img" name="button" value="Upload" onclick="thisFileUpload();">
                    <div class="personal-photo" style="background-image:url({{$user->img}});"></div>
                    
                </button>
            


        </div>
        <!-- pie chart套件 -->
        <div class="pie-chart">
            <h1>本月專案概況</h1>
            <canvas id="myChart" width="600" height="450"></canvas>
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
<!-- pie chart -->
<script>
    var ctx = document.getElementById('myChart').getContext('2d');

        var myPieChart = new Chart(ctx, {
        type: 'doughnut',

        data: {

            labels: ['執行中', '已結案' ],
            datasets: [{
                backgroundColor: ['#936331','#8FC0C4','#DD8B63'],
                data: [{{count($projects->where('status',1))}}, {{count($projects->where('status',2))}}]
            }]
        },
        options: {
            legend:{
                position:'bottom',
            }

        }
    });


    function thisFileUpload() { 
            document.getElementById("file").click();
        };

        function upload(e) {
            var _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var file = document.querySelector('#file').value
            console.log(file);
        var file = e.files[0];
        if (!file) {
            return;
        }

        var formData = new FormData;

        formData.append('img',file);
        formData.append('_token',_token);

        fetch('/admin/profile/upload_img/{{$user->id}}',{
            method:'POST',
            body:formData,
        });

        // e.value = '';
    }
</script>
@endsection