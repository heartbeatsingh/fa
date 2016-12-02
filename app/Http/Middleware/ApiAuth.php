<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Request;

class ApiAuth {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->isMethod('POST')) {
            $validateArr = Request::json()->all();
            if (!empty($validateArr['data'])) {
                extract($validateArr['data']);
                if (empty($userId) || empty($token)) {
                    return response()->json(['status' => 'failed', 'message' => 'user authentication failed.']);
                }
                $isExist = isAuthUser($userId, $token);
                if ($isExist) {
                    return $next($request);
                } else {
                    return response()->json(['status' => 'failed', 'message' => 'user authentication failed.']);
                }
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Data is empty.']);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Request method is not valid.']);
        }
    }

}
