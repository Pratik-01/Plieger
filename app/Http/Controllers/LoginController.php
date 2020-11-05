<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
	public function login(Request $request)
	{
		if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

	        // Authentication passed...
			$user = User::where('email', $request->email)->first();
			// admin login
			if ($user->role_id === 1) {
		        return redirect()->route('home');
			}
	    } else {
			return redirect()->to('/error/404');
		}
	}
}
