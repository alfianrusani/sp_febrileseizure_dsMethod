<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use App\Models\Diagnosis;
use App\Services\DempsterShaferService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DiagnosisController extends Controller
{
    public function __construct(private DempsterShaferService $ds) {}

    /** Landing page */
    public function index()
    {
        $totalDiagnoses = Diagnosis::count();
        return view('user.home', compact('totalDiagnoses'));
    }

    /** Show the consultation form */
    public function create()
    {
        $symptoms = Symptom::orderBy('code')->get();
        return view('user.diagnosis', compact('symptoms'));
    }

    /** Process the diagnosis */
    public function store(Request $request)
    {
        $request->validate([
            'patient_name'  => 'required|string|max:255',
            'gender'        => 'required|in:Laki-laki,Perempuan',
            'phone'         => 'nullable|string|max:20',
            'birth_date'    => 'required|date',
            'address'       => 'nullable|string|max:500',
            'symptom_ids'   => 'required|array|min:1',
            'symptom_ids.*' => 'exists:symptoms,id',
        ]);

        $birthDate  = Carbon::parse($request->birth_date);
        $ageMonths  = (int) $birthDate->diffInMonths(now());

        $result = $this->ds->diagnose($request->symptom_ids);

        $diagnosis = Diagnosis::create([
            'patient_name'      => $request->patient_name,
            'gender'            => $request->gender,
            'phone'             => $request->phone,
            'birth_date'        => $request->birth_date,
            'age_months'        => $ageMonths,
            'address'           => $request->address,
            'diagnosis_date'    => now()->toDateString(),
            'disease_id'        => $result['disease']?->id,
            'belief_value'      => $result['belief'],
            'selected_symptoms' => $request->symptom_ids,
        ]);

        return redirect()->route('diagnosis.result', $diagnosis->id);
    }

    /** Show diagnosis result */
    public function result(Diagnosis $diagnosis)
    {
        $diagnosis->load('disease');
        $selectedSymptoms = Symptom::whereIn('id', $diagnosis->selected_symptoms)->get();
        return view('user.result', compact('diagnosis', 'selectedSymptoms'));
    }

    /** Print-friendly result page */
    public function print(Diagnosis $diagnosis)
    {
        $diagnosis->load('disease');
        $selectedSymptoms = Symptom::whereIn('id', $diagnosis->selected_symptoms)->get();
        return view('user.print', compact('diagnosis', 'selectedSymptoms'));
    }

    /** About page */
    public function about()
    {
        return view('user.about');
    }

    /** Disease info page */
    public function diseases()
    {
        return view('user.diseases');
    }

    /** Contact page */
    public function contact()
    {
        return view('user.contact');
    }
}
