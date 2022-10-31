<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>龜子試做</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <div >
        <input  id="connect" type="submit" value="連接" onclick="login()">
    </div>

    <div>
        <label for="address">錢包:</label>
        <input class="input-area address" id="address" name="address" value="未連接" readonly></input>
    </div>

    <div>
        <label for="ethBlace">餘額:</label>
        <input class="input-area"  id="ethBlace" value="0" readonly></input>
    </div>

    <div>
        <label for="pk">私鑰(監測零塊打用):</label>
        <input class=""  id="pk"  onkeyup="this.value = this.value.replace(/^\s+|\s+$/g,'');" ></input>
    </div>


    <div>
        <label for="contract">合約:</label>
        <input class="contract"  id="contract" onkeyup="this.value = this.value.replace(/^\s+|\s+$/g,'').toLowerCase();" ></input>

        <label for="contract">開發者:</label>
        <input class="developer"  id="developer" onkeyup="this.value = this.value.replace(/^\s+|\s+$/g,'').toLowerCase();" ></input>


    </div>


    <div>
        <label for="price">價格:</label>
        <input class="price"  id="price" value="0" ></input>

        <label for="gasLimit">gaslimit:</label>
        <input class="gasLimit"  id="gasLimit" value="0" ></input>
    </div>

    <div>
        <label for="hex16">16進制:</label>
        <textarea name="hex16" rows="15" cols="200" class="hex16_d"  ></textarea>
    </div>

    <div>
        <input type="submit" value="手動mint" onclick="startMint()">
        <input type="submit" value="監測" onclick="start(1)">
        <!-- <input type="submit" value="停止監測" onclick="start(0)"> -->
        {{-- <input type="submit" value="快速" onclick="startPkMint()"> --}}
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/ethers/5.7.2/ethers.umd.min.js" integrity="sha512-FDcVY+g7vc5CXANbrTSg1K5qLyriCsGDYCE02Li1tXEYdNQPvLPHNE+rT2Mjei8N7fZbe0WLhw27j2SrGRpdMg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        // Web3Provider 包裝了一個標準的 Web3 提供程序，這是
        //MetaMask 作為 window.ethereum 注入每個頁面的內容
        const address = window.ethereum.selectedAddress
        const provider = new ethers.providers.Web3Provider(window.ethereum)

        //node
        url="wss://bold-red-sound.discover.quiknode.pro/c9232591ecff4b2f4cb425bccbc06b3b2a3565f0/";
        // url="wss://multi-radial-snowflake.ethereum-goerli.discover.quiknode.pro/c891d92d009f9e582de064cbcbf64d4ec911493a/";

        console.log(window.ethereum);
        // MetaMask 插件還允許簽署交易
        // 發送以太幣並支付更改區塊鏈內的狀態。
        // 為此​​，您需要帳戶簽名者...
        const signer = provider.getSigner()



        const abi = [
            /*【Token 資訊函式】--------------------------------------------*/
            "function name() external view returns (string _name)",
            "function symbol() external view returns (string _symbol)",
            "function tokenURI(uint256 _tokenId) external view returns (string)",
            // A distinct Uniform Resource Identifier (URI) for a given asset.


            /*【功能函式】--------------------------------------------*/
            // Authenticated Functions
            "function tokenByIndex(uint256 _index) external view returns (uint256)",
            // return The token identifier for the `_index`th NFT,

            "function tokenOfOwnerByIndex(address _owner, uint256 _index) external view returns (uint256)",
            // return The token identifier for the `_index`th NFT assigned to `_owner`,
            // 每個所有者可以同時擁有一個以上的 NFT。其獨特的 ID 可以識別每一個 NFT，結果可能會變得難以跟蹤 ID。所以合約將這些 ID 存儲在一個數組中，tokenOfOwnerByIndex 函數讓我們從數組中檢索這些信息。

            "function balanceOf(address _owner) external view returns (uint256)",
            // return The number of NFTs owned by `_owner`, possibly zero

            "function ownerOf(uint256 _tokenId) external view returns (address)",
            // Find the owner of an NFT

            "function safeTransferFrom(address _from, address _to, uint256 _tokenId, bytes data) external payable",

            // "function safeTransferFrom(address _from, address _to, uint256 _tokenId ) external payable",
            // Transfers the ownership of an NFT from one address to another address

            "function transferFrom(address _from, address _to, uint256 _tokenId) external payable",
            // Transfer ownership of an NFT

            "function approve(address _approved, uint256 _tokenId) external payable",

            "function setApprovalForAll(address _operator, bool _approved) external",

            "function getApproved(uint256 _tokenId) external view returns (address)",

            "function isApprovedForAll(address _owner, address _operator) external view returns (bool)",

            "function transfer(address _to, uint amount, bytes data,) returns (bool)",

            "function mint(address _to, uint256 _amount)",

            "function secureMint(bytes signature,uint256 allocation,uint256 count) returns (bool)",
              // Send some of your tokens to someone else
                // 发送指定数量的代币到指定地址
            // 'function transfers(address to, uint amount)',

            /*【事件函式】--------------------------------------------*/
            // Events
            "event secureMint(bytes signature,uint256 allocation,uint256 count)",
            "event Transfer(address indexed _from, address indexed _to, uint256 indexed _tokenId)",
            "event Approval(address indexed _owner, address indexed _approved, uint256 indexed _tokenId)",
            "event ApprovalForAll(address indexed _owner, address indexed _operator, bool _approved)"

        ];


        login();


        async function trsfer(toAddress,value,gasLimit,hex16){
            // const tempContract = new ethers.Contract(toAddress, abi, signer);
            // console.log(window.ethereum.selectedAddress);
           // "function safeTransferFrom(address _from, address _to, uint256 _tokenId, bytes data,{uint256 gasLimit , uint256 nonce}) external payable"
            // console.log("toAddress:",toAddress)
            // console.log("value:",ethers.utils.parseEther(value))
            // console.log("hex16:",hex16)

            if(!hex16){
                hex16 = null;
            }

            await signer.sendTransaction({
                to: toAddress,
                value: ethers.utils.parseEther(value),
                data: hex16,
                gasLimit: gasLimit,
            }).then(
                (resp) => {
                console.log('>>> transaction response: ', resp);
                },
                (error) => {
                console.log('>>> send tx error: ', error);
                },
            );

            // const tx = await tempContract.transfer(toAddress,ethers.utils.parseEther(value),"0x9ff054df0000000000000000000000000000000000000000000000000000000000000001",{
            //     gasLimit: 140000,
            //     nonce: 8 || undefined,
            // });
            // console.log(ethers.utils.parseEther(value));

            // const tx = tempContract.transfers(
            //     toAddress,
            //     ethers.utils.parseEther(value),
            // );


            // tx.then(
            //     (resp) => {
            //     console.log('>>> transaction response: ', resp);
            //     },
            //     (error) => {
            //     if (error?.code === 4001) {
            //         message.error(error?.message);
            //     }
            //     console.log('>>> send tx error: ', error);
            //     },
            // );




            // let blance =  ethers.utils.formatUnits(await provider.getBalance(signer.getAddress()));
            // console.log(blance);
            // tx = await tempContract.transfer("74148.eth", ethers.utils.parseEther("0"));



            // await tx.wait();

            // await provider.call({
            //     // Wrapped ETH address
            //     to: "0xF9FE8238bfB2601b46a52fBD34d55e958dE1e2e4",

            //     // `function deposit() payable`
            //     data: "0xd0e30db0",

            //     // 1 ether
            //     value: ethers.utils.parseEther("0.231")
            // }).then(
            //     (resp)=>{
            //         console.log('>>> transaction response: ', resp);},
            //     (error) => {
            //         console.log('>>> send tx error: ', error);},
            // );



        }


        async function login() {

            // MetaMask 需要請求權限才能連接用戶帳戶
            user = await provider.send("eth_requestAccounts", []);
            if(user){
                console.log('成功');
                getAddress = window.ethereum.selectedAddress;
                console.log('連線地址:',getAddress);
                const balanceInWei = (await provider.getBalance(getAddress));
                let balanceInEth = ethers.utils.formatEther(balanceInWei);
                console.log('餘額:',balanceInEth);
                //取得ETH(bigNumber)
                // balance = await provider.getBalance(getAddress);

                //轉換ETH(常規數字)
                // tBalcnce = ethers.utils.formatUnits(balance, 18);

                document.getElementById('connect').value = "已連接";
                document.getElementById('address').value = getAddress;
                document.getElementById('ethBlace').value = balanceInEth.substr(0, 6);

                getBlockNumber = await provider.getBlockNumber();
            }else{
                return "fail";
            }
        }

        // async function monitor(){
        //     const abi = [
        //         // Read-Only Functions
        //         "function balanceOf(address owner) view returns (uint256)",
        //         "function decimals() view returns (uint8)",
        //         "function symbol() view returns (string)",

        //         // Authenticated Functions
        //         "function transfer(address to, uint amount) returns (bool)",

        //         // Events
        //         "event Transfer(address indexed from, address indexed to, uint amount)"
        //     ];

        //     const address = "0xdAC17F958D2ee523a2206206994597C13D831ec7"

        //     let erc20_rw = new ethers.Contract(address, abi, provider);
        //     erc20_rw.on("Transfer", (from, to, amount,value,event) => {
        //         console.log('ff');
        //         console.log(JSON.stringify(value));
        //     });

        // }


        // const abi = [
        //         // Read-Only Functions
        //         "function balanceOf(address owner) view returns (uint256)",
        //         "function decimals() view returns (uint8)",
        //         "function symbol() view returns (string)",
        //         // Authenticated Functions
        //         "function mint(payableAmount ether, uint amount)returns (bool)",
        //         "function transfer(address to, uint amount) returns (bool)",

        //         // Events
        //         "event Mint(payableAmount ether, uint amount)",
        //         "event Transfer(address indexed _from, address indexed _to, uint256 indexed _tokenId)",
        //         "event Run(address indexed from, address indexed to, uint amount)"

        //     ];

        //     const address = "0xb16dfd9aaaf874fcb1db8a296375577c1baa6f21"

        //     const erc20 = new ethers.Contract(address, abi, provider);

        //     // erc20_rw.on("mint", (from, to, amount,value,event) => {
        //     //     console.log('ff');
        //     //     console.log(JSON.stringify(value));
        //     //     console.log(JSON.stringify(this.value));
        //     // });
        //     erc20.on("Transfer", (from, to, amount,value, event) => {
        //         console.log(value);
        //     });



        // const address = "0x7583B39Fdf2661C1101aBb418b5f13CDA9d5CAb0"

        // const erc721 = new ethers.Contract(address, abi, provider);

        // erc721.on("Transfer", (from, to, amount,value, event) => {
        //   if( from == "0x0000000000000000000000000000000000000000"){
        //     console.log(value);
        //     console.log('mint');
        //   }
        // });

        function monitorContract(contract, developer, state, pk, price, gasLimit, hex16) {
            var customWsProvider = new ethers.providers.WebSocketProvider(url);

            if(state == 1){


                console.log("監測合約",contract.toString());

                customWsProvider.on("pending", async (tx) => {
                await customWsProvider.getTransaction(tx).then(function (transaction) {

                    let checkTo = (transaction.to.toString()).toLowerCase();
                    let checkFrom = (transaction.from.toString()).toLowerCase();
                    let checkContract = contract;
                    let checkDeveloper = developer;

                    // console.log(transaction)

                    // console.log('checkContract:',checkContract);
                    // console.log('checkTo:',checkTo);
                    // console.log('checkDeveloper:',checkDeveloper);
                    // console.log('checkFrom:',checkFrom);
                    // console.log(transaction.maxFeePerGas);
                    // console.log(transaction.maxPriorityFeePerGas);
                    // console.log(transaction.gasPrice.mul(99));

                    if( checkTo == checkContract ){
                            console.log("pending")
                            console.log(transaction);

                            if(developer && checkFrom == checkDeveloper){
                                console.log("創作者操作");
                                console.log(transaction);
                                console.log("執行mint");

                                pkMint(pk , contract , price, gasLimit, hex16 ,transaction.maxFeePerGas ,transaction.maxPriorityFeePerGas)
                                customWsProvider.off("pending");
                            }
                        }

                    });
                });
            }else{
                // console.log("監測合約",contract.toString());
                // customWsProvider.on("pending", async (tx) => {
                // await customWsProvider.getTransaction(tx).then(function (transaction) {
                //         console.log(transaction.to == contract.toString());
                //         if( transaction.to == contract.toString() ){
                //             console.log("pending")
                //             console.log(transaction);
                //             customWsProvider.off("pending");
                //             console.log("停止監測");
                //             if(developer && transaction.from == developer.toString() ){
                //                 console.log("創作者操作");
                //                 console.log(transaction);
                //                 console.log("執行mint");
                //                 pkMint(pk,contract,price,gasLimit,hex16)

                //             }
                //         }

                //     });
                // });
            }


            // customWsProvider._websocket.on("error", async () => {
            //     console.log(`Unable to connect to ${ep.subdomain} retrying in 3s...`);
            //     setTimeout(init, 3000);
            // });
            // customWsProvider._websocket.on("close", async (code) => {
            //     console.log(
            //     `Connection lost with code ${code}! Attempting reconnect in 3s...`
            //     );
            //     customWsProvider._websocket.terminate();
            //     setTimeout(init, 3000);
            // });
        };


        function start(state){
            let contract = document.getElementById('contract').value;
            let developer = document.getElementById('developer').value;
            let price = document.getElementById('price').value;
            let gasLimit = parseInt(document.getElementById('gasLimit').value);
            let hex16 = document.getElementsByName('hex16')[0].value;
            let pk = document.getElementById('pk').value;

            if(contract){
                monitorContract(contract, developer, state, pk, price, gasLimit, hex16);
            }else{
                alert("請檢查合約");
            }

        }

        function startMint(){
            let contract = document.getElementById('contract').value;
            let price = document.getElementById('price').value;
            let gasLimit = parseInt(document.getElementById('gasLimit').value);
            let hex16 = document.getElementsByName('hex16')[0].value;

            console.log('contract:',contract)
            console.log('price:',price)
            console.log('gasLimit:',gasLimit)
            console.log('hex16:',hex16)

            if(contract){
                trsfer(contract,price,gasLimit,hex16)
            }else{
                alert("請檢查資料(合約、價格、gasLimit、16進制)");
            }

        }


        async function pkMint(pk ,address , price , gasLimit , hex16, maxFeePerGas,maxPriorityFeePerGas){
            const pkWallet = new ethers.Wallet(pk);
            let m = pkWallet.connect(provider);
            let trMaxPriorityFeePerGas = maxPriorityFeePerGas.mul(100).div(100);

            console.log('contract:',address);
            console.log('price:',price);
            console.log('gasLimit:',gasLimit);
            console.log('hex16:',hex16);
            console.log('pk:',pk);


            await m.sendTransaction({
                type: 2,
                to: address,
                value: ethers.utils.parseEther(price),
                data: hex16,
                gasLimit: gasLimit,
                // gasPrice:trGasPrice,
                maxFeePerGas:maxFeePerGas,
                maxPriorityFeePerGas:trMaxPriorityFeePerGas,
            }).then(
                (resp) => {
                console.log('>>> transaction response: ', resp);
                console.log("送出交易成功");
                },
                (error) => {
                console.log('>>> send tx error: ', error);
                },
            );

        }

        function startPkMint(){
            let contract = document.getElementById('contract').value;
            let price = document.getElementById('price').value;
            let gasLimit = parseInt(document.getElementById('gasLimit').value);
            let hex16 = document.getElementsByName('hex16')[0].value;
            let pk = document.getElementById('pk').value

            pkMint(pk ,contract , price , gasLimit ,hex16)
        }

    </script>
</body>
</html>

