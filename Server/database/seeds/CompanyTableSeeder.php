<?php

use Illuminate\Database\Seeder;
use SpreadOut\Repositories\BranchContract;
use SpreadOut\Repositories\Eloquent\CityRepository;
use SpreadOut\Services\CompanyService;
use SpreadOut\Services\PersonService;

class CompanyTableSeeder extends Seeder {

    /**
     * @var array
     */
    protected $companies = [
        'Politie', 'Pompieri', 'Primarie', 'Spiru Haret'
    ];

    /**
     * @var CompanyService
     */
    private $company;
    /**
     * @var CityRepository
     */
    private $city;
    /**
     * @var BranchContract
     */
    private $branch;

    /**
     * @param CompanyService $company
     * @param CityRepository $city
     * @param BranchContract $branch
     * @internal param PersonService $person
     */
    public function __construct(CompanyService $company, CityRepository $city, BranchContract $branch)
    {
        $this->company = $company;
        $this->city = $city;
        $this->branch = $branch;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 0;

        $cities = $this->city->all();

        foreach ($cities as $city)
        {
            foreach ($this->companies as $company)
            {
                $company = $this->company->create([
                    'name' => $company,
                    'email' => 'test@test.dev'.$i,
                    'password' => 'dev',
                    'phone' => '0'.$i,
                    'cui'   => '1'.$i,
                    'city'  => $city['id'],
                ]);

                $this->branch->create([
                    'name' => $company['name'],
                    'city_id' => $city['id'],
                    'company_id' => $company['id'],
                ]);

                echo ! $company ?: sprintf('%s was created !%s', $company['name'], PHP_EOL);

                $i++;
            }
        }
    }

}
