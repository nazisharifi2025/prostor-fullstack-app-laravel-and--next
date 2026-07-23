<?php

namespace App\Providers;

use App\Models\products;
use App\Models\User;
use App\Policies\ProductPolicy;
use App\Policies\UsertPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//         Relation::enforceMorphMap([
//     'products' => products::class,
// ]);
Gate::policy(products::class,ProductPolicy::class);
Gate::policy(User::class , UsertPolicy::class);
    }
}
