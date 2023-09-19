<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\jobpost;


class notification extends Model
{
    use HasFactory;
    protected $primaryKey = 'n_id';
    protected $fillable = [
        'n_content',
        'n_interview_time',
        'n_interview_date',
        'n_email',
        'n_resume_file_path',
        'n_profile_pic_file_path',
        'n_assessment_file_path',
        'u_id',
        'e_id',
        'jb_id',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'u_id');
    // }
    
    public function jobPost()
    {
        return $this->belongsTo(jobpost::class, 'jb_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'u_id', 'id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'e_id', 'id');
    }

    public function job()
    {
        return $this->belongsTo(jobpost::class, 'jb_id', 'jp_id');
    }
}
