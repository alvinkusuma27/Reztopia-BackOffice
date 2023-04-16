<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Categories::with('outlet')->get();
        dd($categories);
        return view('tenant.page.dashboard');
    }
}

// outlet
// categories
// product
// order_status
// order
// order_detail
