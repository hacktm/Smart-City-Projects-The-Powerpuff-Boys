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
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->where('id', $id)->first();
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
     * Attach a tag to a company
     *
     * @param array $data
     * @return bool
     */
    public function attachTag(array $data)
    {
        $this->model->find($data['branch_id'])->tags()->attach($data['tag_id']);

        return true;
    }

    /**
     * Attach a tag to a company
     *
     * @param array $data
     * @return bool
     */
    public function detachTag(array $data)
    {
        $this->model->find($data['branch_id'])->tags()->detach($data['tag_id']);

        return true;
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