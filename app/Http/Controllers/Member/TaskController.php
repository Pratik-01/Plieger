<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Task;
use App\Member;
use App\Team;
use Carbon\Carbon;
use App\Review;
use Auth;

class TaskController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }

    public function index()
    {
        $user = Auth::user()->fname;
        $tasks = Task::where('status',1)->where(function($query) use ($user){
            $query->where('assigned_member',$user);
        })->paginate(5);
        return view('Member.Task.index',compact('tasks','user'))->with('no',1);
    }

    public function edit($id)
    {
        $task = Task::where('id', $id)->first();
        return response([
            'task' => $task->toArray()
        ]);
    }

    public function update(Request $request)
    {
        $status = 0;
        $task = Task::find($request->id);
        $task->issue_remark = $request->issue_remark;
        $task->status = 6;
        if ($task->save()) {
          $status = 1;
        }

         return response([
            'status' => $status,
            'task' => $task->toArray()
        ]);
    }


    public function done($id)
    {
        $status = 0;
        $task = Task::where('id', $id)->first();
        $task->status = 2;
        $task->save();
        $status = 1;
    
        return response([
            'status' => $status
        ]);
    }

    public function review()
    {
        $user = Auth::user()->fname;
        $reviews = Task::where('status',3)->where(function($query) use ($user){
            $query->where('review_assigned_member',$user);
        })->get();
        return view('Member.Task.review',compact('reviews','user'))->with('no',1);
    }

    public function reviewed($id)
    {
        $status = 0;
        $task = Task::where('id', $id)->first();
        $task->status = 2;
        if($task->save()){
            $review = Review::where('task_id',$id)->first();
            $review->review_finished_time = Carbon::now()->addHours('5')->addMinutes('45');
            $t1 =  $review['review_assigned_time'];
            $t2 = $review['review_finished_time'];
            $time1=strtotime($t2);
            $time2=strtotime($t1);
            $total=( ($time1 - $time2)/60)/60;
            $review->total_time_taken = $total;
            $review->save();
        }
        $status = 1;
    
        return response([
            'status' => $status
        ]);
    }

    public function issueedit($id)
    {
        $review = Task::where('id', $id)->first();
        return response([
            'review' => $review->toArray()
        ]);
    }

    public function issueupdate(Request $request)
    {
        $status = 0;
        $review = Task::find($request->id);
        $review->issue_remark = $request->issue_remark;
        $review->status = 6;
        if ($review->save()) {
          $status = 1;
        }

         return response([
            'status' => $status,
            'review' => $review->toArray()
        ]);
    }

    //Search Task
    public function search(Request $request)
    {
            $status= 0;
            $query = $request->get('searchValue');
            $data = Task::where('team_name',)->where('task_name','like','%'.$query.'%')->orwhere('assigned_member','like','%'.$query.'%')->orwhere('assigned_date','like','%'.$query.'%')->get();
            
            $totalData = $data->count();
                
            if($totalData == 0)
            {   
                $status = 0;
                $datas = array(
                    'totalData' => $totalData,
                    'status' => $status
                );
                echo json_encode($datas);
                
            }else{
                $status = 1;
                $datas = array(
                    'tableData' => $data,
                    'totalData' => $totalData,
                    'status' => $status
                );
                echo json_encode($datas);
            }
           
        }


}
