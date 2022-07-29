<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Auth;

class AuthController extends Controller {

  public function login(Request  $request) {
  	$request->validate([
    	'email' => 'required|string|email',
      'password' => 'required|string',
      'remember_me' => 'boolean'
    ]);

    $credentials = $request->only('email', 'password');
    $jwt_token = null;

    if (!$jwt_token = JWTAuth::attempt($credentials)) {
      return  response()->json([
        'status' => 'invalid_credentials',
        'message' => 'Correo o contraseña no válidos.',
      ], 401);
    }

		$user = JWTAuth::user();

    return  response()->json([
			'token' => $jwt_token,
      'user' => $user,
      'permissions' => $user->permissions()
    ]);
  }

  public function logout() {
    JWTAuth::invalidate();

    return response()->json([
      'message' => 'Successfully logged out'
    ]);
  }

  public function refresh() {
    return response()->json([
      'access_token' => Auth::guard('api')->refresh()
    ]);
  }

  public function me() {
    return response()->json(
      JWTAuth::user()
    );
  }
}