<?php namespace SpreadOut\Repositories\Eloquent;

use SpreadOut\Company;
use SpreadOut\Repositories\CompanyContract;

class CompanyRepository extends AbstractRepository implements CompanyContract {

    /**
     * @param Company $model
     */
    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    /**
     * Create company
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        $company = $this->getNew();
        $company->user_id = $data['user_id'];
        $company->name = $data['name'];
        $company->cui = $data['cui'];

        if (isset($data['city_id'])) // Marked as optional
            $company->city_id = $data['city_id'];

        $company->save();

        return $this->toArray($company);
    }

    /**
     * Get branches by name
     *
     * @param array $data
     * @return bool|mixed
     */
    public function search(array $data)
    {
        $find = $this->model->with('tags');

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
        $this->model->find($data['company_id'])->tags()->attach($data['tag_id']);

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
        $this->model->find($data['company_id'])->tags()->detach($data['tag_id']);

        return true;
    }

    /**
     * Find company by cui
     *
     * @param $cui
     * @return bool
     */
    public function findByCUI($cui)
    {
        return $this->toArray($this->where('cui', $cui)->first());
    }

    /**
     * Find company by name
     *
     * @param $name
     * @return bool
     */
    public function findByName($name)
    {
        return $this->toArray($this->where('name', $name)->first());
    }
}