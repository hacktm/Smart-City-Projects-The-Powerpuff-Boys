<?php

use Illuminate\Database\Seeder;
use SpreadOut\Repositories\Eloquent\CityRepository;
use SpreadOut\Repositories\Eloquent\CountyRepository;

class CountyTableSeeder extends Seeder {

    /**
     * @var array
     */
    protected $counties = ['Alba Iulia', 'Arad', 'Pitesti', 'Bacau',
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
            echo ! $isCreated ?: sprintf('County %s created !%s', $county, PHP_EOL);
        }
    }

}
