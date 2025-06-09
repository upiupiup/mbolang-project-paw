<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();

            // Foreign Key ke users
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // Foreign Key ke destinations
            $table->foreignId('destination_id')
                ->constrained('destinations')
                ->onDelete('cascade');

            // Foreign Key ke categories (nullable karena boleh tanpa kategori)
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete(); // atau ->onDelete('set null')

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookmarks');
    }
};
