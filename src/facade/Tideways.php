<?php
namespace laravelTideways\facade;

use Illuminate\Support\Facades\Facade;

/**
 * @see \laravelTideways\Manager
 * @package think\facade
 * @method static string enable() 开启监控
 * @method static string disable() 结束监控
 */
class Tideways extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tideways';
    }
}