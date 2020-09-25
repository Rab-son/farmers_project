<?php

namespace App;

use Carbon\Carbon;
use Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;


use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
     public function getIsAdminAttribute(){

        return $this->roles()->where('id', 1)->exists();
    }

     public function roles(){

        return $this->belongsToMany(Role::class);
    }

}
