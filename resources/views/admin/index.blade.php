<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - ARQI BIRD FARM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            background-color: #fcfbf9; 
            color: #333333; 
            font-family: 'Segoe UI', system-ui, sans-serif;
        }
        /* Desain Header bertema Sketsa Pensil */
        .sketch-header {
            border-bottom: 2px dashed #7f8c8d;
            padding-bottom: 20px;
        }
        .text-sketch-title {
            font-family: 'Georgia', serif;
            color: #2c3e50;
            font-weight: bold;
            letter-spacing: 1px;
        }
        /* Card bergaya Kertas Sketsa Modern */
        .card-sketch { 
            background-color: #ffffff; 
            border: 1px solid #e0dcd3; 
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.03);
        }
        /* Tabel Minimalis Bersih */
        .table-sketch { color: #333333; }
        .table-sketch tr { border-bottom: 1px solid #f0ede6; }
        .table-sketch th { 
            background-color: #f5f2eb !important; 
            color: #555555 !important; 
            font-weight: 600;
            border: none; 
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        /* Tombol bergaya Charcoal/Pensil Kayu */
        .btn-sketch { 
            background-color: #4a4a4a; 
            color: #ffffff; 
            font-weight: 500; 
            border: none;
            transition: all 0.2s ease;
        }
        .btn-sketch:hover { 
            background-color: #2b2b2b; 
            color: #ffffff; 
        }
        /* Badge Gender yang Soft */
        .badge-jantan { background-color: #e3f2fd; color: #0d47a1; border: 1px solid #bbdefb; }
        .badge-betina { background-color: #fce4ec; color: #880e4f; border: 1px solid #f8bbd0; }
    </style>
</head>
<body class="py-4 py-md-5">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3 sketch-header">
            <div>
                <h2 class="text-sketch-title mb-1"><i class="fa-solid fa-feather-pointed me-2" style="color: #7f8c8d;"></i>ARQI BIRD FARM</h2>
                <p class="text-muted small mb-0">Sistem Manajemen Sertifikasi Kicau & Ring Burung Terintegrasi</p>
            </div>
            <a href="{{ route('admin.certificates.create') }}" class="btn btn-sketch px-4 py-2 w-100 w-md-auto rounded shadow-sm">
                <i class="fa-solid fa-pen-clip me-2"></i>Tambah Sertifikat Baru
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success bg-white text-success border-start border-4 border-success shadow-sm mb-4">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
            </div>
        @endif

        <div class="card card-sketch overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sketch table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4 py-3">No. Sertifikat</th>
                                <th class="py-3">Nomor Ring</th>
                                <th class="py-3">Gender</th>
                                <th class="py-3">Silsilah Indukan (J x B)</th>
                                <th class="text-center pe-4 py-3">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($certificates as $cert)
                                <tr>
                                    <td class="ps-4 fw-medium text-muted small" style="font-family: monospace;">
                                        {{ $cert->certificate_number }}
                                    </td>
                                    <td class="fw-bold text-dark">
                                        {{ $cert->ring_number }}
                                    </td>
                                    <td>
                                        <span class="badge {{ $cert->gender == 'JANTAN' ? 'badge-jantan' : 'badge-betina' }} px-2.5 py-1.5">
                                            {{ $cert->gender }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="small text-dark-50 fw-medium">
                                            {{ $cert->father_breeder }} <span class="text-muted">×</span> {{ $cert->mother_breeder }}
                                        </span>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('certificates.show', $cert->certificate_number) }}" class="btn btn-sm btn-outline-secondary" target="_blank" title="Buka Sertifikasi & QR">
                                                <i class="fa-solid fa-qrcode"></i>
                                            </a>
                                            <a href="{{ route('admin.certificates.edit', $cert->id) }}" class="btn btn-sm btn-outline-dark" title="Ubah Data">
                                                <i class="fa-solid fa-marker"></i>
                                            </a>
                                            <form action="{{ route('admin.certificates.destroy', $cert->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data sertifikat ini secara permanen?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Permanen">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            
                            @if($certificates->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">
                                        <i class="fa-solid fa-folder-open d-block fs-3 mb-2 style-muted" style="color: #bdc3c7;"></i>
                                        Belum ada rekaman sertifikat burung yang dimasukkan.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>