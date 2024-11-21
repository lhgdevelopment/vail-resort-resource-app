<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->dropColumn(['type', 'file_path', 'embed_code']);
            
            // Add the new column after dropping the specified ones
            $table->string('feature_image')->nullable()->after('description');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->enum('type', ['file', 'link']);
            $table->string('file_path')->nullable();
            $table->longText('embed_code')->nullable();

            // Drop the newly added column
            $table->dropColumn('feature_image');
        });
    }
};
