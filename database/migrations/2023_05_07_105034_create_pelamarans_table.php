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
        Schema::create('pelamarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('offer_id');
            $table->foreign('offer_id')->references('id')->on('job_offers')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('gpa', 25)->nullable();
            $table->string('status_gpa')->nullable();
            $table->char('semester', 25)->nullable();
            $table->string('status_semester')->nullable();
            $table->char('pengalaman_kerja', 25)->nullable();
            $table->string('status_pengalaman_kerja')->nullable();
            $table->text('deskripsi_pelamar');
            $table->text('cv')->nullable();
            $table->string('institution')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelamarans');
    }
};
