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
        $find = $this->model->where('name', 'LIKE', '%'.$data['name'].'%');

        if (isset($data['city']))
        {
            $find->model->where('city_id', $data['city']);
        }

        return $this->toArray($find->get());
    }

    /**
     * Create branch
     *
     * @param array $data
     * @return mixed|void
     */
    public function create(array $data)
    {
        $branch = $this->getNew();
        $branch->name = $data['name'];
        $branch->company_id = $data['company_id'];

        return $this->toArray($branch);
    }
}