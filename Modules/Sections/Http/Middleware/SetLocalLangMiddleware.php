<?php

namespace Modules\Sections\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocalLangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->local) {
            app()->setLocale($request->local);
        } else {
            app()->setLocale('ar');
        }
        return $request->local;
    }
}
