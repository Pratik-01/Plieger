<?php

namespace App\Http\Controllers\TeamLeader;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Auth;
use App\Admin;
use App\Member;
use App\Task;
use App\Review;

class UserController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
	}

	public function index()
	{
		$user = Auth::user()->fname;
		$total_assigned_task = Task::all()->count();
		$remaining_task = Task::where('status',1)->count();
		$total_reviews = Review::all()->count();
		$total_uploaded = Task::where('status',5)->count();
		$issues_remaining = Task::where('status',6)->count();

		$chart_options = [
			'chart_title' => 'Task by months',
			'report_type' => 'group_by_date',
			'model' => 'App\Models\Task',
			'group_by_field' => 'created_at',
			'group_by_period' => 'week',
			'chart_type' => 'bar',
		];
		$chart1 = new LaravelChart($chart_options);
		return view('TeamLeader.index',compact('user','total_assigned_task','remaining_task','total_reviews','chart1',
		'issues_remaining','total_uploaded'));
	}
	public function detail()
    {
        $admin = Member::where('user_id',auth()->user()->id)->first();
		return view('TeamLeader.detail', compact('admin'));
	}
	public function update(Request $request)
	{
		$this->validate($request,[
            'name' => 'required',
            'mobile' => 'required|numeric|regex:/^(9)[0-9]{9}$/',
            'email' => 'required|email'
		]);
		$checkemail = Admin::where('email', $request->email)->first();
		if($checkemail){
			if($checkemail->id!=auth()->user()->id){
				$emailexists=1;
				return response()->json([
				'emailexists'=>$emailexists,
				]);
			}			
		}
		$checkemail = Member::where('email', $request->email)->first();
       	if($checkemail){
			if($checkemail->user_id!=auth()->user()->id){
				$emailexists=1;
				return response()->json([
				'emailexists'=>$emailexists,
				]);
			}	
		}
		$status = 0;
		$admin = Admin::find(auth()->user()->id);
		$admin->fname=$request->input('name');
		$admin->lname=$request->input('name');
		$admin->email=$request->input('email');
		
		
		if ($admin->save()) {
			$admin = Member::where('user_id',auth()->user()->id)->first();
			$admin->name=$request->input('name');
			$admin->email=$request->input('email');
			$admin->mobile_no=$request->input('mobile');
			if($admin->update()){
				$status=1;	
			}
			
		}
        return response([
            'status' => $status,
            'admin' => $admin->toArray()
        ]);
	}

	public function changepassrq()
    {
        return view('TeamLeader.changepass');
    }

	public function changepass(Request $request)
	{	
		//return $request->current_password;
		$this->validate($request,[
            'current_password' => 'required',
            'new_password' => 'required|min:6|regex:/^(?=.*[0-9]+.*)(?=.*[a-zA-Z]+.*)[0-9a-zA-Z]{6,}$/',
            'new_confirm_password' => 'same:new_password',
        ]);
		if (Hash::check($request->current_password,auth()->user()->password)) {
			Admin::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
			return redirect()->back()->with('message', 'Password Updated!');
		}
		else
			return redirect()->back()->withErrors("Current Password dosenot Match!!");
			return auth()->user()->password;
		//return admin::find(1)->toArray();
	}
}
