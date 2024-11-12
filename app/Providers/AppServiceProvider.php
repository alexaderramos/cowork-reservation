<?php

namespace App\Providers;

use App\Enums\User\RoleEnum;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        /**
         * Use Bootstrap 5 for pagination.
         */
        Paginator::useBootstrapFive();

        /**
         * Directive to format the datetime to dd/mm/yyyy hh:mm.
         */
        Blade::directive('datetime', function (string $expression) {
            return "<?php echo ($expression)->format('d/m/Y H:i'); ?>";
        });

        /**
         * Directive to check if the user is admin.
         */
        Blade::if('admin', function () {
            return auth()?->user()?->role === RoleEnum::ADMIN->value;
        });

        /**
         * Directive to check if the user is not admin.
         */
        Blade::if('client', function () {
            return auth()?->user()?->role === RoleEnum::CLIENT->value;
        });
    }
}
