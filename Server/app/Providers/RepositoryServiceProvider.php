<?php namespace SpreadOut\Providers;

use Illuminate\Support\ServiceProvider;
use SpreadOut\SmsNotifier\TwilioSms;

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
            'SpreadOut\Repositories\TagContract',
            'SpreadOut\Repositories\Eloquent\TagRepository'
        );

        $this->app->bind(
            'SpreadOut\Repositories\BranchContract',
            'SpreadOut\Repositories\Eloquent\BranchRepository'
        );

        $this->app->bind(
            'SpreadOut\Repositories\PersonContract',
            'SpreadOut\Repositories\Eloquent\PersonRepository'
        );

        $this->app->bind(
            'SpreadOut\Repositories\CountyContract',
            'SpreadOut\Repositories\Eloquent\CountyRepository'
        );

        $this->app->bind(
            'SpreadOut\Repositories\CityContract',
            'SpreadOut\Repositories\Eloquent\CityRepository'
        );

        $this->app->bind(
            'SpreadOut\Repositories\TicketContract',
            'SpreadOut\Repositories\Eloquent\TicketRepository'
        );

        $this->app->bind(
            'SpreadOut\Repositories\TokenContract',
            'SpreadOut\Repositories\Eloquent\TokenRepository'
        );

        /** Register and configure twilio */

        $this->app->bind('SpreadOut\SmsNotifier\SmsNotifierContract', function ($app)
        {
            return new TwilioSms(new \Services_Twilio(getenv('TWILIO_ACCOUNT_SID'),
                getenv('TWILIO_AUTH_TOKEN')), getenv('TWILIO_NUMBER'));
        });
    }
}