<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMehsulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mehsuls', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('mehsul_kodu');
            $table->string('mehsul_adi',100);
            $table->string('mehsul_title',25);
            $table->string('mehsul_slug',100);
            $table->text('mehsul_melumat');
            $table->integer('mehsul_qiymet');
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
        Schema::dropIfExists('mehsuls');
    }
}
