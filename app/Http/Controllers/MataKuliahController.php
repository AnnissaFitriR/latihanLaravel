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
}
