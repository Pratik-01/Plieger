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

class ReviewPendingController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }
    
    public function index()
    {
        $user = Auth::user()->fname;
        $pendings = Task::where('status',2)->get();
        return view('Admin.ReviewPending.index',compact('pendings','user'))->with('no',1);
    }

    public function edit($id)
    {
        $pending = Task::where('id', $id)->first();
        return response([
            'pending' => $pending->toArray()
        ]);
    }

    public function update(Request $request)
    {
        $status = 0;
        $pending = Task::find($request->id);
        $pending->member_id = $request->member_id;
        $member_name = Member::where('id',$pending->member_id)->first();
        $assigned_member = $member_name['name'];
        $pending->review_assigned_member = $assigned_member;
        $pending->status = 3;

        if ($pending->save()) {
          $review = new Review;
          $review_info = Task::where('id',$request->id)->first();
          $review->task_name = $review_info->task_name;
          $review->member_id = $request->member_id;
          $review->task_id = $request->id;
          $review->team_name = $review_info->team_name;
          $review->review_assigned_member = $assigned_member;
          $review->review_assigned_date = Carbon::today();
          $review->review_assigned_time = Carbon::now()->addHours('5')->addMinutes('45');
          $review->status = 1;
          $review->save();
          $status = 1;
        }

         return response([
            'status' => $status,
            'pending' => $pending->toArray()
        ]);
    }

    public function finish($id)
    {
        $status = 0;
        $pending = Task::where('id', $id)->first();
        $pending->status = 4;
        $pending->update();
        $status = 1;
    
        return response([
            'status' => $status
        ]);
    }

    public function view($id)
    {
        $user = Auth::user()->fname;
        $taskview = Review::where('task_id',$id)->get();
        if($taskview){
            $taskview = $taskview->toArray();
        }
        return view('Admin.Review.detail',compact('taskview','user'))->with('no',1);
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
