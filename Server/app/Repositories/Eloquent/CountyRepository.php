<?php namespace SpreadOut\Repositories\Eloquent;

use SpreadOut\City;
use SpreadOut\Repositories\CountyContract;

class CountyRepository extends AbstractRepository implements CountyContract {

    /**
     * @param City $model
     */
    public function __construct(City $model)
    {
        $this->model = $model;
    }

    /**
     * Returns all the cities
     *
     * @return bool
     */
    public function all()
    {
        return $this->toArray($this->model->all());
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