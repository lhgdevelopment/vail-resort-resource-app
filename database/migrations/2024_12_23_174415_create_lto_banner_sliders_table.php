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
        Schema::create('lto_banner_sliders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feel_special_id')->constrained('feel_special')->onDelete('cascade')->index();
            $table->string('file_name');
            $table->text('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lto_banner_sliders');
    }
};
