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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->text('contact')->nullable();
            $table->timestamps();
        });

        // Insert a default settings record
        DB::table('settings')->insert([
            'site_name' => 'VAIL RESORTS',
            'logo' => 'logos/VR_FandB_lockup_blk.png',
            'icon' => 'icons/VR_FandB_icon_blk.png',
            'contact' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
