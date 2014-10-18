<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketPersonTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ticket_person', function (Blueprint $table)
        {
            $table->integer('person_id')->unsigned();
            $table->integer('ticket_id')->unsigned();

            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
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
        Schema::table('ticket_person', function (Blueprint $table)
        {
            $table->dropForeign('ticket_person_person_id_foreign');
            $table->dropForeign('ticket_person_ticket_id_foreign');
        });

		Schema::drop('ticket_person');
	}

}
