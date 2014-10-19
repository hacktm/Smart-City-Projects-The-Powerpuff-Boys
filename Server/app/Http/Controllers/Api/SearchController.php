<?php namespace SpreadOut\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use SpreadOut\Services\CompanyService;
use SpreadOut\Services\LocationService;
use SpreadOut\Services\TicketService;

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
     * @var TicketService
     */
    private $ticket;

    /**
     * @param CompanyService $company
     * @param LocationService $location
     */
    public function __construct(CompanyService $company, LocationService $location, TicketService $ticket)
    {
        $this->company = $company;
        $this->location = $location;
        $this->ticket = $ticket;
    }

    /**
     * Search branch
     *
     * @return mixed
     */
    public function branch()
    {
        return $this->company->searchBranch(Input::all());
    }

    /**
     * Search company
     *
     * @return mixed
     */
    public function company()
    {
        return $this->company->search(Input::all());
    }

    /**
     * Search county
     *
     * @return mixed
     */
    public function county()
    {
        return $this->location->searchCounty(Input::all());
    }

    /**
     * Search city
     *
     * @return mixed
     */
    public function city()
    {
        return $this->location->searchCity(Input::all());
    }

    /**
     * Search company
     *
     * @return mixed
     */
    public function tag()
    {
        return $this->company->searchTags(Input::all());
    }

    /**
     * @return mixed
     */
    public function ticket()
    {
        return $this->ticket->search(Input::all());
    }
}