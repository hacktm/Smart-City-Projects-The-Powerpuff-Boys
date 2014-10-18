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
            $table->enum('type', ['complain', 'proposal']);
            $table->text('title');
            $table->text('short_description');
            $table->text('description');
            $table->enum('status', ['opened', 'pending', 'assigned', 'solved', 'duplicate', 'refused']);
            $table->float('lat');
            $table->float('lon');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tickets');
	}

}
