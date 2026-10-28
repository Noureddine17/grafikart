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
        Schema::create('biens_options', function (Blueprint $table) {
            $table->foreignIdFor(App\Models\Bien::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(App\Models\Option::class)->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->unique(['bien_id', 'option_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biens_options');
    }
};
