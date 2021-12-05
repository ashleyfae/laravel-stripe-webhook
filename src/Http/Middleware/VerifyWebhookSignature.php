<?php
/**
 * VerifyWebhookSignature.php
 *
 * @package   laravel-stripe-webhook
 * @copyright Copyright (c) 2021, Ashley Gibson
 * @license   GPL2+
 */

namespace Ashleyfae\LaravelStripeWebhook\Http\Middleware;

use Illuminate\Http\Request;
use Stripe\Exception\SignatureVerificationException;
use Stripe\WebhookSignature;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class VerifyWebhookSignature
{

    public function handle(Request $request, \Closure $next)
    {
        try {
            WebhookSignature::verifyHeader(
                $request->getContent(),
                $request->header('Stripe-Signature'),
                config('stripe-webhook.secret'),
                config('stripe-webhook.tolerance')
            );
        } catch (SignatureVerificationException $e) {
            throw new AccessDeniedHttpException($e->getMessage(), $e);
        }

        return $next($request);
    }

}
