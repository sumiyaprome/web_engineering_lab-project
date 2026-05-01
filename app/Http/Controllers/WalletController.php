<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\WalletDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    /**
     * Show wallet details
     */
    public function show()
    {
        $wallet = Wallet::where('customer_id', Auth::id())
            ->with('walletDetails')
            ->firstOrFail();

        return view('wallet.show', compact('wallet'));
    }

    /**
     * Add balance to wallet
     */
    public function addBalance(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'card_number' => 'required|digits:16',
            'cvv' => 'required|digits:3',
        ]);

        $wallet = Wallet::where('customer_id', Auth::id())->firstOrFail();
        $walletDetail = $wallet->walletDetails()->first();

        // Verify card (simple check for demo)
        if ($walletDetail->cvv != $request->cvv) {
            return back()->with('error', 'Invalid CVV');
        }

        // Update balance
        $walletDetail->balance += $request->amount;
        $walletDetail->save();

        return back()->with('success', 'Balance added successfully!');
    }

    /**
     * Verify wallet for payment
     */
    public function verifyWallet($orderId)
    {
        $wallet = Wallet::where('customer_id', Auth::id())
            ->with('walletDetails')
            ->firstOrFail();

        return view('wallet.verify', compact('wallet', 'orderId'));
    }

    /**
     * Process wallet payment
     */
    public function processPayment(Request $request, $orderId)
    {
        $request->validate([
            'cvv' => 'required|digits:3',
        ]);

        $wallet = Wallet::where('customer_id', Auth::id())
            ->with('walletDetails')
            ->firstOrFail();

        $walletDetail = $wallet->walletDetails()->first();

        if ($walletDetail->cvv != $request->cvv) {
            return back()->with('error', 'Invalid CVV');
        }

        return redirect()->route('orders.show', $orderId)
            ->with('success', 'Payment verified!');
    }
}
