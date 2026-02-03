<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function homePage()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role === 'owner') {
                return redirect()->route('owner.dashboard');
            }
        }

        $products = Product::with(['category', 'variants'])
            ->where('is_active', true)
            ->latest()
            ->take(4)
            ->get();
        return view('home', compact('products'));
    }
}
