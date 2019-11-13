<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookReference extends Model
{
    //
    public function issueByInfo()
    {
        return $this->hasOne(User::class,'id','encoded_by');
    }
    public function travelInfo()
    {
        return $this->hasOne(User_request::class,'id','request_id');
    }
}
