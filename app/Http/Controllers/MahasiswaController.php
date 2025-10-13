<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MahasiswaController extends Controller
{
    // READ
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    // CREATE FORM
    public function create()
    {
        return view('mahasiswa.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas',
            'email' => 'required|email|unique:mahasiswas',
        ]);

        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswa.index')->with('success','Data berhasil ditambahkan!');
    }

    // EDIT FORM
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    // UPDATE
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas,nim,'.$mahasiswa->id,
            'email' => 'required|email|unique:mahasiswas,email,'.$mahasiswa->id,
        ]);

        $mahasiswa->update($request->all());
        return redirect()->route('mahasiswa.index')->with('success','Data berhasil diperbarui!');
    }

    // DELETE
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success','Data berhasil dihapus!');
    }

    // Generate PDF
    public function generatePDF()
    {
        $mahasiswa = Mahasiswa::all();
        $pdf = PDF::loadView('mahasiswa.pdf', compact('mahasiswa'));
        return $pdf->stream('daftar-mahasiswa.pdf');
    }
}
