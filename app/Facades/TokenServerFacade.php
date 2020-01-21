<?php


namespace App\Facades;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;

/**
 * Class TokenServerFacade
 * @package App\Facades
 * @method static mixed makeToken(string $code)
 * @method static mixed sessionKey()
 * @method static mixed openId()
 */
class TokenServerFacade extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'token.server';
    }
}
