<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class AdminLoginController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest:admin')->except('logout');
	}

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
    	// validate the form data.
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:6'
    	]);

    	// attempt to login in user.
    	if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 1], $request->remember)) {

    		return redirect()->intended(route('admin.dashboard'));
    	}else if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 2], $request->remember)){
            return redirect()->intended(route('member.dashboard'));
        }else if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 3], $request->remember)){
            return redirect()->intended(route('teamleader.dashboard'));
        }

    	return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        // $request->session()->flush();

        // $request->session()->regenerate();
        
        return redirect()->route('admin.login');
    }
}
