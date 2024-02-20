<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBildirimlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bildirimler', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kullanici_id')->constrained('users')->cascadeOnDelete();
            $table->string('type')->comment('success, error, warning, info');
            $table->text('aciklama');
            $table->dateTime('zaman');
            $table->tinyInteger('okundu')->default(0)->comment('0 => Okunmayan bildirim, 1 => Okunan bildirim');
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
        Schema::dropIfExists('bildirimler');
    }
}
