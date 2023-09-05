<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fumigaciones', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->date('fecha')->nullable();
           $table->time('hora')->nullable();
           $table->string('invernadero', 100)->nullable();
           $table->string('tratamiento', 100)->nullable();
           $table->string('encargado', 100)->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fumigaciones');
    }
};
