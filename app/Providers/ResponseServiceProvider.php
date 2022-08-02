<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
     /**
     * Register the application's response macros.
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
