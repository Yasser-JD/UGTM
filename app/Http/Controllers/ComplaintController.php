<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function create()
    {
        if (!Auth::check() || !Auth::user()->is_active) {
            return redirect()->route('contact')->with('error', 'عذراً، خدمة تقديم الشكايات متاحة فقط للأعضاء المفعلين. يمكنك التواصل معنا عبر هذه الصفحة.');
        }
        return view('complaints.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'subject' => 'required|string|max:255',
            'details' => 'required|string',
            'attachment' => 'nullable|array',
            'attachment.*' => 'file|max:10240', // Max 10MB per file
        ]);

        $attachmentPaths = [];
        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $attachmentPaths[] = $file->store('complaints', 'public');
            }
        }

        Complaint::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'subject' => $request->subject,
            'details' => $request->details,
            'attachment' => !empty($attachmentPaths) ? $attachmentPaths : null,
        ]);

        return redirect()->route('profile.show')->with('success', 'تم إرسال شكايتك بنجاح. سنتواصل معك قريباً.');
    }
}
