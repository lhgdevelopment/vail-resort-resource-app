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
        Schema::create('feel_special', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('short_description')->nullable();
            $table->json('images')->nullable();
            $table->string('button_title')->nullable();
            $table->string('button_link')->nullable();
            $table->timestamps();
        });

        // Insert a sample entry
        DB::table('feel_special')->insert([
            'title' => 'Feel Special!',
            'short_description' => 'Sign up now to unlock exclusive offers! Be the first to access limited-time deals, special events, and unforgettable experiences waiting just for you.',
            'images' => null,
            'button_title' => 'Sign Up',
            'button_link' => '#',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feel_special');
    }
};
