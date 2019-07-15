<?php 
namespace Javck\SmsKing\Facades;

use Illuminate\Support\Facades\Facade;

class SmsKing extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'smsking';
    }
}