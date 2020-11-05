<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table='tasks';
    protected $fillable = [
        'task_name','member_id','assigned_member','assigned_date','review_assigned_member','finished_date','time_taken','status',
        
    ];

    public function member_tasks()
    {
        return $this->belongsTo('App\Member', 'member_id');
    }
}
