<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMultiCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multi_categories', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('kateqoriya_ad',30);
	        $table->string('slug',30);
	        $table->integer('fk_category_id')->unsigned();
	        $table->foreign('fk_category_id')
		        ->references('id')->on('categories')
		        ->onDelete('cascade');
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
        Schema::dropIfExists('multi_categories');
    }
}
