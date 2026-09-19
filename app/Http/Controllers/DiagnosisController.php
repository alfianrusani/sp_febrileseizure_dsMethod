<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use App\Models\Diagnosis;
use App\Models\Article;
use App\Models\Hospital;
use App\Models\Feedback;
use App\Models\Patient;
use App\Services\DempsterShaferService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
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

        $birthDate = Carbon::parse($request->birth_date);
        $today = Carbon::now();

        if ($birthDate->greaterThan($today)) {
            $birthDate = $today;
        }

        $ageMonths = (int) $birthDate->diffInMonths($today);
        $genderValue = $request->gender === 'Laki-laki' ? 'L' : 'P';

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

        $patientData = [
            'age' => $ageMonths,
            'gender' => $genderValue,
            'diagnosis' => $result['disease']?->name ?? '-',
            'belief_value' => $result['belief'],
        ];

        if (Schema::hasColumn('patients', 'phone')) {
            $patientData['phone'] = $request->phone;
        }

        if (Schema::hasColumn('patients', 'address')) {
            $patientData['address'] = $request->address;
        }

        Patient::firstOrCreate(
            ['name' => $request->patient_name],
            $patientData
        )->update($patientData);

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

    /** Store feedback for the diagnosis patient */
    public function storeFeedback(Request $request, Diagnosis $diagnosis)
    {
        $request->validate([
            'comments' => 'required|string|max:1000',
        ]);

        Feedback::create([
            'diagnosis_id' => $diagnosis->id,
            'patient_name' => $diagnosis->patient_name,
            'rating'       => 5,
            'comments'     => $request->comments,
        ]);

        return redirect()->route('diagnosis.result', $diagnosis->id)
            ->with('feedback_success', true);
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

    /** List articles page */
    public function articles()
    {
        $articles = Article::latest()->paginate(6);
        return view('user.articles', compact('articles'));
    }

    /** Single article page */
    public function article(Article $article)
    {
        return view('user.article', compact('article'));
    }

    /** List hospitals with search */
    public function hospitals(Request $request)
    {
        $q = $request->query('q');
        $hospitals = Hospital::when($q, function ($query, $q) {
            $query->where('name', 'like', "%{$q}%")
                  ->orWhere('address', 'like', "%{$q}%");
        })->orderBy('name')->paginate(12)->withQueryString();

        return view('user.hospitals', compact('hospitals', 'q'));
    }

    /** Single hospital detail */
    public function hospital(Hospital $hospital)
    {
        return view('user.hospital', compact('hospital'));
    }
}
