<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Disease, Symptom};
use Illuminate\Http\Request;

class KnowledgeBaseController extends Controller
{
    public function index()
    {
        $diseases = Disease::with(['symptoms' => fn($q) => $q->orderBy('code')])->orderBy('code')->get();
        $symptoms = Symptom::orderBy('code')->get();

        return view('admin.knowledge.index', compact('diseases', 'symptoms'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'disease_id'  => 'required|exists:diseases,id',
            'symptom_ids' => 'nullable|array',
            'symptom_ids.*' => 'exists:symptoms,id',
        ]);

        $disease = Disease::findOrFail($request->disease_id);
        $disease->symptoms()->sync($request->symptom_ids ?? []);

        return redirect()->route('admin.knowledge.index')->with('success', 'Basis pengetahuan berhasil diperbarui.');
    }
}
