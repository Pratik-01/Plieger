<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Member;
use App\Team;
use App\Admin;
use App\Task;
use App\Review;
use Carbon\Carbon;
use Image;
use Hash;
use Auth;
use App;

class MemberController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
    }
    
    public function index()
    {
        $user = Auth::user()->fname;
        $members = Member::paginate(10);
        $teams = Team::with('members')->get()->toArray();
        return view('Admin.Member.index',compact('members','teams','user'))->with('no',1);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'password' => 'required|min:6|regex:/^(?=.*[0-9]+.*)(?=.*[a-zA-Z]+.*)[0-9a-zA-Z]{6,}$/',
            'email' => 'required|email',
            'mobile_no'=>'numeric|regex:/^(9)[0-9]{9}$/'
        ]); 
        $status = 0;
       $checkemail = Member::where('email', $request->email)->first();
       if($checkemail){
           $emailexists=1;
           return response()->json([
                'emailexists'=>$emailexists,
            ]);
       }
       $checkemail = Admin::where('email', $request->email)->first();
       	if($checkemail){
           $emailexists=1;
           return response()->json([
                'emailexists'=>$emailexists,
            ]);
        }
        

      if(isset($request->image_dimension) && !empty($request->image_dimension)) {
            $image_dimension = json_decode($request->image_dimension);
      }
      $status = 0;
      $admins = new Admin;
      $admins->fname = $request->name;
      $admins->lname = $request->name;
      $admins->email = $request->email;
      $admins->password=Hash::make($request->password);
      $admins->role_id = $request->role_id;
      $admins->status = 1;

      if($admins->save()){
        $user_id = $admins->id;
        $members = new Member;
        $members->user_id = $user_id;
        $members->name = $request->name;
        $members->email = $request->email;
        $members->password=Hash::make($request->password);
        $members->team_id = $request->team_id;
        $members->role_id = $request->role_id;
        $members->address = $request->address;
        $members->mobile_no = $request->mobile_no;
        $members->status = 1;
        $members->image_name='no_image';
        $members->image_type='png';
  
        if ($request->hasFile('file')) {
  
          $imageName = $request->file('file')->getClientOriginalName();
          $imageName = preg_replace('/\s+/', ' ', $imageName);
          $imageNameUniqid = uniqid('');
          $imageName = $imageNameUniqid . '_' . $imageName;
          $imageSize = $request->file->getClientSize();
          $imageType = $request->file->getClientOriginalExtension();
          $members->image_name = $imageName;
          $members->image_type = $imageType;
          $members->image_size = $imageSize;
  
        }
        if ($members->save()) {
            if ($request->hasFile('file')) {
                $path = 'public/Members/';
                $image = Image::make($request->file);
                $image->crop(round($image_dimension->width), round($image_dimension->height), round($image_dimension->x), round($image_dimension->y));
                Storage::put($path . $members->id . '/' . $imageName, (string) $image->encode('jpg', 100));
                
            }
            $status = 1;
        }
  
            return response()->json([
            'status' => $status,
            'members' => $members->toArray(),
        ]);

      }
    }

    public function edit($id)
    {
        $member = Member::where('id', $id)->first();
        return response([
            'member' => $member->toArray()
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'mobile_no'=>'numeric|regex:/^(9)[0-9]{9}$/'
        ]);
        if(isset($request->image_dimension) && !empty($request->image_dimension)) {
            $image_dimension = json_decode($request->image_dimension);
        }
        $status = 0;
        $member = Member::find($request->id);
        $user_id = $member->user_id;
        $member->name = $request->name;
        $member->email = $request->email;
        $member->mobile_no = $request->mobile_no;
        $member->team_id = $request->team_id;
        $member->role_id = $request->role_id;
        $member->address = $request->address;

        if ($request->hasFile('file')) {
            if (isset($member->image_name) && !empty($member->image_name)) {
                Storage::delete('public/Members/'. $request->id . "/" . $member->image_name);
            }
            $imageName = $request->file->getClientOriginalName();
            $imageName = preg_replace('/\s+/', ' ', $imageName);
            $imageNameUniqid = uniqid('');
            $imageName = $imageNameUniqid . '_' . $imageName;
            $imageSize = $request->file->getClientSize();
            $imageType = $request->file->getClientOriginalExtension();
            $member->image_name = $imageName;
            $member->image_size = $imageSize;
            $member->image_type = $imageType;
        }
            if ($member->save()) {
                $admin = Admin::where('id',$user_id)->first();
                $admin->fname = $request->name;
                $admin->lname = $request->name;
                $admin->email = $request->email;
                $admin->role_id = $request->role_id;
                $admin->update();

                if ($request->hasFile('file')) {
                    $path = 'public/Members/';
                    $image = Image::make($request->file);

                    $image->crop(round($image_dimension->width), round($image_dimension->height), round($image_dimension->x), round($image_dimension->y));

                    // $image->fit(1600, 1200, function ($constraint) {
                    //     $constraint->aspectRatio();
                    // });
                    Storage::put($path . $member->id . '/' . $imageName, (string) $image->encode('jpg', 100));
            } else {
                if($member->image_name!='no_image'){
                    $existing_image_file = Storage::get('public/Members/' . $member->id . '/' . $member->image_name);
                    $existing_image = Image::make($existing_image_file);

                    $existing_image->crop(round($image_dimension->width), round($image_dimension->height), round($image_dimension->x), round($image_dimension->y));
                    Storage::put('public/Members/' . $member->id . '/' . $member->image_name, (string) $existing_image->encode('jpg', 100));
            
                }
            }
                    $status = 1;
            
            }
        return response([
            'status' => $status,
            'member' => $member->toArray()
        ]);
        }

    public function delete($id)
    {
        $status = 0;
        $del = Member::where('id',$id)->first();
        $user_id = $del->user_id;
        $member = Member::where('id', $id)->delete();
        $admin = Admin::where('id',$user_id)->delete();
        $status = 1;
        
        return response([
            'status' => $status
        ]);
    }

    public function getallteams()
    {
        $status = 0 ;
        $teamids = Team::all()->toArray();
        $status = 1;
        return response([
            'status' => $status,
            'teamids' => $teamids
        ]);
    }

    public function view($id)
    {
        $user = Auth::user()->fname;
        $member = Member::where('id',$id)->first();
        $team_id = $member->team_id;
        $name = $member->name;
        $teams = Team::where('id',$team_id)->first();
        $team_name = $teams->team_name;
        $task_assigned = Task::where('assigned_member',$name)->count();
        $total_review = Review::where('review_assigned_member',$name)->count();
        return view('Admin.Member.detail', compact('member','user','team_name','task_assigned','total_review'));
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
