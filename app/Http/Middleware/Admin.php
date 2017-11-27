<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
	    if ( Auth::check() && Auth::user()->isAdmin() )
	    {
		    return $next($request);
	    }

//	    return redirect('/');
//	    abort(403, 'The resource you are looking for could not be found');
		throw new NotFoundHttpException('asd');
    }
}
