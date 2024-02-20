<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloglarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bloglar', function (Blueprint $table) {
            $table->id();
            $table->string('baslik');
            $table->string('bolge')->nullable();
            $table->string('slug');
            $table->text('icerik');
            $table->string('gorsel')->nullable();
            $table->boolean('durum')->default(1);
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
        Schema::dropIfExists('bloglar');
    }
}
