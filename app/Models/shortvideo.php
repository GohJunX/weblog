<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shortvideo extends Model
{
    use HasFactory;
    protected $primaryKey ='short_id';
    protected $fillable = [
    'short_file_path',	
    'short_comment',	
    'short_des',	
    'short_valide',	
    'u_id',
    'comment_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'u_id');
    }
    
    public function getProfilePictureAttribute()
    {
        if ($this->user) {
            return $this->user->profile_picture;
        }
        
        return null;
    }

    // public function comment()
    // {
    //     return $this->hasMany(comment::class, 'comment_id');
    // }

}
