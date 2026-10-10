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
        Schema::create('bands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('city');
            $table->string('genre'); // Hardcore, Grindcore, Sludge, Powerviolence, Crust Punk, dll.
            $table->text('bio')->nullable();
            $table->string('logo_or_photo')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('bandcamp_url')->nullable();
            $table->string('spotify_url')->nullable();
            $table->text('discography')->nullable(); // Ringkasan diskografi / album
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bands');
    }
};
