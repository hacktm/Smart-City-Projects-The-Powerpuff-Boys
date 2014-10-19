<?php

use Illuminate\Database\Seeder;
use SpreadOut\Repositories\Eloquent\CityRepository;

class CityTableSeeder extends Seeder {

    /**
     * @var array
     */
    protected $cities = ['Alba', 'Arad', 'Arges', 'Bacau',
        'Bihor', 'Bistrita-Nasaud', 'Botosani',
        'Brasov', 'Braila', 'Buzau', 'Caras-Severin',
        'Calarasi', 'Cluj', 'Constanta', 'Covasna', 'Dambovita',
        'Dolj', 'Galati', 'Giurgiu', 'Gorj', 'Harghita', 'Hunedoara',
        'Ialomita', 'Iasi', 'Ilfov', 'Maramures', 'Mehedinti', 'Mures',
        'Neamt', 'Olt', 'Prahova', 'Satu Mare', 'Salaj', 'Sibiu', 'Suceava',
        'Teleorman', 'Timis', 'Tulcea', 'Vaslui', 'Valcea', 'Vrancea'
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
