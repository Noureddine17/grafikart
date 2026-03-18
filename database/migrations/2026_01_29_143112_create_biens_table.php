<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ForeignIdColumnDefinition;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('biens', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('Surface');
            $table->integer('prix');
            $table->text('description');
            $table->integer('pieces');
            $table->integer('etage');
            $table->string('address');
            $table->string('ville');
            $table->string('code_postal');
            $table->string('options')->nullable();
            $table->string('images');
            $table->string('chambre')->nullable();
            $table->boolean('vendue')->default(false);
            $table->timestamps();
        });

        
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biens');
    }
};
