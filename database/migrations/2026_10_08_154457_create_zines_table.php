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
        Schema::create('zines', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('issue_number');
            $table->string('author'); // Kolektif / Penulis
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('pdf_file'); // Path file PDF di storage / URL external
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zines');
    }
};
