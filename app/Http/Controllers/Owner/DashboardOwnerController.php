<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardOwnerController extends Controller
{
    public function dashboardPage()
    {
        return view('owner.dashboard');
    }
}
