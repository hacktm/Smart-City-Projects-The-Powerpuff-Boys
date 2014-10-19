<?php namespace SpreadOut\Repositories\Eloquent;

use SpreadOut\County;
use SpreadOut\Repositories\CountyContract;

class CountyRepository extends AbstractRepository implements CountyContract {

    /**
     * @param County $model
     */
    public function __construct(County $model)
    {
        $this->model = $model;
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

        return $this->toArray($find->get());
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