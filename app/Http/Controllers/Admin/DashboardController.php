<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
// use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Show the Dashboard View.
    public function index(Request $request) {
        $user = $request->user();
        if ($user == null || $request->user()->cannot('admin')) {
            abort(404);
        }

        $users = User::paginate(25);

        return view('auth.dashboard', ['users' => $users]);
    }
}
