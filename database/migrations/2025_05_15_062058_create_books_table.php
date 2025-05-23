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
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->integer('price');
        $table->integer('stock');
        $table->string('cover_photo');
        $table->bigInteger('genre_id');
        $table->bigInteger('author_id');
        $table->timestamps();

        // // Menambahkan foreign key constraints
        // $table->foreign('genre_id')->references('id')->on('genres');
        // $table->foreign('author_id')->references('id')->on('authors');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
