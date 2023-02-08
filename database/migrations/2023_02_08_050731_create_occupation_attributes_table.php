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
        Schema::create('occupation_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 15);
            $table->integer('life');
            $table->integer('strength');
            $table->integer('dexterity');
            $table->integer('intelligence');
            $table->integer('attack');
            $table->integer('speed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('occupation_atributes');
    }
};
