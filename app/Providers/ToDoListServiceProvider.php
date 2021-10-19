<?php

namespace App\Providers;

use App\ToDoList\ToDoListService;
use Illuminate\Support\ServiceProvider;

class ToDoListServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( ToDoListService::class , function($app) {
            return new ToDoListService;

        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
