<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $data = MataKuliah::all();
        return view('mataKuliah.index', compact('data'));
    }

    public function store(Request $request)
    {
        MataKuliah::create($request->only('namaMatkul', 'deskripsi'));
        return redirect()->back();
    }
    // Edit
    public function edit($id)
    {
        $mhs = MataKuliah::findOrFail($id);
        return view('mataKuliah.edit', compact('mataKuliah'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'namaMatkul' => 'required',
            'deskripsi' => 'required'
        ]);

        $mhs = MataKuliah::findOrFail($id);
        $mhs->update($request->only('namaMatkul', 'deskripsi'));

        return redirect()->route('mataKuliah.index')->with('success','Data berhasil diupdate!');
    }

    // Delete
    public function destroy($id)
    {
        $mhs = MataKuliah::findOrFail($id);
        $mhs->delete();

        return redirect()->route('mataKuliah.index')->with('success', 'Data berhasil dihapus!');
    }
}
