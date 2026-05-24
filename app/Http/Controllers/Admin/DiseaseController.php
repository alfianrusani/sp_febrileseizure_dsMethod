<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    public function index()
    {
        $diseases = Disease::withCount('diagnoses')->orderBy('code')->get();
        return view('admin.diseases.index', compact('diseases'));
    }

    public function create()
    {
        return view('admin.diseases.form', ['disease' => new Disease()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code'        => 'required|string|max:10|unique:diseases',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'treatment'   => 'nullable|string',
        ]);

        Disease::create($data);

        return redirect()->route('admin.diseases.index')->with('success', 'Penyakit berhasil ditambahkan.');
    }

    public function edit(Disease $disease)
    {
        return view('admin.diseases.form', compact('disease'));
    }

    public function update(Request $request, Disease $disease)
    {
        $data = $request->validate([
            'code'        => 'required|string|max:10|unique:diseases,code,' . $disease->id,
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'treatment'   => 'nullable|string',
        ]);

        $disease->update($data);

        return redirect()->route('admin.diseases.index')->with('success', 'Penyakit berhasil diperbarui.');
    }

    public function destroy(Disease $disease)
    {
        $disease->delete();
        return redirect()->route('admin.diseases.index')->with('success', 'Penyakit berhasil dihapus.');
    }
}
