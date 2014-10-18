<?php namespace SpreadOut\Services;

use SpreadOut\Repositories\BranchContract;
use SpreadOut\Repositories\CompanyContract;

class CompanyService {
    /**
     * @var CompanyContract
     */
    private $company;
    /**
     * @var BranchContract
     */
    private $branch;

    /**
     * @param CompanyContract $company
     * @param BranchContract $branch
     */
    public function __construct(CompanyContract $company, BranchContract $branch)
    {
        $this->company = $company;
        $this->branch = $branch;
    }

    public function create(array $data)
    {
        
    }
}