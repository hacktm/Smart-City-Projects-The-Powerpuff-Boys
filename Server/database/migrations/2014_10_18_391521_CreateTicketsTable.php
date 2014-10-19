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
            $table->integer('person_id')->unsigned();
            $table->integer('branch_id')->unsigned();
            $table->enum('type', ['complain', 'proposal']);
            $table->text('title');
            $table->text('description');
            $table->enum('status', ['opened', 'pending', 'assigned', 'solved', 'duplicate', 'refused'])->default('opened');
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
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
            $table->dropForeign('tickets_person_id_foreign');
            $table->dropForeign('tickets_branch_id_foreign');
        });

        Schema::drop('tickets');
	}

}
