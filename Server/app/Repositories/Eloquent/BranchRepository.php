<?php namespace SpreadOut\Repositories\Eloquent;

use SpreadOut\Branch;
use SpreadOut\Repositories\BranchContract;

class BranchRepository extends AbstractRepository implements BranchContract {

    /**
     * @param Branch $model
     */
    public function __construct(Branch $model)
    {
        $this->model = $model;
    }

    /**
     * Get branches by name
     *
     * @param array $data
     * @return bool|mixed
     */

    public function search(array $data)
    {
        $find = $this->model;

        if (isset($data['name']))
        {
           $find = $find->where('name', 'LIKE', '%'.$data['name'].'%');
        }

        if (isset($data['city']))
        {
            $find = $find->where('city_id', $data['city']);
        }

        return $this->toArray($find->get());
    }

    /**
     * Create branch
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $branch = $this->getNew();
        $branch->name = $data['name'];
        $branch->city_id = $data['city_id'];
        $branch->company_id = $data['company_id'];
        $branch->save();

        return $this->toArray($branch);
    }
}