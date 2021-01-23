<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
    // Show the Dashboard View.
    public function index(Request $request) {
        $users = User::all();

        return view('auth.dashboard', ['users' => $users]);
    }
}
