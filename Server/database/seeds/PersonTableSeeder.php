<?php

use Illuminate\Database\Seeder;
use SpreadOut\Repositories\Eloquent\CityRepository;
use SpreadOut\Services\PersonService;

class PersonTableSeeder extends Seeder {

    /**
     * @var array
     */
    protected $persons = [
        [
            'email' => 'demo',
            'password' => 'demo',
            'phone' => '0740003333',
            'firstname' => 'Demo',
            'lastname' => 'Account'
        ],
        [
            'email' => 'dev',
            'password' => 'dev',
            'phone' => '321321321',
            'firstname' => 'Dev',
            'lastname' => 'Dev'
        ],
        [
            'email' => 'ionut.milica@gmail.com',
            'password' => 'dev',
            'phone' => '3',
            'firstname' => 'Ionut',
            'lastname' => 'Milica'
        ],
        [
            'email' => 'hanca.cristian@gmail.com',
            'password' => 'dev',
            'phone' => '3123213',
            'firstname' => 'Cristian',
            'lastname' => 'Hanca'
        ],
        [
            'email' => 'cristif3@gmail.com',
            'password' => 'dev',
            'phone' => '3142313',
            'firstname' => 'Cristi',
            'lastname' => 'Filip'
        ],
    ];

    /**
     * @var PersonService
     */
    private $person;

    /**
     * @param PersonService $person
     */
    public function __construct(PersonService $person)
    {
        $this->person = $person;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->persons as $person)
        {
            $wasCreated = $this->person->create($person);
            echo ! $wasCreated ?: sprintf('%s was created !%s', $person['email'], PHP_EOL);
        }
    }

}
