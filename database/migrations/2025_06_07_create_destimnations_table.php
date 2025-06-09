<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // dari kolom 'kategori'
            $table->string('name');
            $table->string('slug')->unique(); // URL-friendly nama
            $table->string('image'); // nama file gambar (ex: pantai.jpg)
            $table->text('description');
            $table->string('location');
            $table->string('contact_person');
            $table->string('gmaps_link'); // dari link gmaps
            $table->timestamps();
        });
    }

    /**
     * Balikkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
