<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_request extends Model
{
    //

    public function approverInfo()
    {
        return $this->hasOne(User_approver::class,'user_id','requestor_id');
    }
}
