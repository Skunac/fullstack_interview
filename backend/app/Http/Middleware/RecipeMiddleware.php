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
            $request->getContent('title')
            && $request->getContent('description')
            && $request->getContent('instructions')
            && $request->getContent('ingredients')
            && $request->getContent('prep_time')
            && $request->getContent('cook_time')
            && $request->getContent('servings')
            && $request->getContent('calories')
        ) {
            return $next($request);
        }
        else {
            return abort(403,'Wrong arguments');
        }
    }
}
