<!DOCTYPE html>
<html>
<head>
    <title>Daftar Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-primary">📋 Daftar Mahasiswa</h1>
                <div class="d-flex gap-2">
                <a href="{{ route('mahasiswa.pdf') }}" class="btn btn-danger" target="_blank">
                    <i class="bi bi-file-pdf"></i> Export PDF
                </a>
                <a href="{{ route('mahasiswa.export') }}" class="btn btn-primary">
                    <i class="bi bi-file-earmark-spreadsheet"></i> Export Excel
                </a>
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-success">
                    + Tambah Mahasiswa
                </a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <form method="GET" class="d-flex align-items-center" id="searchForm">
                            <input type="search" name="q" value="{{ isset($q) ? $q : '' }}" class="form-control form-control-sm me-2" placeholder="Cari nama, nim, email..." style="width: 240px;">
                            @if(isset($perPage))
                                <input type="hidden" name="perPage" value="{{ $perPage }}">
                            @endif
                            <button type="submit" class="btn btn-outline-primary btn-sm me-2">Search</button>
                        </form>

                        <form method="GET" class="d-flex align-items-center" id="jumpForm">
                            <label for="jumpPage" class="me-2 mb-0">Go to page:</label>
                            <input type="number" min="1" max="{{ $mahasiswa->lastPage() }}" name="page" id="jumpPage" class="form-control form-control-sm me-2" style="width: 90px;" placeholder="1">
                            @if(isset($perPage))
                                <input type="hidden" name="perPage" value="{{ $perPage }}">
                            @endif
                            <button type="submit" class="btn btn-primary btn-sm">Go</button>
                        </form>

                    </div>
                </div>
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswa as $index => $m)
                        <tr>
                            <td class="text-center">{{ $mahasiswa->firstItem() + $index }}</td>
                            <td>{{ $m->nama }}</td>
                            <td>{{ $m->nim }}</td>
                            <td>{{ $m->email }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('mahasiswa.edit',$m->id) }}" class="btn btn-warning btn-sm">✏ Edit</a>
                                    <form action="{{ route('mahasiswa.destroy',$m->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">🗑 Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($mahasiswa->count() == 0)
                    <p class="text-center text-muted">Belum ada data mahasiswa.</p>
                @endif

                <div class="d-flex justify-content-center mt-3">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item {{ $mahasiswa->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $mahasiswa->onFirstPage() ? '#' : $mahasiswa->previousPageUrl() }}" aria-label="Previous">Prev</a>
                            </li>
                            <li class="page-item disabled">
                                <span class="page-link">Page {{ $mahasiswa->currentPage() }} of {{ $mahasiswa->lastPage() }}</span>
                            </li>
                            <li class="page-item {{ $mahasiswa->currentPage() == $mahasiswa->lastPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $mahasiswa->currentPage() == $mahasiswa->lastPage() ? '#' : $mahasiswa->nextPageUrl() }}" aria-label="Next">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
