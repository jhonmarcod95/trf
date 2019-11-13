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
    public function bookReferences()
    {
        return $this->hasMany(BookReference::class,'request_id','id');
    }
    public function userInfo()
    {
        return $this->hasOne(User::class,'id','requestor_id');
    }
    public function companyInfo()
    {
        return $this->hasOne(Company::class,'id','company_name');
    }
    public function destinationInfo()
    {
        return $this->hasOne(Destination::class,'id','destination');
    }
}
