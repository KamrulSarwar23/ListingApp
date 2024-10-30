<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request){

        $listings = $request->user()->role !== 'suspended' ? $request->user()->listings()->latest()->paginate(6) : null;
    
        return Inertia::render('Dashboard', [
            'listings' => $listings,
            'status' => session('status')
        ]);
    }
}
