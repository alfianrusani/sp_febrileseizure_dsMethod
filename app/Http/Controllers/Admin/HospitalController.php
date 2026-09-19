<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::latest()->get();
        return view('admin.hospitals.index', compact('hospitals'));
    }

    public function create()
    {
        return view('admin.hospitals.form', ['hospital' => new Hospital()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_number' => 'nullable|string|max:50',
        ]);

        Hospital::create($data);

        return redirect()->route('admin.hospitals.index')->with('success', 'Rumah sakit berhasil ditambahkan.');
    }

    public function edit(Hospital $hospital)
    {
        return view('admin.hospitals.form', compact('hospital'));
    }

    public function update(Request $request, Hospital $hospital)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_number' => 'nullable|string|max:50',
        ]);

        $hospital->update($data);

        return redirect()->route('admin.hospitals.index')->with('success', 'Rumah sakit berhasil diperbarui.');
    }

    public function destroy(Hospital $hospital)
    {
        $hospital->delete();

        return redirect()->route('admin.hospitals.index')->with('success', 'Rumah sakit berhasil dihapus.');
    }
}
