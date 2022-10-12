<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>龜子隨便一做</title>
</head>
<body>
    <div class="container">
        <h2>小功能</h2>
        <hr>
        <div>
            <div class="form-group">
                <label for="proof">轉換proof</label>
                <input type="text" class="form-control" id="proof" name="proof">
            </div>
            <button class="btn btn-primary" onclick="submit()" >送出</button>
        </div>

        <div>
            轉換結果:
            <textarea name="result" id="result" cols="30" rows="10">

            </textarea>
        </div>

    </div>

    <script>

        function submit(){
            console.log(草);
            let proofBefore = document.getElementById('proof').value();
            console.log(proofBefore);

        }

    </script>
</body>
</html>
