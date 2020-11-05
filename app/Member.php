<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table='members';
    protected $fillable = [
        'name','image_name','image_type','image_size','email','password','role_id','mobile_no','status','team_id',
        'total_assigned_task','total_reviewed_task','address'
        
    ];

    public function teams()
    {
        return $this->belongsTo('App\Team', 'team_id');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task', 'member_id');
    }

    
}
