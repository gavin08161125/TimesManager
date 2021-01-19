@extends('layouts.app')

@section('css')
<link href="{{ asset('css/boss.css') }}" rel="stylesheet">
@endsection

@section('main')

<div class="container d-flex">
    <div class="leftSide">
        <div class="greeting d-flex">
            <img src="{{asset('img/people-l.png')}}" width="80px">
            <div class="greeting-windows"></div>
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
            <div class="prompt-windows"></div>
            <img src="{{asset('img/people-r-29.png')}}" width="100px">
        </div>
    </div>
    <div class="rightSide">
        <div class="personal-inform d-flex">
            <table  style="width:80%">
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
            <div class="personal-photo"></div>
        </div>
        <!-- pie chart套件 -->
        <div class="pie-chart">
            <h1>本月專案概況</h1>
            <canvas  id="myChart" width="600" height="450"></canvas>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

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
    </script>
@endsection
