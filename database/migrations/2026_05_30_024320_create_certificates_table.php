<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_number')->unique(); // Nomor unik sertifikat
            $table->string('ring_number')->unique();      // Contoh: GMK 1587
            $table->date('hatch_date');                    // Tanggal Menetas
            $table->string('bird_type')->default('MURAI BATU');
            $table->enum('gender', ['JANTAN', 'BETINA']);
            $table->string('ring_color');                  // Contoh: BIRU
            $table->string('father_breeder');              // Indukan Jantan (TEKIRO)
            $table->string('mother_breeder');              // Indukan Betina (VULCANO)
            $table->string('farm_name')->default('GILANG BF'); // Nama Farm
            
            // Kolom untuk menyimpan file media
            $table->string('photo_path')->nullable();      // Tempat simpan nama/jalur foto burung
            $table->string('video_path')->nullable();      // Tempat simpan nama/jalur video burung
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};