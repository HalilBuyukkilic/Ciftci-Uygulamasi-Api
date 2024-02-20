<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDopingliIlanlarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dopingli_ilanlar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doping_id')->constrained('dopingler');
            $table->foreignId('ilan_id')->constrained('ilanlar');
            $table->string('sure');
            $table->dateTime('bitis_zamani');
            $table->boolean('durum')->default(1)->comment('0=>pasif, 1=>aktif');
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
        Schema::dropIfExists('dopingli_ilanlar');
    }
}
