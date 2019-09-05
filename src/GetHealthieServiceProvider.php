<?php namespace AliasProject\GetHealthie;

use Illuminate\Support\ServiceProvider;

class GetHealthieServiceProvider extends ServiceProvider {

   /**
     * Bootstrap the application services.
     *
     * @return void
    */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/gethealthie.php' => config_path('gethealthie.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
    */
    public function register()
    {
        //
    }
}
