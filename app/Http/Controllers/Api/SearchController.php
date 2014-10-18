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

    public function branch()
    {
        $input = Input::all();

        return $this->company->searchBranch($input);
    }
}