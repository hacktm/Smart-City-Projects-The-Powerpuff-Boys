<?php namespace SpreadOut\Services;

use SpreadOut\Repositories\BranchContract;
use SpreadOut\Repositories\CompanyContract;
use SpreadOut\Repositories\TagContract;
use SpreadOut\Repositories\UserContract;

class CompanyService
{
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
     * @var TagContract
     */
    private $tag;

    /**
     * @param UserContract $user
     * @param CompanyContract $company
     * @param BranchContract $branch
     * @param TagContract $tag
     */
    public function __construct(UserContract $user,
                                CompanyContract $company,
                                BranchContract $branch,
                                TagContract $tag)
    {
        $this->company = $company;
        $this->branch = $branch;
        $this->user = $user;
        $this->tag = $tag;
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
        $data['type'] = 'company';

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
    public function search(array $data)
    {
        return $this->company->search($data);
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
     * Search tags and their companies
     *
     * @param array $data
     * @return mixed
     */
    public function searchTags(array $data)
    {
        return $this->tag->search($data);
    }

    /**
     * @param array $data
     */
    public function createBranch(array $data)
    {
        $this->branch->create($data);
    }

    public function attachTag($branch, $tag)
    {
        return $this->branch->attachTag([
            'branch_id' => $branch,
            'tag_id' => $tag,
        ]);
    }

    public function detachTag($branch, $tag)
    {
        return $this->branch->detachTag([
            'branch_id' => $branch,
            'tag_id' => $tag,
        ]);
    }
}