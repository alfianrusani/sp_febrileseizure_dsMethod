<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query()->latest();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $patients = $query->paginate(15)->withQueryString();

        return view('admin.patients.index', compact('patients'));
    }

    public function show(Patient $patient)
    {
        return view('admin.patients.show', compact('patient'));
    }
}
