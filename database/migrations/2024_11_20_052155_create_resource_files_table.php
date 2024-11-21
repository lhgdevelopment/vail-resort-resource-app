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
        Schema::create('resource_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resource_id')->constrained()->onDelete('cascade');
            $table->enum('resource_type', ['file', 'embed_code', 'external_link']);
            $table->string('file_path')->nullable();
            $table->string('file_type')->nullable();
            $table->longText('embed_code')->nullable();
            $table->string('external_link')->nullable();
            $table->timestamps();
        });

        // Transfer files data from the old 'resources' table to the new 'resource_files' table
        DB::transaction(function () {
            $resources = DB::table('resources')->select('id', 'type', 'file_path', 'embed_code')->get();

            foreach ($resources as $resource) {
                $resourceType = $resource->type === 'file' ? 'file' : ($resource->type === 'link' ? 'embed_code' : null);
                $fileType = $resource->type === 'file' && $resource->file_path ? pathinfo($resource->file_path, PATHINFO_EXTENSION) : null;

                DB::table('resource_files')->insert([
                    'resource_id' => $resource->id,
                    'resource_type' => $resourceType,
                    'file_path' => $resource->file_path,
                    'file_type' => $fileType,
                    'embed_code' => $resource->type === 'link' ? $resource->embed_code : null,
                    'external_link' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_files');
    }
};
