<?php
/**
 * stripe-webhook.php
 *
 * @package   laravel-stripe-webhook
 * @copyright Copyright (c) 2021, Ashley Gibson
 * @license   GPL2+
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Webhook Secret
    |--------------------------------------------------------------------------
    |
    */
    'secret' => env('STRIPE_WEBHOOK_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Webhook Events
    |--------------------------------------------------------------------------
    | These are the registered events that your application will handle.
    */
    'events'    => [
        // Example
        //'checkout.session.completed' => CheckoutSessionCompleted::class,
    ],

];
