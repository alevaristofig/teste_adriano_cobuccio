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

            $table->string('tipo_operacao');           
            $table->string('status');
            $table->double('valor');  
            $table->string('descricao')->nullable();          
            
            $table->timestamps();

            $table->foreign('carteira_id')->references('id')->on('carteiras');
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
