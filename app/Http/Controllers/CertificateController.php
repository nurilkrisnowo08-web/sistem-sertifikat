<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use QrCode;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::latest()->get();
        return view('admin.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ring_number' => 'required|unique:certificates,ring_number',
            'hatch_date' => 'required|date',
            'gender' => 'required|in:JANTAN,BETINA',
            'ring_color' => 'required|string',
            'father_breeder' => 'required|string',
            'mother_breeder' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi|max:20480',
        ]);

        $certificateNumber = 'CERT-' . strtoupper(Str::random(8));

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');
        }

        // Alamat dan Nama Farm otomatis di-set ke ARQI BIRD FARM
        Certificate::create([
            'certificate_number' => $certificateNumber,
            'ring_number' => $request->ring_number,
            'hatch_date' => $request->hatch_date,
            'bird_type' => $request->bird_type ?? 'MURAI BATU',
            'gender' => $request->gender,
            'ring_color' => $request->ring_color,
            'father_breeder' => $request->father_breeder,
            'mother_breeder' => $request->mother_breeder,
            'farm_name' => 'ARQI BIRD FARM', 
            'phone_1' => '+62 813-1027-1517',
            'phone_2' => '+62 812-1042-9093',
            'photo_path' => $photoPath,
            'video_path' => $videoPath,
        ]);

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat baru ARQI BIRD FARM berhasil dibuat!');
    }

    public function edit($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('admin.edit', compact('certificate'));
    }

    public function update(Request $request, $id)
{
    $certificate = Certificate::findOrFail($id);

    $request->validate([
        'ring_number' => 'required|unique:certificates,ring_number,' . $id,
        'hatch_date' => 'required|date',
        'gender' => 'required|in:JANTAN,BETINA',
        'ring_color' => 'required|string',
        'father_breeder' => 'required|string',
        'mother_breeder' => 'required|string',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'video' => 'nullable|mimes:mp4,mov,avi|max:20480',
    ]);

    $data = [
        'ring_number' => $request->ring_number,
        'hatch_date' => $request->hatch_date,
        'bird_type' => $request->bird_type,
        'gender' => $request->gender,
        'ring_color' => $request->ring_color,
        'father_breeder' => $request->father_breeder,
        'mother_breeder' => $request->mother_breeder,
    ];

    if ($request->hasFile('photo')) {
        if ($certificate->photo_path) {
            Storage::disk('public')->delete($certificate->photo_path);
        }

        $data['photo_path'] = $request->file('photo')->store('photos', 'public');
    }

    if ($request->hasFile('video')) {
        if ($certificate->video_path) {
            Storage::disk('public')->delete($certificate->video_path);
        }

        $data['video_path'] = $request->file('video')->store('videos', 'public');
    }

    $certificate->update($data);

    return redirect()
        ->route('admin.certificates.index')
        ->with('success', 'Sertifikat berhasil diperbarui!');
}
    public function show($certificate_number)
    {
        $certificate = Certificate::where('certificate_number', $certificate_number)->firstOrFail();
        $url = route('certificates.show', $certificate->certificate_number);
        $qrcode = QrCode::size(160)->margin(1)->generate($url);

        return view('public.show', compact('certificate', 'qrcode'));
    }

    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id);

        // Hapus file foto jika ada
        if ($certificate->photo_path) {
            Storage::disk('public')->delete($certificate->photo_path);
        }

        // Hapus file video jika ada
        if ($certificate->video_path) {
            Storage::disk('public')->delete($certificate->video_path);
        }

        // Hapus data dari database
        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('success', 'Sertifikat berhasil dihapus!');
    }
}
