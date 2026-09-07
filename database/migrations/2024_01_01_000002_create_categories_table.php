<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        $categories = ['Elektronik', 'Kendaraan', 'Properti', 'Fashion', 'Perabotan', 'Hobi & Olahraga'];
        foreach ($categories as $name) {
            \DB::table('categories')->insert([
                'name' => $name,
                'slug' => \Illuminate\Support\Str::slug($name),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};