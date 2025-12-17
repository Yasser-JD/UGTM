<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify(Request $request, $id)
    {
        if (! $request->hasValidSignature()) {
            abort(403, 'رابط التحقق غير صالح أو منتهي الصلاحية.');
        }

        $user = User::findOrFail($id);

        return view('verification.show', compact('user'));
    }
}
