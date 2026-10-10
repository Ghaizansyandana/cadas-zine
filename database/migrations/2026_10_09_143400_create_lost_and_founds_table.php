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
        Schema::create('lost_and_founds', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->enum('type', ['lost', 'found'])->default('lost'); // lost = Hilang, found = Nemu
            $table->string('gig_name'); // Nama event / gig
            $table->string('city');
            $table->text('description')->nullable();
            $table->string('contact_person'); // No WA / Username IG
            $table->string('status')->default('open'); // open, resolved
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_and_founds');
    }
};
