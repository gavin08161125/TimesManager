!DOCTYPE html>
<html>
<head>
    <title>Phantom Wallet Integration</title>
</head>
<body>
    <h1>Connect to Phantom Wallet</h1>
    <button id="connect-button">Connect Wallet</button>
    <p id="wallet-address"></p>

    <!-- 引入 Phantom 钱包的 JavaScript 文件 -->
    <script src="https://cdn.jsdelivr.net/npm/@solana/wallet-adapter-wallets@0.9.0/dist/wallet-adapter-wallets.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@solana/wallet-adapter-base@0.9.0/dist/wallet-adapter-base.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@solana/wallet-adapter-react@0.15.5/dist/wallet-adapter-react.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@solana/wallet-adapter-react-ui@0.9.0/dist/wallet-adapter-react-ui.umd.min.js"></script>

    <script>
        document.getElementById('connect-button').addEventListener('click', async function () {
            if (window.solana && window.solana.isPhantom) {
                try {
                    const resp = await window.solana.connect();
                    document.getElementById('wallet-address').innerText = 'Connected: ' + resp.publicKey.toString();
                } catch (err) {
                    console.error(err);
                }
            } else {
                alert('Phantom Wallet not installed');
            }
        });
    </script>
</body>
</html>