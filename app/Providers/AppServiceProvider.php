<?php

namespace App\Providers;

use App\Repositories\BattleRepository;
use App\Repositories\BattleRepositoryInterface;
use App\Repositories\OccupationAttributesRepository;
use App\Repositories\OccupationAttributesRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(OccupationAttributesRepositoryInterface::class, OccupationAttributesRepository::class);
        $this->app->bind(BattleRepositoryInterface::class, BattleRepository::class);
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
