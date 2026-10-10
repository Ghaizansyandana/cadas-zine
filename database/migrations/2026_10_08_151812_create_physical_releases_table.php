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
        Schema::create('physical_releases', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('band_name');
            $table->enum('format', ['kaset', 'cd', 'vinyl', 'zine'])->default('kaset');
            $table->string('price')->default('50K');
            $table->string('cover_image')->nullable();
            $table->string('buy_link')->nullable(); // Link Tokopedia / Shopee / IG / Bandcamp
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physical_releases');
    }
};
