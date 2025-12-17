<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
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

        $complaint = Complaint::create([
            'user_id' => $request->user()->id,
            'type' => $request->type,
            'subject' => $request->subject,
            'details' => $request->details,
            'attachment' => !empty($attachmentPaths) ? $attachmentPaths : null,
        ]);

        return response()->json([
            'message' => 'Complaint submitted successfully',
            'data' => $complaint
        ], 201);
    }
}
