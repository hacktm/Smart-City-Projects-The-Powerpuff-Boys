<?php

use Illuminate\Database\Seeder;
use SpreadOut\Repositories\Eloquent\CityRepository;

class CityTableSeeder extends Seeder {

    /**
     * @var array
     */
    protected $cities = ['Alba Iulia', 'Arad', 'Pitesti', 'Bacau',
        'Oradea', 'Bistrita', 'Botosani', 'Brasov', 'Braila', 'Buzau', 'Resita',
        'Calarasi', 'Cluj-Napoca', 'Constanta', 'Sfantu Gheorghe', 'Targoviste',
        'Craiova', 'Galati', 'Giurgiu', 'Targu Jiu', 'Miercurea Ciuc', 'Deva',
        'Slobozia', 'Iasi', 'Bucuresti', 'Baia Mare', 'Drobeta-Turnu Severin',
        'Targu Mures', 'Piatra Neamt', 'Slatina', 'Ploiesti', 'Satu Mare', 'Zalau',
        'Sibiu', 'Suceava', 'Alexandria', 'Timisoara', 'Tulcea', 'Vaslui',
        'Ramnicu Valcea', 'Focsani'
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
        $i = 1;
        foreach ($this->cities as $city)
        {
            $isCreated = $this->city->create([
                'name' => $city,
                'county_id' => $i,
            ]);
            echo ! $isCreated ?: sprintf('City %s created !%s', $city, PHP_EOL);
            $i++;
        }
    }

}
