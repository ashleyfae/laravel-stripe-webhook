<?php
/**
 * WebhookEventHandler.php
 *
 * @package   laravel-stripe-webhook
 * @copyright Copyright (c) 2021, Ashley Gibson
 * @license   MIT
 */

namespace Ashleyfae\LaravelStripeWebhook;

interface WebhookEventHandler
{

    public function handle(object $payload): void;

}
