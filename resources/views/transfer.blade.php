<!-- resources/views/transfer.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Solana Transfer</title>
</head>
<body>
    <h1>Solana Transfer</h1>
    <form id="transfer-form">
        @csrf
        <label for="recipient">Recipient Address:</label>
        <input type="text" id="recipient" name="recipient" required>
        <br>
        <label for="amount">Amount (SOL):</label>
        <input type="number" id="amount" name="amount" step="0.01" required>
        <br>
        <button type="submit">Transfer</button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.7.0/web3.min.js"></script>
    <script src="{{ mix('js/transfer.js') }}"></script>
</body>
</html>