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
        // allowed per-page options
        $allowed = [4, 8, 12, 20];
        $perPage = (int) request()->query('perPage', 4);
        if (!in_array($perPage, $allowed)) {
            $perPage = 4;
        }

        $q = trim(request()->query('q', ''));

        $query = Mahasiswa::query();
        if ($q !== '') {
            $query->where(function($sub) use ($q) {
                $sub->where('nama', 'like', "%{$q}%")
                    ->orWhere('nim', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        $mahasiswa = $query->orderBy('id','desc')->paginate($perPage)->withQueryString();
        return view('mahasiswa.index', compact('mahasiswa', 'perPage', 'q'));
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

    // Export simple Excel-compatible CSV
    public function exportExcel()
    {
        $mahasiswa = Mahasiswa::orderBy('id','desc')->get();

        $filename = 'mahasiswa_' . date('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($mahasiswa) {
            $out = fopen('php://output', 'w');

            // Write UTF-8 BOM for Excel
            fwrite($out, chr(0xEF) . chr(0xBB) . chr(0xBF));

            $i = 1;
            foreach ($mahasiswa as $m) {
                fputcsv($out, [$i++, $m->nama, $m->nim, $m->email]);
            }

            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }
}
