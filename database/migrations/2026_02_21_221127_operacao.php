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
        Schema::create('operacao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('carteira_id'); 

            $table->string('descricao');
            $table->string('status');
            $table->double('valor');            
            
            $table->timestamps();

            $table->foreign('carteira_id')->references('id')->on('carteira');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
