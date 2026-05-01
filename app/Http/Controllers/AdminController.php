<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        if (Auth::user()->role !== 'Administrator') {
            abort(403);
        }

        $stats = [
            'total_users' => User::where('deleted', false)->count(),
            'total_orders' => Order::where('deleted', false)->count(),
            'total_items' => Item::where('deleted', false)->count(),
            'open_tickets' => Ticket::where('status', 'Open')->where('deleted', false)->count(),
            'total_revenue' => Order::where('deleted', false)->sum('total'),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Show all users
     */
    public function users()
    {
        if (Auth::user()->role !== 'Administrator') {
            abort(403);
        }

        $users = User::where('role', 'Customer')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show user details
     */
    public function showUser($id)
    {
        if (Auth::user()->role !== 'Administrator') {
            abort(403);
        }

        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Verify user
     */
    public function verifyUser(Request $request, $id)
    {
        if (Auth::user()->role !== 'Administrator') {
            abort(403);
        }

        User::findOrFail($id)->update(['verified' => true]);

        return back()->with('success', 'User verified!');
    }

    /**
     * Delete user
     */
    public function deleteUser($id)
    {
        if (Auth::user()->role !== 'Administrator') {
            abort(403);
        }

        User::findOrFail($id)->update(['deleted' => true]);

        return back()->with('success', 'User deleted!');
    }
}
