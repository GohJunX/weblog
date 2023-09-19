<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\notification;

class jobpost extends Model
{
    use HasFactory;
    protected $primaryKey = 'jp_id';
   
    protected $fillable = [
        'jp_des',
        'jp_pos',
        'jp_salary',
        'jp_exp_time',
        'jp_fulltime_parttime',
        'jp_role',
        'jp_location',
        'jp_img',
        'jp_video',
        'job_ver',
        
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($jobPost) {
            $jobPost->notifications()->delete();
        });
    }

    public function notifications()
    {
        return $this->hasMany(notification::class,'jb_id');
    }

    public function user()
{
    return $this->belongsTo(User::class, 'u_id');
}


}
