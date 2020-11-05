<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table='reviews';
    protected $fillable = [
        'task_name','member_id','task_id','review_assigned_member','review_assigned_date','review_assigned_time',
        'review_finished_time','time_taken','status','remarks','team_name',
        
    ];
}
