<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_approver extends Model
{
    //
    public function approver()
    {
        return $this->hasOne(User::class,'id','approver_id');
    }
}
