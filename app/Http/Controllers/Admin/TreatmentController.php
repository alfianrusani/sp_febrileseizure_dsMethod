<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index()
    {
        $treatments = Treatment::with('disease')->latest()->get();

        return view('admin.treatments.index', compact('treatments'));
    }

    public function create()
    {
        $diseases = Disease::orderBy('code')->get();

        return view('admin.treatments.form', [
            'treatment' => new Treatment(),
            'diseases' => $diseases,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'disease_id' => 'required|exists:diseases,id',
            'action_title' => 'required|string|max:255',
            'first_step_handling' => 'required|string',
            'medicine' => 'required|string',
        ]);

        $existingTreatment = Treatment::where('disease_id', $data['disease_id'])->first();

        if ($existingTreatment) {
            return back()
                ->withInput()
                ->with('error', 'Penyakit ini sudah memiliki treatment. Silakan gunakan fitur edit untuk memperbarui data yang ada.');
        }

        Treatment::create($data);

        return redirect()->route('admin.treatments.index')->with('success', 'Data treatment berhasil ditambahkan.');
    }

    public function edit(Treatment $treatment)
    {
        $diseases = Disease::orderBy('code')->get();

        return view('admin.treatments.form', compact('treatment', 'diseases'));
    }

    public function update(Request $request, Treatment $treatment)
    {
        $data = $request->validate([
            'disease_id' => 'required|exists:diseases,id',
            'action_title' => 'required|string|max:255',
            'first_step_handling' => 'required|string',
            'medicine' => 'required|string',
        ]);

        $conflictingTreatment = Treatment::where('disease_id', $data['disease_id'])
            ->where('id', '!=', $treatment->id)
            ->first();

        if ($conflictingTreatment) {
            return redirect()->route('admin.treatments.edit', $treatment)
                ->with('warning', 'Penyakit ini sudah memiliki treatment lain. Silakan gunakan data yang sudah ada.');
        }

        $treatment->update($data);

        return redirect()->route('admin.treatments.index')->with('success', 'Data treatment berhasil diperbarui.');
    }

    public function destroy(Treatment $treatment)
    {
        $treatment->delete();

        return redirect()->route('admin.treatments.index')->with('success', 'Data treatment berhasil dihapus.');
    }
}
