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
            $table->string('logo_black')->nullable();
            $table->string('logo_white')->nullable();
            $table->string('icon_black')->nullable();
            $table->string('icon_white')->nullable();
            $table->text('contact')->nullable();
            $table->timestamps();
        });

        // Insert a default settings record
        DB::table('settings')->insert([
            'site_name' => 'VAIL RESORTS',
            'logo_black' => 'logos/VR_FandB_lockup_blk.png',
            'logo_white' => 'logos/VR_FandB_lockup_wht.png',
            'icon_black' => 'icons/VR_FandB_icon_blk.png',
            'icon_white' => 'icons/VR_FandB_icon_wht.png',
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
