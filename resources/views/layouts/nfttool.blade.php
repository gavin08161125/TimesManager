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
        <div style="display: flex">
            <div class="form-group">
                <label for="proof">轉換proof:</label>
                <input type="text" class="form-control" id="proof" name="proof">
            </div>
            <button class="btn btn-primary" onclick="submit()" >送出</button>
        </div>

        <div>
            <label for="result">轉換結果:</label>
            <textarea name="result" id="result" cols="250" rows="20">

            </textarea>
        </div>

    </div>

    <script>

        function submit(){

            console.log("草");
            let proofBefore = document.getElementById('proof').value;
            console.log(proofBefore);
            let proofAfter = proofBefore.replace(/"/g,'');
            console.log(proofAfter);

            if(proofBefore !== ""){

                let resultText= document.getElementById('result');
                resultText.value = proofAfter;

            }else{
                alert('調皮?')
            }


        }

    </script>
</body>
</html>
