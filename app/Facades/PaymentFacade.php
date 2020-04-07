<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Models\Paypal;


class PaymentFacade extends Facade {
  protected static function getFacadeAccessor() {
    return 'App\Models\Paypal';
  }
}