<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\MahasiswaExport;

class MahasiswaController extends Controller
{
    // INDEX
    public function index(Request $request)
    {
        $search = $request->input('search');

        $mahasiswa = Mahasiswa::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                ->orWhere('nim', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('prodi', 'like', "%{$search}%");
        })
            ->orderBy('nama', 'asc')
            ->paginate(5)
            ->withQueryString();

        return view('mahasiswa.index', compact('mahasiswa', 'search'));
    }

    // CREATE FORM
    public function create()
    {
        $prodiList = [
            'Teknik Informatika',
            'Sistem Informasi',
            'Teknik Komputer',
            'Manajemen Informatika',
            'Pendidikan Teknologi Informasi',
        ];
        return view('mahasiswa.create', compact('prodiList'));
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas',
            'email' => 'required|email|unique:mahasiswas',
            'prodi' => 'required',
        ]);

        Mahasiswa::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'prodi' => $request->prodi,
        ]);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    // EDIT FORM
    public function edit(Mahasiswa $mahasiswa)
    {
        $prodiList = [
            'Teknik Informatika',
            'Sistem Informasi',
            'Teknik Komputer',
            'Manajemen Informatika',
            'Pendidikan Teknologi Informasi',
        ];
        return view('mahasiswa.edit', compact('mahasiswa', 'prodiList'));
    }

    // UPDATE
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'email' => 'required|email|unique:mahasiswas,email,' . $mahasiswa->id,
            'prodi' => 'required',
        ]);

        $mahasiswa->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'prodi' => $request->prodi,
        ]);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    // DELETE
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data berhasil dihapus!');
    }

    // CETAK PDF
    public function cetakPDF()
    {
        $mahasiswa = Mahasiswa::all();
        $pdf = Pdf::loadView('mahasiswa.pdf', compact('mahasiswa'))
            ->setPaper('a4', 'portrait');
        return $pdf->download('daftar-mahasiswa.pdf');
    }

    // EXPORT EXCEL
    public function exportExcel()
    {
        $export = new MahasiswaExport();
        return $export->export();
    }
}
