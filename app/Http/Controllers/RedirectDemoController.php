<?php

namespace App\Http\Controllers;
use Auth;
use App\Admin;

use Illuminate\Http\Request;

class RedirectDemoController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
	}
    public function index()
	{
            if(auth()->user()->role_id==1)
                return redirect()->route('admin.dashboard');
            
            if(auth()->user()->role_id==2)
                return redirect()->route('member.dashboard');
	}
}
