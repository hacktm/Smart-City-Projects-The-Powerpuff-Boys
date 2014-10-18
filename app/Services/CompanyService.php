<?php namespace SpreadOut\Services;

use SpreadOut\Repositories\BranchContract;
use SpreadOut\Repositories\CompanyContract;
use SpreadOut\Repositories\UserContract;

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
     * @var UserContract
     */
    private $user;

    /**
     * @param UserContract $user
     * @param CompanyContract $company
     * @param BranchContract $branch
     */
    public function __construct(UserContract $user, CompanyContract $company, BranchContract $branch)
    {
        $this->company = $company;
        $this->branch = $branch;
        $this->user = $user;
    }

    /**
     * Create person and his username
     *
     * @param $data
     * @throws ApiException
     * @return mixed
     */
    public function create($data)
    {
        $user = $this->user->create($data);

        $data['user_id'] = $user['id'];

        $data = $this->company->create($data);
        $data['user'] = $user;

        return $data;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function searchBranch(array $data)
    {
        return $this->branch->search($data);
    }

    /**
     * @param array $data
     */
    public function createBranch(array $data)
    {

    }
}