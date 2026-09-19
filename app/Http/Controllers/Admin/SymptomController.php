<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Symptom;
use Illuminate\Http\Request;

class SymptomController extends Controller
{
    public function index()
    {
        $symptoms = Symptom::with('diseases')->orderBy('code')->get();
        return view('admin.symptoms.index', compact('symptoms'));
    }

    public function create()
    {
        return view('admin.symptoms.form', ['symptom' => new Symptom()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code'    => 'required|string|max:10|unique:symptoms',
            'name'    => 'required|string|max:255',
            'density' => 'required|numeric|min:0|max:1',
        ]);

        Symptom::create($data);

        return redirect()->route('admin.symptoms.index')->with('success', 'Gejala berhasil ditambahkan.');
    }

    public function edit(Symptom $symptom)
    {
        return view('admin.symptoms.form', compact('symptom'));
    }

    public function update(Request $request, Symptom $symptom)
    {
        $data = $request->validate([
            'code'    => 'required|string|max:10|unique:symptoms,code,' . $symptom->id,
            'name'    => 'required|string|max:255',
            'density' => 'required|numeric|min:0|max:1',
        ]);

        $symptom->update($data);

        return redirect()->route('admin.symptoms.index')->with('success', 'Gejala berhasil diperbarui.');
    }

    public function destroy(Symptom $symptom)
    {
        $symptom->delete();
        return redirect()->route('admin.symptoms.index')->with('success', 'Gejala berhasil dihapus.');
    }
}
