<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Diagnosis, Disease, Symptom};
use Illuminate\Http\Request;

class DiagnosisReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Diagnosis::with('disease')->latest();

        if ($request->filled('search')) {
            $query->where('patient_name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('disease_id')) {
            $query->where('disease_id', $request->disease_id);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('diagnosis_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('diagnosis_date', '<=', $request->date_to);
        }

        $diagnoses = $query->paginate(15)->withQueryString();
        $diseases  = Disease::orderBy('code')->get();

        return view('admin.diagnoses.index', compact('diagnoses', 'diseases'));
    }

    public function show(Diagnosis $diagnosis)
    {
        $diagnosis->load('disease');
        $selectedSymptoms = Symptom::whereIn('id', $diagnosis->selected_symptoms)->get();
        return view('admin.diagnoses.show', compact('diagnosis', 'selectedSymptoms'));
    }

    public function destroy(Diagnosis $diagnosis)
    {
        $diagnosis->delete();
        return redirect()->route('admin.diagnoses.index')->with('success', 'Data diagnosis berhasil dihapus.');
    }
}
