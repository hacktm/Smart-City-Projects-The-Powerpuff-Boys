<?php

use Illuminate\Database\Seeder;
use SpreadOut\Repositories\BranchContract;
use SpreadOut\Repositories\Eloquent\CityRepository;
use SpreadOut\Repositories\TagContract;
use SpreadOut\Services\CompanyService;
use SpreadOut\Services\PersonService;

class CompanyTableSeeder extends Seeder {

    /**
     * @var array
     */
    protected $companies = [
        'Primaria', 'Politia'
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
     * @var TagContract
     */
    private $tag;

    /**
     * @param CompanyService $company
     * @param CityRepository $city
     * @param BranchContract $branch
     * @param TagContract $tag
     * @internal param PersonService $person
     */
    public function __construct(CompanyService $company, CityRepository $city,
                                BranchContract $branch,
                                TagContract $tag)
    {
        $this->company = $company;
        $this->city = $city;
        $this->branch = $branch;

        $this->tags = $tag->all();
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

                $this->createBranch($company, $city);

                echo ! $company ?: sprintf('Company %s was created !%s', $company['name'], PHP_EOL);

                $i++;
            }
        }
    }

    /**
     * @param $company
     * @param $city
     */
    protected function createBranch($company, $city)
    {
        $branch = $this->branch->create([
            'name' => $company['name'],
            'city_id' => $city['id'],
            'company_id' => $company['id'],
        ]);

        $this->attachTag($branch);
    }

    /**
     * Attach tag to an company
     *
     * @param $branch
     * @internal param $company
     */
    public function attachTag($branch)
    {
        shuffle($this->tags);

        $tags = array_slice($this->tags, 0, mt_rand(1, count($this->tags) - 1));

        foreach ($tags as $tag)
        {
            $this->company->attachTag($branch['id'], $tag);
        }
    }
}
