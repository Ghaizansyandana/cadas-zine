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
        Schema::table('gigs', function (Blueprint $table) {
            $table->boolean('is_approved')->default(false)->after('ticket_price');
        });

        Schema::table('lost_and_founds', function (Blueprint $table) {
            $table->boolean('is_approved')->default(false)->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('gigs', function (Blueprint $table) {
            $table->dropColumn('is_approved');
        });

        Schema::table('lost_and_founds', function (Blueprint $table) {
            $table->dropColumn('is_approved');
        });
    }
};
