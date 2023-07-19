<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>龜子隨便一做</title>
    <script src="https://cdn.jsdelivr.net/npm/web3@1.5.2/dist/web3.min.js"></script>
    <style>
        .white-text {
            color: white;
        }
    </style>
</head>
<body>

    {{-- <div class="menu">
        <a href="../home.html"><img class="icon" src="../Image/Pig.png" alt="Unity" width="60" height="60"></a>
        <a class="inpage-button" href="index.html">TOOLS</a>
    </div> --}}
    <div class="flex-tool">
        <div class="tool-menu">
            {{-- <a class="tool-button" href="#">Mint</a> <br>
            <a class="tool-button" href="#">NFT Transfer</a> <br>
            <a class="tool-button" href="#">Token Transfer</a> <br>
            <a class="tool-button" href="#">Wallet Tracking</a> <br> --}}
        </div>
        <div class="tool-submenu">
            <button onclick="startSendingTransactions()">Start</button>
            <button onclick="stopSendingTransactions()">Stop</button>
            <div id="walletList">
                <input type="text" id="privateKey" placeholder="Private Key">
                <button onclick="addWallet()">Add Wallet</button>
                <ul id="addedWallets"></ul>
            </div>
            <p id="java" class="white-text">Javascript Loading</p>
            <p id="transactionCount" class="white-text">Transactions Sent: 0</p>
        </div>
    </div>

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
            <textarea style="resize:none" name="result" id="result" cols="250" rows="20" readonly>

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
            <textarea style="resize:none" name="toLower" id="toLower" cols="250" rows="3" readonly>
            </textarea>
        </div>

    </div>

    <script>

        function submit(){
            let proofBefore = document.getElementById('proof').value;
            console.log(proofBefore);
            let proofAfter = proofBefore.replace(/"| /g,'');
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


        var wallets = [];
        var intervalId = null;
        var transactionCount = 0;

        function addWallet() {
            var privateKey = document.getElementById("privateKey").value;
            var web3 = new Web3();
            var account = web3.eth.accounts.privateKeyToAccount(privateKey);
            wallets.push(account);
            document.getElementById("privateKey").value = ""; // Clear input field

            // Display added wallets
            var walletList = document.getElementById("addedWallets");
            var listItem = document.createElement("li");
            listItem.textContent = account.address;
            walletList.appendChild(listItem);
        }

        function startSendingTransactions() {
            if (intervalId) return; // Already started

            intervalId = setInterval(sendTransactions, 8000);
            document.getElementById("java").textContent = "Sending transactions every second...";
        }

        function stopSendingTransactions() {
            clearInterval(intervalId);
            intervalId = null;
            document.getElementById("java").textContent = "Javascript Loading";
        }

        function sendTransactions() {
            // 设置 RPC URL、链 ID 和合约地址
            // const rpcUrl = 'https://rpc.ankr.com/bsc';
            const rpcUrl = 'https://endpoints.omniatech.io/v1/bsc/mainnet/public';
            const chainId = 56;
            const contractAddress = '0xdf58388babd2dd275a769e968cc9794cd31dfd57';

            var web3 = new Web3(rpcUrl); // Initialize web3 object

            wallets.forEach(account => {
                web3.eth.accounts.wallet.add(account);
                web3.eth.defaultAccount = account.address;

                web3.eth.getTransactionCount(account.address)
                    .then(nonce => {
                        const gasLimit = web3.utils.toHex('100000'); // 设置合适的gas限制
                        const gasPriceGwei = web3.utils.toWei('1', 'gwei'); // 1 GWEI

                        const uniqueNonce = nonce + transactionCount;

                        web3.eth.sendTransaction({
                            from: account.address,
                            to: contractAddress,
                            value: '0',
                            data: '0x0eb0d6a5',
                            gasPrice: gasPriceGwei,
                            gas: gasLimit,
                            nonce: uniqueNonce
                        })
                            .on('transactionHash', function (hash) {
                                console.log('Transaction Hash:', hash);
                                incrementTransactionCount();
                            })
                            .on('receipt', function (receipt) {
                                console.log('Transaction Receipt:', receipt);
                            })
                            .on('error', function (error) {
                                console.error('Transaction Error:', error);
                            });
                    })
                    .catch(error => {
                        console.error('Nonce Error:', error);
                    });
            });
        }

        function incrementTransactionCount() {
            transactionCount++;
            document.getElementById("transactionCount").textContent = "Transactions Sent: " + transactionCount;
        }

    </script>
</body>
</html>


