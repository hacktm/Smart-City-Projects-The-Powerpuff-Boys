<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('cui')->unique();
            $table->string('name');
            $table->string('username', 50)->unique();
            $table->string('password', 64);
            $table->integer('city_id')->unsigned();
            $table->boolean('active');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('companies');
	}

}
