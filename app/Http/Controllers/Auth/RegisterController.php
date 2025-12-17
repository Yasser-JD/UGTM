<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect()->route('profile.show');
        }
        $locations = config('locations.Larache');
        return view('auth.register', compact('locations'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[\p{Arabic}\s]+$/u'],
            'rental_number' => 'required|string|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'commune' => 'required|string',
            'workplace' => 'required|string',
            'job_title' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
            'agree_organic_law' => 'accepted',
            'agree_solidarity' => 'accepted',
        ]);

        $user = User::create([
            'name' => $request->name,
            'rental_number' => $request->rental_number,
            'email' => $request->email,
            'phone' => $request->phone,
            'province' => 'Larache',
            'commune' => $request->commune,
            'workplace' => $request->workplace,
            'job_title' => $request->job_title,
            'password' => Hash::make($request->password),
            'is_active' => false,
        ]);

        Auth::login($user);

        return redirect()->route('profile.show')->with('success', 'تم إرسال طلب الانخراط بنجاح. سنقوم بمراجعة طلبك قريباً.');
    }
}
