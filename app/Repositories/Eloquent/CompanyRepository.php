<?php namespace SpreadOut\Repositories\Eloquent;

use SpreadOut\Company;

class CompanyRepositry extends AbstractRepository {

    /**
     * @param Company $model
     */
    public function __construct(Company $model)
    {
        $this->model = $model;
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