<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Task;
use App\Member;
use App\Review;
use Carbon\Carbon;
use Auth;
use App;

class IssueController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }

    public function index()
    {
        $user = Auth::user()->fname;
        $issues = Task::where('status',6)->get();
        return view('Admin.Review.issue',compact('issues','user'))->with('no',1);
    }

    public function issue($id)
    {
        $status = 0;
        $issue = Task::where('id', $id)->first();
        $issue->status = 1;
        $issue->issue_remark = "";
        $issue->update();
        $status = 1;
    
        return response([
            'status' => $status
        ]);
    }

    public function abort()
    {

        // Get the user from authentication
        $user = Auth::user();

        // Check if has not group throw forbidden
        if ($user->role_id != 1) 
        return App::abort(403);

    }
}
