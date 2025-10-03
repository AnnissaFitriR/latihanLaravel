<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $data = Dosen::all();
        return view('dosen.index', compact('data'));
    }

    public function store(Request $request)
    {
        Dosen::create($request->only('nama', 'nid', 'matkul'));
        return redirect()->back();
    }

    // Edit
    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.edit', compact('dosen'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nid' => 'required',
            'matkul' => 'required'
        ]);

        $dosen = Dosen::findOrFail($id);
        $dosen->update($request->only('nama', 'nim', 'matkul'));

        return redirect()->route('dosen.index')->with('success','Data berhasil diupdate!');
    }

    // Delete
    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();

        return redirect()->route('dosen.index')->with('success', 'Data berhasil dihapus!');
    }
}
