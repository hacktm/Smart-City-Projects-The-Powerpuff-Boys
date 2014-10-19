<?php namespace SpreadOut\Services;

use SpreadOut\Repositories\CityContract;
use SpreadOut\Repositories\CountyContract;

class LocationService
{
    /**
     * @var CountyContract
     */
    private $county;
    /**
     * @var CityContract
     */
    private $city;

    /**
     * @param CountyContract $county
     * @param CityContract $city
     */
    public function __construct(CountyContract $county, CityContract $city)
    {
        $this->county = $county;
        $this->city = $city;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function searchCounty(array $data)
    {
        return $this->county->search($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function searchCity(array $data)
    {
        return $this->city->search($data);
    }
}