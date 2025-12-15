<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalUsersCount = User::count();
        $totalProductsCount = Product::count();
        $newUsersToday = User::whereDate('created_at', today())->count();
        return view('admin.dashboard.index', compact('totalUsersCount', 'totalProductsCount', 'newUsersToday'));
    }
}
