<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getProvinces(Request $request)
    {
        $provinces = School::distinct()
            ->whereNotNull('province')
            ->orderBy('province')
            ->pluck('province');

        return response()->json($provinces);
    }

    public function getCommunes(Request $request)
    {
        // Return all distinct communes regardless of province
        $communes = School::distinct()
            ->whereNotNull('commune')
            ->orderBy('commune')
            ->pluck('commune');

        return response()->json($communes);
    }

    public function getSchools(Request $request)
    {
        $commune = $request->input('commune');

        if (!$commune) {
            return response()->json([], 400);
        }

        $schools = School::where('commune', $commune)
            ->orderBy('name')
            ->select('id', 'name')
            ->get();

        return response()->json($schools);
    }
}
