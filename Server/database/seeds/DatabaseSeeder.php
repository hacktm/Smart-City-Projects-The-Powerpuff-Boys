<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {

    protected $tables = [
        'City' => ['cities'],
        'Person' => ['users', 'persons'],
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

        $this->truncateTables();
        $this->seedTables();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}

    protected function truncateTables()
    {
        foreach ($this->tables as $key => $table)
        {
            foreach ($table as $t)
            {
                DB::table($t)->truncate();
            }
        }
    }

    protected function seedTables()
    {
        foreach ($this->tables as $key => $table)
        {
            $this->call($key . 'TableSeeder');
        }
    }
}
