<?php

Namespace Tsubasarcs\Recommendations\Facades;

use Illuminate\Support\Facades\Facade;
use Tsubasarcs\Recommendations\CodeService;

class Code extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CodeService::class;
    }
}