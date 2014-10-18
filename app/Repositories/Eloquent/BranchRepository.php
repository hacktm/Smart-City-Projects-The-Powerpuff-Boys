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
     * Create branch
     *
     * @param array $data
     */
    public function create(array $data)
    {
        $branch = $this->getNew();
        $branch->name = $data['name'];
        $branch->company_id = $data['company_id'];
    }
}