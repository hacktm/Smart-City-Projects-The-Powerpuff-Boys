<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tokens', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('token');
            $table->enum('type', ['person', 'city', 'company']);
            $table->dateTime('expiration');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('tokens', function (Blueprint $table)
        {
            $table->dropForeign('tokens_user_id_foreign');
        });

        Schema::drop('tokens');
	}

}
