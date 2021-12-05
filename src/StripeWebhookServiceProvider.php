<?php
/**
 * StripeWebhookServiceProvider.php
 *
 * @package   laravel-stripe-webhook
 * @copyright Copyright (c) 2021, Ashley Gibson
 * @license   GPL2+
 */

namespace Ashleyfae\LaravelStripeWebhook;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class StripeWebhookServiceProvider extends ServiceProvider
{

    public function register(): void
    {

    }

    public function boot(): void
    {
        Route::group([
            'middleware' => ['web']
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });

        $this->mergeConfigFrom(
            __DIR__.'/../config/stripe-webhook.php',
            'stripe-webhook'
        );

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/stripe-webhook.php' => config_path('stripe-webhook.php')
            ], 'config');
        }
    }

}
