<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecipeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(
            $request->input('title')
            && $request->input('description')
            && $request->input('instructions')
            && $request->input('ingredients')
            && $request->input('prep_time')
            && $request->input('cook_time')
            && $request->input('servings')
            && $request->input('calories')
        ) {
            return $next($request);
        }
        else {
            return abort(403,'Wrong arguments');
        }
    }
}
