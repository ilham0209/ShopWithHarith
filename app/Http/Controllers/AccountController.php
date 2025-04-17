<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserProfile;  // Add this import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        return view('account.index', compact('user'));
    }

    public function orders()
    {
        $user = Auth::user();
        $orders = $user->orders()->latest()->paginate(10);

        return view('account.orders', compact('user', 'orders'));
    }
    
    public function profile()
    {
        $user = Auth::user();
        return view('account.profile', compact('user'));
    }
    
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $user = Auth::user();
        
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return redirect()->route('account.profile')
            ->with('success', 'Profile updated successfully');
    }

    public function deleteAccount(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = Auth::user();
        
        try {
            DB::beginTransaction();
            
            // Delete user's profile if exists
            if ($user->profile) {
                $user->profile->delete();
            }
            
            // Delete the user
            $user->delete();
            
            DB::commit();
            
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('home')
                ->with('success', 'Your account has been deleted successfully.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Account deletion failed: ' . $e->getMessage());
            
            return back()->with('error', 'Failed to delete account. Please try again.');
        }
    }
}