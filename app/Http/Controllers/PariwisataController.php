<?php

namespace App\Http\Controllers;

use App\Models\Pariwisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PariwisataController extends Controller
{
    public function index()
    {
        $data = Pariwisata::latest()->get();
        return view('pariwisata.index', compact('data'));
    }

    // public function create()
    // {
    //     return view('pariwisata.create');
    // }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'nama' => 'required',
    //         'jenis' => 'required',
    //         'alamat' => 'required',
    //         'kecamatan' => 'required',
    //         'deskripsi' => 'nullable',
    //         'foto' => 'nullable|image|max:2048',
    //     ]);

    //     if ($request->hasFile('foto')) {
    //         $validated['foto'] = $request->file('foto')->store('foto-pariwisata', 'public');
    //     }

    //     Pariwisata::create($validated);

    //     return redirect()->route('pariwisata.index')->with('success', 'Data berhasil ditambahkan.');
    // }

    // public function show($id)
    // {
    //     $data = Pariwisata::findOrFail($id);
    //     return view('pariwisata.show', compact('data'));
    // }

    // public function edit($id)
    // {
    //     $data = Pariwisata::findOrFail($id);
    //     return view('pariwisata.edit', compact('data'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $data = Pariwisata::findOrFail($id);

    //     $validated = $request->validate([
    //         'nama' => 'required',
    //         'jenis' => 'required',
    //         'alamat' => 'required',
    //         'kecamatan' => 'required',
    //         'deskripsi' => 'nullable',
    //         'foto' => 'nullable|image|max:2048',
    //     ]);

    //     if ($request->hasFile('foto')) {
    //         if ($data->foto) {
    //             Storage::disk('public')->delete($data->foto);
    //         }
    //         $validated['foto'] = $request->file('foto')->store('foto-pariwisata', 'public');
    //     }

    //     $data->update($validated);

    //     return redirect()->route('pariwisata.index')->with('success', 'Data berhasil diperbarui.');
    // }

    // public function destroy($id)
    // {
    //     $data = Pariwisata::findOrFail($id);

    //     if ($data->foto) {
    //         Storage::disk('public')->delete($data->foto);
    //     }

    //     $data->delete();

    //     return redirect()->route('pariwisata.index')->with('success', 'Data berhasil dihapus.');
    // }
}
