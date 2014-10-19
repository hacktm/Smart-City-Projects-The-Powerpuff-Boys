<?php

use Illuminate\Database\Seeder;
use SpreadOut\Repositories\Eloquent\CityRepository;
use SpreadOut\Repositories\Eloquent\CountyRepository;

class CountyTableSeeder extends Seeder {

    /**
     * @var array
     */
    protected $counties = [
        'Timis',
        'Ilfov',
        'Galati',
    ];

    /**
     * @var CityRepository
     */
    private $county;

    /**
     * @param CountyRepository $county
     */
    public function __construct(CountyRepository $county)
    {
        $this->county = $county;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->counties as $county)
        {
            $isCreated = $this->county->create([
                'name' => $county
            ]);
            echo ! $isCreated ?: sprintf('County %s created !%s', $city, PHP_EOL);
        }
    }

}
