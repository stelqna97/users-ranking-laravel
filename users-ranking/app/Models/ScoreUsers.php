<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreUsers extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','score'
    ];



    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
