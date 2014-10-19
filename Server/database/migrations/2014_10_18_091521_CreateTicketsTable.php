<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->enum('type', ['complain', 'proposal']);
            $table->text('title');
            $table->text('description');
            $table->enum('status', ['opened', 'pending', 'assigned', 'solved', 'duplicate', 'refused'])->default('opened');
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
        Schema::table('tickets', function (Blueprint $table)
        {
           $table->dropForeign('tickets_user_id_foreign');
        });

        Schema::drop('tickets');
	}

}
