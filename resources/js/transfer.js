// resources/js/transfer.js

import { Connection, Keypair, PublicKey, SystemProgram, Transaction, sendAndConfirmTransaction } from '@solana/web3.js';

document.getElementById('transfer-form').addEventListener('submit', async function(event) {
    event.preventDefault();

    const recipient = document.getElementById('recipient').value;
    const amount = parseFloat(document.getElementById('amount').value) * 1e9; // Convert SOL to Lamports

    // Replace with your own secret key array
    const secretKeyArray = [/* your secret key array here */];
    const fromWallet = Keypair.fromSecretKey(Uint8Array.from(secretKeyArray));
    
    const connection = new Connection('https://api.mainnet-beta.solana.com', 'confirmed');

    const transaction = new Transaction().add(
        SystemProgram.transfer({
            fromPubkey: fromWallet.publicKey,
            toPubkey: new PublicKey(recipient),
            lamports: amount,
        })
    );

    try {
        const signature = await sendAndConfirmTransaction(connection, transaction, [fromWallet]);
        console.log('Transaction successful, signature:', signature);
    } catch (error) {
        console.error('Transaction failed', error);
    }
});