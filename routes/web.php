<?php
/**
 * web.php
 *
 * @package   laravel-stripe-webhook
 * @copyright Copyright (c) 2021, Ashley Gibson
 * @license   MIT
 */

use Ashleyfae\LaravelStripeWebhook\Http\Controllers\StripeWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/stripe/webhook', StripeWebhookController::class)
    ->name('stripe.webhook');
