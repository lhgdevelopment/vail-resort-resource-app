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
        Schema::table('ltos', function (Blueprint $table) {
            $table->dropColumn('images');
        });
    }

    public function down()
    {
        Schema::table('ltos', function (Blueprint $table) {
            $table->json('images')->nullable();
        });
    }
};
