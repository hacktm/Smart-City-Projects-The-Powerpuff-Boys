<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rating_events', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('branch_id')->unsigned();
            $table->integer('rating_id')->unsigned();
            $table->integer('value')->usinged();
            $table->dateTime('date');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('rating_id')->references('id')->on('ratings');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('rating_events', function (Blueprint $table)
        {
            $table->dropForeign('rating_events_branch_id_foreign');
            $table->dropForeign('rating_events_rating_id_foreign');
        });

		Schema::drop('rating_events');
	}

}
