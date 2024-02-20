<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDopinglerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dopingler', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('doping_tipi');
            $table->foreignId('kategori_id')->constrained('kategoriler');
            $table->string('doping_adi');
            $table->float('fiyat');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dopingler');
    }
}
