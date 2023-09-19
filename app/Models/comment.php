<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    protected $primaryKey ='comment_id';
    protected $fillable = [
    'video_id',	
    'u_id',	
    'comment_text',
    ];

    // public function shortVideo(){
    //     return $this->belongsTo(shortvideo::class, 'video_id');
    // }

    public function user(){
        return $this->belongsTo(User::class, 'u_id');
    }
}
