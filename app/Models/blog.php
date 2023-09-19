<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{

    use HasFactory;
    protected $primaryKey = 'blog_id';
    protected $fillable = [
        'blog_content',
        'blog_img_file_path',
        'blog_video_file_path',
        'blog_interface_img_file_path',
        'blog_title',
        'blog_valide',
        'u_id',
        
    ];
    public function user(){
        return $this->belongsTo(User::class, 'u_id');
    }
}
