<?php namespace SpreadOut\Http\Controllers\PublicApi;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use SpreadOut\Services\CompanyService;
use SpreadOut\Services\LocationService;
use SpreadOut\Services\TicketService;

class ApiController extends Controller {
    /**
     * @var CompanyService
     */
    private $company;
    /**
     * @var TicketService
     */
    private $ticket;
    /**
     * @var LocationService
     */
    private $location;

    /**
     * @param CompanyService $company
     * @param TicketService $ticket
     * @param LocationService $location
     */
    public function __construct(CompanyService $company, TicketService $ticket, LocationService $location)
    {
        $this->middleware('SpreadOut\Http\Middleware\Pauth');

        $this->company = $company;
        $this->ticket = $ticket;
        $this->location = $location;
    }

    /**
     * Get all the cities
     *
     * @return mixed
     */
    public function cities()
    {
        return $this->location->searchCity(Input::all());
    }

    /**
     * Get all the counties
     *
     * @return mixed
     */
    public function counties()
    {
        return $this->location->searchCounty(Input::all());
    }

    /**
     * Get all companies
     *
     * @return mixed
     */
    public function companies()
    {
        return $this->company->search(Input::all());
    }

    /**
     * Get all branches
     *
     * @return mixed
     */
    public function branches()
    {
        return $this->company->searchBranch(Input::all());
    }

    /**
     * Get all the tags
     *
     * @return mixed
     */
    public function tags()
    {
        return $this->company->searchTags(Input::all());
    }

    /**
     * Get all the tickets
     *
     * @return mixed
     */
    public function tickets()
    {
        return $this->ticket->search(Input::all());
    }
}