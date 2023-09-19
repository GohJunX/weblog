<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thumbsup extends Model
{
    use HasFactory;
    protected $primaryKey ='thumbs_id';
    protected $fillable = [
    'short_id',	
    'u_id',	
    ];
     
    
    public function user(){
        return $this->belongsTo(User::class, 'u_id');
    }
}
