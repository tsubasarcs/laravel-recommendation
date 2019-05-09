<?php

Namespace Tsubasarcs\Recommendations\Facades;

use Illuminate\Support\Facades\Facade;

class Code extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'code';
    }
}