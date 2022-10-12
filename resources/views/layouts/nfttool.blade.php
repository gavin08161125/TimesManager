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

        <hr>

        <div style="display: flex">
            <div class="form-group">
                <label for="address">地址轉大小寫:</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>
            <button class="btn btn-primary" onclick="toLower()" >送出</button>
        </div>

        <div>
            <label for="toLower">轉換結果:</label>
            <textarea name="toLower" id="toLower" cols="250" rows="20">
            </textarea>
        </div>

    </div>

    <script>

        function submit(){
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

        function toLower(){
            let addressBefore = document.getElementById('address').value;


            if(addressBefore !== ""){
                let addressAfter = addressBefore.toLowerCase();
                let resultAddress= document.getElementById('toLower');
                resultAddress.value = addressAfter;

            }else{
                alert('調皮?')
            }
        }

    </script>
</body>
</html>
