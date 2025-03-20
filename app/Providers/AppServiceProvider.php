<?php

namespace App\Providers;

use App\Http\Services\NetworkServices\BaseNetworkService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseNetworkService::class, function () {
            $type = request()->input('type', '');
            if (empty($type)) {
                abort(422, 'A type must be specified');
            }

            $gateways = Config::get('network_services.networks');
            if (! isset($gateways[$type])) {
                // Need to get this to cancel the process
                abort(422, $type.' is not valid');
            }

            return new $gateways[$type](new Client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
