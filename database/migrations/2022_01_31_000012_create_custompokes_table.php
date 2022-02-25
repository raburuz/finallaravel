<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustompokesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custompoke', function (Blueprint $table) {
            $table->id();
            $table->string('nickname');
            $table->decimal('height');
            $table->decimal('weight');
            $table->unsignedBigInteger('ability_id')->nullable();
            $table->unsignedBigInteger('pokemon_id');
            $table->unsignedBigInteger('pokedex_id');
            $table->softDeletes();
            $table->timestamps();
            
            
            $table->foreign('ability_id')->references('id')->on('ability')->onUpdate('cascade');
            
            //Foreign key pokemon_id and HARD delete
            $table->foreign('pokedex_id')
                    ->references('id')->on('pokedex')
                    ->onDelete('cascade');
           
            //Foreign key pokemon_id and HARD delete
            $table->foreign('pokemon_id')   
                    ->references('id')->on('pokemon')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custompoke');
    }
}
