<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/TimesManager.css') }}">

</head>

<body>
    <div class="container">
        <div class="menu">
            <ul>
                <li>新增專案</li>
                <li>加入專案成員</li>
                <li>刪除專案</li>
                <li>結束專案</li>
                <li>登出</li>
            </ul>
        </div>
        <div class="main">
            <nav class="progress_bar">專案名稱
                <span>100%</span>
            </nav>
            <div class="times_display">
                <span>專案總計__小時</span>
                <span>專案經過__小時</span>
                <span>專案餘剩__小時</span>
            </div>
            <div class="container">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>Column 1</th>
                            <th>Column 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Row 1 Data 1</td>
                            <td>Row 1 Data 2</td>
                        </tr>
                        <tr>
                            <td>Row 2 Data 1</td>
                            <td>Row 2 Data 2</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- <script src="{{ asset('js/TimesManager.js') }}"></script> --}}

    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready( function () {
        $('#myTable').DataTable();
    } );

    </script>


</body>



</html>
