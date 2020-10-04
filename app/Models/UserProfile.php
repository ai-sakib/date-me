<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id', 'date_of_birth', 'gender','photo','latitude','longitude'
    ];

    public function user(){
    	return $this->hasOne('App\User', 'user_id', 'id');
    }

    public function like(){
    	return Like::where('from_user', Auth::id())->where('to_user',$this->id)->first();
    }
}
