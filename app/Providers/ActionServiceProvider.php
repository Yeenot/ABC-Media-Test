<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    private $actions = [
        [
            'class' => 'App\Services\Products\GenerateProductCode',
            'dependencies' => ['App\Services\Products\IsProductCodeExist']
        ],
        [
            'class' => 'App\Services\Products\CreateProduct',
            'dependencies' => ['App\Services\Products\GenerateProductCode']
        ]
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // bind
        foreach ($this->actions as $key => $item) {
            $this->app->bind($item['class'], function ($app) use ($item) {
                return $this->attach($app, $item);
            });
        }
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

    protected function attach($app, $item)
    {
        $dependencies = [];
        foreach ($item['dependencies'] as $dependency) {
            $dependencies[] = $app->make($dependency);
        }
        return new $item['class'](...$dependencies);
    }
}