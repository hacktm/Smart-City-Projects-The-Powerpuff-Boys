<?php namespace SpreadOut\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind(
            'SpreadOut\Repositories\UserContract',
            'SpreadOut\Repositories\Eloquent\UserRepository'
        );

        $this->app->bind(
            'SpreadOut\Repositories\CompanyContract',
            'SpreadOut\Repositories\Eloquent\CompanyRepository'
        );

        $this->app->bind(
            'SpreadOut\Repositories\PersonContract',
            'SpreadOut\Repositories\Eloquent\PersonRepository'
        );
    }
}