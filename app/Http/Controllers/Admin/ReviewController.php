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

class ReviewController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }

    public function index()
    {
        $user = Auth::user()->fname;
        $reviews = Task::where('status',3)->get();
        return view('Admin.Review.index',compact('reviews','user'))->with('no',1);
    }

    public function finish()
    {
        $user = Auth::user()->fname;
        $finishs = Task::where('status',4)->get();
        return view('Admin.Review.finish',compact('finishs','user'))->with('no',1);
    }

    public function edit($id)
    {
        $finish = Task::where('id', $id)->first();
        return response([
            'finish' => $finish->toArray()
        ]);
    }

    public function update(Request $request)
    {
        $status = 0;
        $finish = Task::find($request->id);
        $finish->member_id = $request->member_id;
        $member_name = Member::where('id',$finish->member_id)->first();
        $assigned_member = $member_name['name'];
        $finish->review_assigned_member = $assigned_member;
        $finish->status = 3;

        if ($finish->save()) {
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
            'finish' => $finish->toArray()
        ]);
    }

    public function upload($id)
    {
        $status = 0;
        $finish = Task::where('id', $id)->first();
        $finish->status = 5;
        $finish->finished_date = Carbon::today();
        $finish->update();
        $status = 1;
    
        return response([
            'status' => $status
        ]);
    }

    public function uploadtask()
    {
        $user = Auth::user()->fname;
        $uploads = Task::where('status',5)->get();
        return view('Admin.Review.upload',compact('uploads','user'))->with('no',1);
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
