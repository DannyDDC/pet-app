<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Http\Response as IlluminateResponse;

class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
      try {
        $user = JWTAuth::parseToken()->authenticate();
      } catch (Exception $e) {
        if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
          return response()->json(['error' => 'invalid_token'])->setStatusCode(IlluminateResponse::HTTP_UNAUTHORIZED);
        }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
          return response()->json(['error' => 'jwt expired'])->setStatusCode(IlluminateResponse::HTTP_UNAUTHORIZED);
        }else{
          return response()->json(['error' => 'Authorization Token not found']);
        }
      }
      return $next($request);
    }
}
