<?php
/**
 * Controller.php
 *
 * @package   laravel-stripe-webhook
 * @copyright Copyright (c) 2021, Ashley Gibson
 * @license   MIT
 */

namespace Ashleyfae\LaravelStripeWebhook\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
