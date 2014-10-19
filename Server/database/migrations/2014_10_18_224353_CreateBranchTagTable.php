<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchTagTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('branch_tag', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('branch_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('branch_tag', function (Blueprint $table)
        {
            $table->dropForeign('branch_tag_branch_id_foreign');
            $table->dropForeign('branch_tag_tag_id_foreign');
        });
		Schema::drop('branch_tag');
	}

}
