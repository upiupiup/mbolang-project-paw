<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            // Setiap kategori hanya milik satu user (relasi one-to-many)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Nama kategori (misal: Pantai, Gunung)
            $table->string('name');

            // Jika ingin memastikan tiap user tidak punya nama kategori yang sama:
            // $table->unique(['user_id', 'name']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};

