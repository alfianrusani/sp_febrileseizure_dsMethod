<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Disease, Symptom, Diagnosis};

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'diseases'  => Disease::count(),
            'symptoms'  => Symptom::count(),
            'diagnoses' => Diagnosis::count(),
            'today'     => Diagnosis::whereDate('created_at', today())->count(),
        ];

        $recentDiagnoses = Diagnosis::with('disease')
            ->latest()
            ->take(10)
            ->get();

        $diseaseStats = Disease::withCount('diagnoses')->get();

        return view('admin.dashboard', compact('stats', 'recentDiagnoses', 'diseaseStats'));
    }
}
