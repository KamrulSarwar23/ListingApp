<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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


        Gate::authorize('modifyRole',$user);

        $request->validate([
            'role' => 'string|required'
        ]);

        $user->update([
            'role' => $request->role,
        ]);

        return redirect()->route('admin.index')->with('status', "User role changed to {$request->role} successfully");
    }


    public function show(User $user){

    
        // $listings = Listing::with('user')->where('user_id', $id)->paginate(5);

        $listings = $user->listings()
        ->filter(request(['search', 'disapproved']))
        ->latest()
        ->paginate(5)
        ->withQueryString();

        return Inertia::render('Admin/Show', [
            'listings' => $listings,
            'user' => $user,
            'status' => session('status'),
        ]);
    }


    public function listingApproved(Listing $listing){
        
        Gate::authorize('approve', $listing);


        $listing->update([ 'approved' => !$listing->approved]);

        $msg = $listing->approved ? 'Approved' : 'Disaprroved';

        return redirect()->back()->with('status', "Listing {$msg} Successfully");

    }
}
