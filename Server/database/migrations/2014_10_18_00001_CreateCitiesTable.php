<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cities', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('county_id')->unsigned();
            $table->string('name');
            $table->foreign('county_id')->references('id')->on('counties')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('cities', function (Blueprint $table)
        {
            $table->dropForeign('cities_county_id_foreign');
        });
        Schema::drop('cities');
	}

}
