<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('logs_bien_immo', function (Blueprint $table) {
            $table->id();
            $table->string('LogMessage');
            $table->date('LogDate')->default(now());
            $table->unsignedBigInteger('bien_id')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs_bien_immo');
    }
};
