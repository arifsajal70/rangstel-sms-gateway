<?php

namespace Arifsajal\RangstelSmsGateway\Facades;

use Illuminate\Support\Facades\Facade;

class Rangstel extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'rangstelsmsgateway';
    }
}
