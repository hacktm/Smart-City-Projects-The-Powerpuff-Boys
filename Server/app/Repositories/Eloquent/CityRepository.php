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
     * Returns all the cities
     *
     * @return bool
     */
    public function all()
    {
        return $this->toArray($this->model->all());
    }

    /**
     * Search city
     *
     * @param array $data
     * @return bool
     */
    public function search(array $data)
    {
        $find = $this->model;

        if (isset($data['id']))
        {
            $find = $find->where('id', $data['id']);
        }

        if (isset($data['name']))
        {
            $find = $find->where('name', 'LIKE', '%'.$data['name'].'%');
        }

        if (isset($data['county']))
        {
            $find = $find->where('county_id', $data['county']);
        }

        return $this->toArray($find->get());
    }

    /**
     * @param array $data
     * @return array
     */
    public function create(array $data)
    {
        $city = $this->getNew();
        $city->name = $data['name'];
        $city->county_id = $data['county_id'];
        $city->save();

        return $this->toArray($city);
    }
}