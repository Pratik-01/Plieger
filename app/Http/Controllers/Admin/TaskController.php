<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Task;
use App\Member;
use App\Team;
use Auth;
use App;

class TaskController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }
    
    public function index()
    {
        $user = Auth::user()->fname;
        $members =Member::where('role_id',2)->get();

        
        $tasks = Task::where('status',1)->paginate(5);
      
        return view('Admin.Task.index',compact('tasks','members','user'))->with('no',1);
    }

    public function store(Request $request)
    {
        $status = 0;
        $tasks = new Task;
        $tasks->task_name = $request->task_name;
        $tasks->member_id = $request->member_id;
        $member_name = Member::where('id',$tasks->member_id)->first();
        $assigned_member = $member_name['name'];
        $team_id = $member_name['team_id'];
        $team_name = Team::where('id',$team_id)->first();
        $assigned_team = $team_name['team_name'];
        $tasks->team_name = $assigned_team;
        $tasks->assigned_member = $assigned_member;
        $tasks->assigned_date = $request->assigned_date;
        $tasks->status = 1;
        if($tasks->save()) {
            $status = 1;
        }
        return response()->json([
            'status' => $status,
            'tasks' => $tasks->toArray(),
        ]);
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
        $task->task_name = $request->task_name;
        $task->member_id = $request->member_id;
        $member_name = Member::where('id',$task->member_id)->first();
        $assigned_member = $member_name['name'];
        $task->assigned_member = $assigned_member;
        $task->assigned_date = $request->assigned_date;

        if ($task->save()) {
          $status = 1;
        }

         return response([
            'status' => $status,
            'task' => $task->toArray()
        ]);
    }

    public function delete($id)
    {
        $status = 0;
        $task = Task::where('id', $id)->delete();
        $status = 1;
    
        return response([
            'status' => $status
        ]);
    }

    public function getallmembers()
    {
        $status = 0 ;
        $member_names = Member::where('role_id',2)->get();
        $status = 1;
        return response([
            'status' => $status,
            'member_names' => $member_names
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

    //Search Task
    public function search(Request $request)
    {
            $status= 0;
            $query = $request->get('searchValue');
            $data = Task::where('task_name','like','%'.$query.'%')->orwhere('assigned_member','like','%'.$query.'%')->orwhere('team_name','like','%'.$query.'%')->orwhere('assigned_date','like','%'.$query.'%')->get();
            
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
