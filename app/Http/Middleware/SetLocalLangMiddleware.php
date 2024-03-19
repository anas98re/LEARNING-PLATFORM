<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Requests\SetLocalMiddelWareRequest;
use Illuminate\Validation\Rule;

class SetLocalLangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $request->validate([
            'local' => Rule::in(['en', 'ar']),
        ]);
        if ($request->local) {
            app()->setLocale($request->local);
        } else {
            app()->setLocale('ar');
        }
        return $next($request);
    }
}
