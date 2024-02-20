<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIlanlarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ilanlar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kullanici_id')->constrained('users');
            $table->foreignId('kategori_id')->constrained('kategoriler');
            $table->string('baslik');
            $table->string('slug');
            $table->text('aciklama')->nullable();
            $table->float('fiyat', 10);
            $table->dateTime('tarih');
            $table->foreignId('il_id')->constrained('cities');
            $table->foreignId('ilce_id')->constrained('districts');
            $table->string('adres')->nullable();
            $table->boolean('telefon_goster')->default(1);
            $table->boolean('goruntulu_arama')->default(0);
            $table->boolean('takas')->default(1);
            $table->tinyInteger('kimden');
            $table->boolean('sifir_ikinci');
            $table->integer('tik_sayisi')->default(0);
            $table->boolean('onay')->default(0)->comment('0=>ilan onaylanmadı, 1=>ilan onaylandı, 2=>ilan reddedildi');
            $table->boolean('durum')->default(0);
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
        Schema::dropIfExists('ilanlar');
    }
}
