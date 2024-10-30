<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index(){

        $users = User::with('listings')
        ->filters(request(['search', 'user_role']))
        ->paginate(5)
        ->withQueryString();

        return Inertia::render('Admin/AdminDashboard', [
            'users' => $users,
            'status' => session('status')
        ]);
    }

    public function role(User $user, Request $request){

        $request->validate([
            'role' => 'string|required'
        ]);

        $user->update([
            'role' => $request->role,
        ]);

        return redirect()->route('admin.index')->with('status', "User role changed to {$request->role} successfully");
    }


    public function show(string $id){

    
        $listings = Listing::with('user')->where('user_id', $id)->paginate(5);

        return Inertia::render('Admin/Show', [
            'listings' => $listings,
            'status' => session('status')
        ]);
    }


    public function approved(String $id, Request $request){

        $request->validate([
            'approved' => 'string|required'
        ]);

        Listing::where('id', $id)->update([
            'approved' => $request->approved
        ]);

        return redirect()->back()->with('status', "Listing Status Changed Successfully");
    }
}
