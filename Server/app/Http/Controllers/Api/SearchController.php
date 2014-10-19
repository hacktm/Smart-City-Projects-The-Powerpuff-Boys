<?php namespace SpreadOut\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use SpreadOut\Services\CompanyService;
use SpreadOut\Services\LocationService;

class SearchController extends Controller {
    /**
     * @var CompanyService
     */
    private $company;
    /**
     * @var LocationService
     */
    private $location;

    /**
     * @param CompanyService $company
     * @param LocationService $location
     */
    public function __construct(CompanyService $company, LocationService $location)
    {
        $this->company = $company;
        $this->location = $location;
    }

    /**
     * Search branch
     *
     * @return mixed
     */
    public function branch()
    {
        $input = Input::all();

        return $this->company->searchBranch($input);
    }

    /**
     * Search company
     *
     * @return mixed
     */
    public function company()
    {
        $input = Input::all();

        return $this->company->search($input);
    }

    /**
     * Search county
     *
     * @return mixed
     */
    public function county()
    {
        $input = Input::all();

        return $this->location->searchCounty($input);
    }

    /**
     * Search city
     *
     * @return mixed
     */
    public function city()
    {
        $input = Input::all();

        return $this->location->searchCity($input);
    }

    /**
     * Search company
     *
     * @return mixed
     */
    public function tag()
    {
        $input = Input::all();

        return $this->company->searchTags($input);
    }
}