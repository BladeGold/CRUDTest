<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('api', function($data){
            $customFormat = [
                'error' => false,
                'data'   => $data
            ];
            return Response::make($customFormat, 200);
        });

        Response::macro('error', function($data){
            $customFormat = [
                'error' => true,
                'data'  => $data
            ];
            return Response::make($customFormat, 400);
        });
    }
}
