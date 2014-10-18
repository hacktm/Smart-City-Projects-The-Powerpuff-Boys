<?php namespace SpreadOut\Repositories\Eloquent;

use SpreadOut\City;
use SpreadOut\Repositories\CityContract;

class CityRepository extends AbstractRepository implements CityContract {

    /**
     * @param City $model
     */
    public function __construct(City $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return array
     */
    public function create(array $data)
    {
        $city = $this->getNew();
        $city->name = $data['name'];
        $city->save();

        return $this->toArray($city);
    }
}