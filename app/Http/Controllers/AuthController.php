<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request)
	{
		$user = User::where('email', $request->email)->first();
		
		if (!$user || Hash::check($request->password, $user->password)){
			return response()->json(['message' => 'Password tidak sesuai'], Response::HTTP_UNAUTHORIZED);
		}
		
		$token = $user->createToken('token-name')->plainTextToken;
		
		return response()->json([
			'message' => 'success',
			'user' => $user,
			'token' => $token
		], Response::HTTP_OK);
	}
}
