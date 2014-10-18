<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ticket_events', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('ticket_id')->unsigned();
            $table->string('status');
            $table->dateTime('date');

            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('ticket_events', function (Blueprint $table)
        {
            $table->dropForeign('ticket_events_ticket_id_foreign');
        });

		Schema::drop('ticket_events');
	}

}
