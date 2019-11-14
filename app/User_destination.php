<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_destination extends Model
{
    //
    public function destinationInfo()
    {
        return $this->hasOne(Destination::class,'id','destination');
    }
    public function originInfo()
    {
        return $this->hasOne(Destination::class,'id','origin');
    }
}
