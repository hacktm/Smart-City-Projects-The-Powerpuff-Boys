<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('branches', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->integer('city_id')->unsigned();
            $table->integer('company_id')->unsigned();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('branches', function (Blueprint $table)
        {
            $table->dropForeign('branches_city_id_foreign');
            $table->dropForeign('branches_company_id_foreign');
        });

        Schema::drop('branches');
	}

}
