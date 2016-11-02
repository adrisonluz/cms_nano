<?php

namespace App\Providers;

use Auth;
use App\Models\CMSUser;
use App\Auth\NanoCMSUserProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Description of CustomAuthProvider
 *
 */
class NanoCMSAuthAuthProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        Auth::extend('customUser', function($app) {
            // Return an instance of Illuminate\Contracts\Auth\UserProvider...
            return new CustomUserProvider(new User);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
