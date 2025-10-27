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
        Schema::table('category_files', function (Blueprint $table) {
            $table->enum('resource_type', ['file', 'embed_code', 'external_link'])->default('file')->after('category_id');
            $table->longText('embed_code')->nullable()->after('file_type');
            $table->string('external_link')->nullable()->after('embed_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_files', function (Blueprint $table) {
            $table->dropColumn(['resource_type', 'embed_code', 'external_link']);
        });
    }
};
