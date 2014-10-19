<?php

use Illuminate\Database\Seeder;
use SpreadOut\Repositories\Eloquent\CityRepository;
use SpreadOut\Repositories\Eloquent\CountyRepository;

class CountyTableSeeder extends Seeder {

    /**
     * @var array
     */
    protected $counties = ['Alba', 'Arad', 'Arges', 'Bacau',
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
