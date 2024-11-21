<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lto_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lto_id')->constrained()->onDelete('cascade');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_type');
            $table->timestamps();
        });

        // Transfer images from the old 'ltos' table to the new 'lto_files' table
        DB::transaction(function () {
            $ltos = DB::table('ltos')->select('id', 'images')->get();

            foreach ($ltos as $lto) {
                if ($lto->images) {
                    $images = json_decode($lto->images, true);

                    foreach ($images as $index => $imagePath) {
                        $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
                        DB::table('lto_files')->insert([
                            'lto_id' => $lto->id,
                            'file_name' => 'File ' . ($index + 1),
                            'file_path' => $imagePath,
                            'file_type' => $extension,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lto_files');
    }
};
