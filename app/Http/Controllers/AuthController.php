<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)
            ->where('deleted', false)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            session()->put('name', $user->name);
            session()->put('role', $user->role);
            
            if ($user->role === 'Administrator') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('customer.dashboard');
            }
        }

        return back()->with('error', 'Invalid credentials');
    }

    /**
     * Show registration form
     */
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    /**
     * Handle registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:15',
            'username' => 'required|string|max:10|unique:users',
            'password' => 'required|string|max:16|min:4',
            'email' => 'nullable|email|max:35',
            'contact' => 'required|numeric',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'contact' => $request->contact,
            'role' => 'Customer',
            'verified' => false,
        ]);

        // Create wallet for new customer
        $wallet = Wallet::create(['customer_id' => $user->id]);

        // Create wallet details with fake credit card
        WalletDetail::create([
            'wallet_id' => $wallet->id,
            'number' => $this->generateFakeCreditCard(),
            'cvv' => rand(100, 999),
            'balance' => 2000,
        ]);

        Auth::login($user);
        session()->put('name', $user->name);
        session()->put('role', $user->role);

        return redirect()->route('customer.dashboard')->with('success', 'Registration successful!');
    }

    /**
     * Handle logout
     */
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }

    /**
     * Generate fake credit card number
     */
    private function generateFakeCreditCard()
    {
        return rand(1000000000000000, 9999999999999999);
    }
}
