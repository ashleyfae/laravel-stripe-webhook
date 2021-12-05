<?php
/**
 * WebhookEventHandler.php
 *
 * @package   laravel-stripe-webhook
 * @copyright Copyright (c) 2021, Ashley Gibson
 * @license   GPL2+
 */

namespace Ashleyfae\LaravelStripeWebhook;

interface WebhookEventHandler
{

    public function handle(object $payload): mixed;

}
