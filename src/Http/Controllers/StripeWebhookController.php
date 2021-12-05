<?php
/**
 * StripeWebhookController.php
 *
 * @package   laravel-stripe-webhook
 * @copyright Copyright (c) 2021, Ashley Gibson
 * @license   GPL2+
 */

namespace Ashleyfae\LaravelStripeWebhook\Http\Controllers;

use Ashleyfae\LaravelStripeWebhook\Exceptions\InvalidWebhookEventException;
use Ashleyfae\LaravelStripeWebhook\Exceptions\UnregisteredWebhookEventException;
use Ashleyfae\LaravelStripeWebhook\Http\Middleware\VerifyWebhookSignature;
use Ashleyfae\LaravelStripeWebhook\WebhookEventHandler;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripeWebhookController extends Controller
{

    public function __construct()
    {
        if (config('stripe-webhook.secret')) {
            $this->middleware(VerifyWebhookSignature::class);
        }
    }

    public function __invoke(Request $request): JsonResponse
    {
        $payload = json_decode($request->getContent());

        Log::debug('Webhook received. Event type: '.$payload->type ?? 'n/a');

        try {
            $handler = $this->getEventHandler($payload->type ?? '');

            return new JsonResponse($handler->handle($payload));
        } catch (UnregisteredWebhookEventException $e) {
            return new JsonResponse($e->getMessage(), 200);
        } catch (\Exception $e) {
            Log::error('Webhook exception: '.$e->getMessage());

            return new JsonResponse($e->getMessage(), 500);
        }
    }

    /**
     * @param  string  $eventType
     *
     * @return WebhookEventHandler
     * @throws InvalidWebhookEventException|UnregisteredWebhookEventException
     */
    private function getEventHandler(string $eventType): WebhookEventHandler
    {
        $events = config('stripe-webhook.events');
        if (! array_key_exists($eventType, $events)) {
            throw new UnregisteredWebhookEventException("Event method {$eventType} not implemented.");
        }

        try {
            $handler = app()->make($events[$eventType]);
        } catch (BindingResolutionException $e) {
            throw new InvalidWebhookEventException("Failed to resolve {$eventType} handler.", 500, $e);
        }

        if (! in_array(WebhookEventHandler::class, class_implements($handler), true)) {
            throw new InvalidWebhookEventException(sprintf(
                "The %s class must implement the WebhookEventHandler interface.",
                $handler::class
            ));
        }

        return $handler;
    }

}
