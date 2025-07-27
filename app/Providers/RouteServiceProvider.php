<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Http\Middleware\ApiTokenAuth;
use Illuminate\Http\RedirectResponse;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/dashboard';
    public function boot(): void
    {
        
        Route::aliasMiddleware('api.token', ApiTokenAuth::class);

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        parent::boot();

    
        RedirectResponse::macro('home', function () {
            return auth()->user()?->is_admin
                ? redirect('/admin')
                : redirect('/dashboard');
            });
        }
}
