<?php

use Illuminate\Database\Seeder;
use SpreadOut\Repositories\Eloquent\CityRepository;

class CityTableSeeder extends Seeder {

    /**
     * @var array
     */
    protected $cities = [
        'Timisoara',
        'Galati',
        'Bucuresti',
        'Iasi',
        'Cluj'
    ];

    /**
     * @var CityRepository
     */
    private $city;

    /**
     * @param CityRepository $city
     */
    public function __construct(CityRepository $city)
    {
        $this->city = $city;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->cities as $city)
        {
            $isCreated = $this->city->create([
                'name' => $city
            ]);
            echo ! $isCreated ?: sprintf('City %s created !%s', $city, PHP_EOL);
        }
    }

}
