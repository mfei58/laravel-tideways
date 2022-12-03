<?php
namespace laravelTideways\middleware;
use Closure;
use laravelTideways\facade\Tideways;

class ViaTideways
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next)
    {
        Tideways::enable();
        return $next($request);
    }

    public function terminate($request, $response)
    {
        Tideways::disable();
    }
}
