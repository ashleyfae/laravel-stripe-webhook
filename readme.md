# Stripe Webhook

Receive and handle Stripe Webhooks in your Laravel application.

## Instructions

Update the `VerifyCsRfToken` middleware to exclude `stripe/webhook` from CSRF verification. Example:

```php
protected $except = [
    'stripe/webhook'
];
```
