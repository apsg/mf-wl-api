<?php

namespace Apsg\MF\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Apsg\MF\MF
 */
class MF extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'mf-wl-api';
    }
}
