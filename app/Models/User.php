<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\notification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     
     public function getProfilePictureAttribute()
     {
         if ($this->attributes['u_profile_pic']) {
             return 'storage/' . $this->attributes['u_profile_pic'];
         }
 
         return null;
     }
    protected $fillable = [
        'name',
        'email',
        'password',
        'u_company_name',
        'u_desc',
        'u_location',
        'u_role',
        'u_resume_file_path',
        'u_gender',
        'u_phone_number',
        'u_state',
        'u_company_validate',
        'u_profile_pic',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
       
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class)
            ->withPivot('score', 'completed')
            ->withTimestamps();
    }

    public function completedQuizzes()
    {
        return $this->quizzes()->wherePivot('completed', true);
    }

    public function getTotalScoreAttribute()
    {
        return $this->completedQuizzes()->sum('pivot_score');
    }
}
