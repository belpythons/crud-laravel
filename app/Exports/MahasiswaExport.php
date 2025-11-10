<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Illuminate\Http\Response;

class MahasiswaExport
{
    public function export()
    {
        $mahasiswa = Mahasiswa::select('id', 'nama', 'nim', 'email', 'prodi')->get();

        $filename = 'mahasiswa_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($mahasiswa) {
            $file = fopen('php://output', 'w');

            // Header row
            fputcsv($file, ['ID', 'Nama', 'NIM', 'Email', 'Program Studi']);

            // Data rows
            foreach ($mahasiswa as $m) {
                fputcsv($file, [
                    $m->id,
                    $m->nama,
                    $m->nim,
                    $m->email,
                    $m->prodi
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
