<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        if ($user->should_show_approval_message) {
            session()->flash('success', 'مبروك! لقد تمت الموافقة على طلب عضويتك. يمكنك الآن الاستفادة من جميع خدمات المنصة.');
            $user->should_show_approval_message = false;
            $user->saveQuietly();
        }

        return view('profile.show', compact('user'));
    }
}
