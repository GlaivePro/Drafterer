<?php

namespace GlaivePro\Drafterer;

use Illuminate\Support\ServiceProvider;

class DraftererServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
		$this->loadMigrationsFrom(__DIR__.'/../migrations');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}