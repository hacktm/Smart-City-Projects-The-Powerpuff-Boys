<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {

    protected $tables = [
        'City' => 'cities',
    ];
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->seedTables();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}

    protected function seedTables()
    {
        foreach ($this->tables as $key => $table)
        {
            DB::table($table)->truncate();
            $this->call($key . 'TableSeeder');
        }
    }
}
