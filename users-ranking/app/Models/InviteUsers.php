<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InviteUsers extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','user_email','user_invite_email','score'
    ];



    public function users(){
        return $this->belongsToMany(User::class, 'user_id');
    }

}
