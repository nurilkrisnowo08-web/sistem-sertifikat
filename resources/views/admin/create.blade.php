<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sertifikat - ARQI</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            background-color: #e8e6e1; 
            color: #222222; 
            font-family: 'Segoe UI', system-ui, sans-serif;
            position: relative;
            min-height: 100vh;
            overflow-x: hidden;
            display: flex;
            align-items: center;
        }
        
        /* JALUR BACKGROUND AUTOMATIS BERADAPTASI JIKA DI HOSTING PRODUCTION */
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: url("{{ asset(app()->environment('production') ? 'public/murai.png' : 'murai.png') }}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover; 
            
            /* Sedikit transparansi agar tulisan form tetap nyaman dibaca, bisa kamu atur nilainya */
            opacity: 0.6; 
            
            z-index: -1;
            pointer-events: none;
        }
        
        .sketch-header {
            border-bottom: 2px dashed #7f8c8d;
            padding-bottom: 15px;
        }
        
        .text-sketch-title {
            font-family: 'Georgia', serif;
            color: #222222;
            font-weight: bold;
            letter-spacing: 1px;
        }
        
        /* FORM DIBUAT BENAR-BENAR TRANSPARAN TANPA BACKGROUND */
        .card-sketch { 
            background-color: transparent !important; 
            border: none !important; 
            border-radius: 16px;
            box-shadow: none !important; 
            backdrop-filter: none !important; 
            -webkit-backdrop-filter: none !important;
        }
        
        .form-label {
            font-weight: 700;
            color: #111111;
        }
        
        /* GARIS INPUT DITEGASKAN AGAR TERLIHAT DI ATAS GAMBAR TRANSPARAN */
        .form-control, .form-select { 
            background-color: rgba(255, 255, 255, 0.7); 
            border: 2px solid #444444; 
            color: #000000;
            border-radius: 8px;
            padding: 0.65rem 0.75rem;
            font-weight: 600;
        }
        
        .form-control:focus, .form-select:focus { 
            background-color: #ffffff; 
            border-color: #000000; 
            color: #000000; 
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.08); 
        }
        
        .form-control:disabled {
            background-color: rgba(220, 215, 205, 0.8);
            color: #333333;
            border-color: #444444;
            font-weight: 700;
        }
        
        .btn-sketch-dark { 
            background-color: #222222; 
            color: #ffffff; 
            font-weight: 600; 
            border: none;
            padding: 0.7rem 2rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        .btn-sketch-dark:hover { 
            background-color: #000000; 
            color: #ffffff; 
            transform: translateY(-2px);
        }
        
        .btn-outline-sketch {
            border: 2px solid #444444;
            color: #222222;
            font-weight: 600;
            background-color: rgba(255, 255, 255, 0.6);
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
        }
        .btn-outline-sketch:hover {
            background-color: #222222;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container" style="max-width: 690px; margin: 0 auto; padding-top: 3rem; padding-bottom: 3rem;">
        
        <div class="mb-4 sketch-header text-center">
            <h3 class="text-sketch-title mb-1"><i class="fa-solid fa-feather-pointed me-2" style="color: #444444;"></i> ARQI BIRD FARM</h3>
            <p class="text-muted small mb-0">Pencatatan Dokumen Sertifikat Kicau Baru secara Akurat</p>
        </div>

        <div class="card card-sketch mb-4">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label class="form-label small">Nomor Ring</label>
                            <input type="text" name="ring_number" class="form-control" placeholder="Contoh: ARQI 01" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label small">Tanggal Menetas</label>
                            <input type="date" name="hatch_date" class="form-control" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label class="form-label small">Jenis Burung</label>
                            <input type="text" name="bird_type" class="form-control" value="MURAI BATU" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label small">Jenis Kelamin</label>
                            <select name="gender" class="form-select" required>
                                <option value="JANTAN">JANTAN</option>
                                <option value="BETINA">BETINA</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <label class="form-label small">Warna Ring</label>
                            <input type="text" name="ring_color" class="form-control" placeholder="Contoh: EMAS" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label small">Nama Kedai/Farm Resmi</label>
                            <input type="text" class="form-control" value="ARQI BIRD FARM" readonly disabled>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <label class="form-label small">Indukan Jantan (Father)</label>
                            <input type="text" name="father_breeder" class="form-control" placeholder="Nama Pacek" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label small">Indukan Betina (Mother)</label>
                            <input type="text" name="mother_breeder" class="form-control" placeholder="Nama Biang" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small"><i class="fa-regular fa-image me-1"></i> Lampirkan Foto Profil Burung</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-4">
                        <label class="form-label small"><i class="fa-regular fa-file-video me-1"></i> Lampirkan Video Rekaman (Maks 20MB)</label>
                        <input type="file" name="video" class="form-control" accept="video/*">
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 pt-4 border-top border-secondary-subtle">
                        <a href="{{ route('admin.certificates.index') }}" class="btn btn-outline-sketch w-100 w-sm-auto text-center">Batal</a>
                        <button type="submit" class="btn btn-sketch-dark w-100 w-sm-auto shadow-sm">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Simpan Sertifikat
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="text-center mt-2 text-dark fw-bold small">
            <i class="fa-solid fa-circle-info me-1"></i> Info Alamat ARQI FARM disematkan ke dalam barcode.
        </div>

    </div>
</body>
</html>