<?php

namespace App\Builder;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public function register()
    {        
        $this->app->bind(
            'App\Builder\CasinoInterface',
            'App\Builder\Casino'
        );
    }
}