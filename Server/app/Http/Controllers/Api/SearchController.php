<?php namespace SpreadOut\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use SpreadOut\Services\CompanyService;

class SearchController extends Controller {
    /**
     * @var CompanyService
     */
    private $company;

    /**
     * @param CompanyService $company
     */
    public function __construct(CompanyService $company)
    {
        $this->company = $company;
    }

    /**
     * Search branch
     *
     * @return mixed
     */
    public function branch()
    {
        $input = Input::only('name', 'city');

        return $this->company->searchBranch($input);
    }

    /**
     * Search company
     *
     * @return mixed
     */
    public function company()
    {
        $input = Input::only('name', 'city');

        return $this->company->search($input);
    }
}