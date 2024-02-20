<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriOzellikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_ozellik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategoriler');
            $table->foreignId('ozellik_id')->constrained('ozellikler');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_ozellik');
    }
}
