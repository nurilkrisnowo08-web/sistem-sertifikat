<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat - {{ $certificate->ring_number }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,800;1,600&family=Montserrat:wght@500;700;800&display=swap');

        body { 
            background-color: #2c313c; 
            color: #1a2b4c; 
            font-family: 'Montserrat', sans-serif; 
        }

        .action-bar { max-width: 1100px; margin: 30px auto 10px; display: flex; justify-content: flex-end; gap: 15px; }

        .cert-wrapper {
            max-width: 1100px; 
            margin: 0 auto 30px;
            background-color: #fdfbf7; 
            padding: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .cert-border-outer { border: 10px solid #1a2b4c; padding: 6px; }

        .cert-border-inner {
            border: 2px solid #c5a059;
            padding: 40px 60px 50px;
            position: relative;
            background-color: #fdfbf7;
        }

        /* HEADER & LOGO GRID (LEBAR DISESUAIKAN DENGAN LOGO BARU) */
        .cert-header { 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            margin-bottom: 20px; 
            border-bottom: 1px solid #c5a059; 
            padding-bottom: 10px;
        }

        .header-left { width: 220px; text-align: left; }
        .header-center { flex-grow: 1; text-align: center; }
        .header-right { width: 220px; text-align: right; }

        /* LINGKARAN, BACKGROUND, BORDER, DAN PADDING DIHAPUS, UKURAN DIGEDEIN */
        .cert-seal-img {
            width: 200px;
            height: 200px;
            object-fit: contain;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.2));
        }

        .cert-title { font-family: 'Playfair Display', serif; color: #1a2b4c; font-size: 2.8rem; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 5px; }
        .cert-subtitle { font-family: 'Montserrat', sans-serif; color: #c5a059; font-size: 1.2rem; font-weight: 800; letter-spacing: 3px; margin-bottom: 5px; }
        .cert-no { font-family: 'Montserrat', sans-serif; font-size: 0.9rem; font-weight: 700; color: #333; letter-spacing: 1px; margin-top: 10px; }

        .title-address { color: #333; font-size: 0.8rem; font-weight: 500; margin-top: 5px; line-height: 1.3; }

        .cert-body-layout { display: flex; align-items: center; margin-top: 40px; }
        .data-grid { flex-grow: 1; display: grid; grid-template-columns: 1fr 1fr; gap: 15px 40px; }
        .data-row { display: flex; align-items: flex-end; }
        .data-label { font-family: 'Playfair Display', serif; font-style: italic; font-size: 1.05rem; color: #333; margin-right: 10px; white-space: nowrap; }
        .data-value { flex-grow: 1; border-bottom: 1px solid #c5a059; font-family: 'Montserrat', sans-serif; font-weight: 700; color: #1a2b4c; font-size: 1rem; padding-bottom: 1px; text-transform: uppercase; }

        .qr-box { background: #fff; padding: 5px; border: 2px solid #c5a059; display: inline-block; }
        .qr-text { font-family: 'Montserrat', sans-serif; font-size: 0.6rem; font-weight: 800; color: #1a2b4c; margin-top: 5px; }

        .cert-footer { text-align: center; margin-top: 50px; font-family: 'Playfair Display', serif; font-style: italic; font-size: 1rem; color: #1a2b4c; font-weight: 600; }
        .digital-attachment { max-width: 1100px; margin: 0 auto 40px; background: #1e222b; border: 1px solid #444; border-radius: 12px; padding: 30px; }

        @media print {
            body { background-color: white !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .action-bar, .digital-attachment { display: none !important; }
            .cert-wrapper { box-shadow: none !important; margin: 0 !important; padding: 0 !important; width: 100%; border: none !important; }
            .cert-border-outer { border: 8px solid #1a2b4c !important; }
            @page { size: A4 landscape; margin: 10mm; }
        }
    </style>
</head>
<body>

    @auth
    <div class="action-bar no-print container px-0" style="justify-content: space-between; align-items: center;">
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-danger fw-bold">
                <i class="fa-solid fa-right-from-bracket me-2"></i>Keluar Sistem
            </button>
        </form>

        <div class="d-flex gap-3">
            <a href="{{ route('admin.certificates.index') }}" class="btn btn-light border"><i class="fa-solid fa-arrow-left me-2"></i>Kembali</a>
            <button onclick="window.print()" class="btn btn-warning fw-bold" style="background-color: #c5a059; color: #1a2b4c; border: none;">
                <i class="fa-solid fa-print me-2"></i>Cetak / Simpan PDF
            </button>
        </div>
    </div>
    @endauth

    <div class="cert-wrapper">
        <div class="cert-border-outer">
            <div class="cert-border-inner">
                
                <div class="cert-header">
                    <div class="header-left">
                        <img src="{{ asset(app()->environment('production') ? 'public/logo2.png' : 'logo2.png') }}" class="cert-seal-img" alt="Logo">
                    </div>
                    <div class="header-center">
                        <h1 class="cert-title">CERTIFICATE</h1>
                        <div class="cert-subtitle">ARQI BIRD FARM</div>
                        <p class="title-address">
                            Jl. Melati Blok B1 No 01, Rt 01 Rw.09. Cibalongsari, Kec. KLARI KARAWANG 41371 Jawa Barat<br>
                            Telp. +62 813-1027-1517 / +62 812-1042-9093
                        </p>
                        <div class="cert-no">E-CERTIFICATE NO: {{ $certificate->ring_number }}</div>
                    </div>
                    <div class="header-right">
                        <div class="qr-box">{!! $qrcode !!}</div>
                        <div class="qr-text">SCAN FOR<br>VERIFICATION</div>
                    </div>
                </div>

                <div class="cert-body-layout">
                    <div class="data-grid">
                        <div class="data-row">
                            <span class="data-label">Nomor Ring:</span>
                            <span class="data-value" style="font-size: 1.2rem;">{{ $certificate->ring_number }}</span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">Jenis Burung:</span>
                            <span class="data-value">{{ $certificate->bird_type }}</span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">Tanggal Menetas:</span>
                            <span class="data-value">{{ \Carbon\Carbon::parse($certificate->hatch_date)->format('d F Y') }}</span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">Kelamin / Gender:</span>
                            <span class="data-value">{{ $certificate->gender }}</span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">Indukan Jantan (Pacek):</span>
                            <span class="data-value">{{ $certificate->father_breeder }}</span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">Indukan Betina (Biang):</span>
                            <span class="data-value">{{ $certificate->mother_breeder }}</span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">Peternak (Farm):</span>
                            <span class="data-value">{{ $certificate->farm_name }}</span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">Warna Ring:</span>
                            <span class="data-value">{{ $certificate->ring_color }}</span>
                        </div>
                    </div>
                </div>

                <div class="cert-footer">
                    Diterbitkan pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                </div>
            </div>
        </div>
    </div>

    <div class="digital-attachment no-print">
        <h5 class="fw-bold mb-4 pb-2 border-bottom text-light" style="border-color: #444 !important;">
            <i class="fa-solid fa-photo-film me-2" style="color: #c5a059;"></i>Lampiran Media Digital
        </h5>
        <div class="row g-4">
            <div class="col-md-6">
                <p class="small fw-bold text-light mb-2">Foto Profil Burung</p>
                @if($certificate->photo_path)
                    <img src="{{ asset('storage/' . $certificate->photo_path) }}" class="img-fluid rounded w-100" style="max-height: 350px; object-fit: cover;" alt="Foto">
                @else
                    <div class="bg-dark text-muted text-center rounded d-flex align-items-center justify-content-center" style="height: 250px;">Tidak ada foto</div>
                @endif
            </div>
            
            <div class="col-md-6">
                <p class="small fw-bold text-light mb-2">Video Rekaman Kicau</p>
                @if($certificate->video_path)
                    <video controls class="w-100 rounded" style="max-height: 350px; background: #000;">
                        <source src="{{ asset('storage/' . $certificate->video_path) }}" type="video/mp4">
                    </video>
                @else
                    <div class="bg-dark text-muted text-center rounded d-flex align-items-center justify-content-center" style="height: 250px;">Tidak ada video</div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>