<?php

namespace App\Http\Middleware;

use Closure;

class PermissionMiddleware {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {

<<<<<<< HEAD
		/*$routeName = $request->route()->getName();

			if (!$request->user()->can($routeName)) {
				if ($request->ajax()) {
					return response('Access denied!', 401);
				}
				abort(401);
			}

			//check for user force logout
			if ($request->user()->force_logout) {
				$request->user()->force_logout = 0;
				$request->user()->save();

				Auth::logout();
				return redirect()->route('login');
		*/
=======
		// $routeName = $request->route()->getName();

		// if (!$request->user()->can($routeName)) {
		// 	if ($request->ajax()) {
		// 		return response('Access denied!', 401);
		// 	}
		// 	abort(401);
		// }

		// //check for user force logout
		// if ($request->user()->force_logout) {
		// 	$request->user()->force_logout = 0;
		// 	$request->user()->save();

		// 	Auth::logout();
		// 	return redirect()->route('login');
		// }
>>>>>>> 585102386da25384cabb6412762da2b634d83c3b
		return $next($request);
	}
}
