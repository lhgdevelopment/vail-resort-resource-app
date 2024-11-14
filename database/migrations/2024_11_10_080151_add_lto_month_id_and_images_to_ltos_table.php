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
        Schema::table('ltos', function (Blueprint $table) {
            $table->foreignId('lto_month_id')->nullable()->constrained()->after('description');
            $table->json('images')->nullable()->after('lto_month_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ltos', function (Blueprint $table) {
            $table->dropForeign(['lto_month_id']);
            $table->dropColumn(['lto_month_id', 'images']);
        });
    }
};
