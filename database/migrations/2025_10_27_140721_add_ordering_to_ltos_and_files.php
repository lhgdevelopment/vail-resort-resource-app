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
            $table->integer('priority')->default(0)->after('to_date');
        });

        Schema::table('lto_files', function (Blueprint $table) {
            $table->integer('priority')->default(0)->after('file_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ltos', function (Blueprint $table) {
            $table->dropColumn('priority');
        });

        Schema::table('lto_files', function (Blueprint $table) {
            $table->dropColumn('priority');
        });
    }
};
