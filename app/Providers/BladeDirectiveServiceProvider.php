<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
class BladeDirectiveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::directive('userAuth', function () {
            return "<?php
                \$user = Auth::user();
                \$user_type = \$user ? \$user->user_type ?? 'default' : 'default';
                \$user_name = \$user ? \$user->name ?? 'Guest' : 'Guest';
                \$user_email = \$user ? \$user->email ?? '' : '';
            ?>";
        });

        // You can add more custom directives here
        // Example: Role-based directive
        Blade::directive('hasRole', function ($expression) {
            return "<?php if(Auth::check() && Auth::user()->user_type === {$expression}): ?>";
        });

        Blade::directive('endHasRole', function () {
            return "<?php endif; ?>";
        });

        // Example: User display name directive
        Blade::directive('userName', function () {
            return "<?php echo Auth::check() ? Auth::user()->name : 'Guest'; ?>";
        });
    }
}
