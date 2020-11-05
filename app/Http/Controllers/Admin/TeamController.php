<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Team;
use App\Member;
use Auth;
use App;

class TeamController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }
    
    public function index()
    {
        $user = Auth::user()->fname;
        $teams = Team::all()->toArray();
        return view('Admin.Team.index',compact('teams','user'))->with('no',1);
    }

    public function store(Request $request)
    {
        $status = 0;
        $teams = new Team;
        $teams->team_name = $request->team_name;
        $teams->status = 1;
        if($teams->save()) {
            $status = 1;
        }
        return response()->json([
            'status' => $status,
            'teams' => $teams->toArray(),
        ]);
    }

    public function edit($id)
    {
        $team = Team::where('id', $id)->first();
        return response([
            'team' => $team->toArray()
        ]);
    }

    public function update(Request $request)
    {
        $status = 0;
        $team = Team::find($request->id);
        $team->team_name = $request->team_name;

        if ($team->save()) {
          $status = 1;
        }

         return response([
            'status' => $status,
            'team' => $team->toArray()
        ]);
    }

    public function delete($id)
    {
        $status = 0;
        $team = Team::where('id', $id)->delete();
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

    public function view($id)
    {
        $status = 1;

        $member = Member::where('team_id','=',$id)->get();
    
        return response([
            'status' => $status,
            'member'=>$member
        ]);
    }
}
