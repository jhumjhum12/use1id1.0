<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyUser extends Model
{

//    protected $table = "UD_CC_CID";  // DV0001
    protected $table = "company_user";  // DV0001


    public function company()
    {
        return $this->hasOne('App\Models\Company', 'id', 'company_id');
    }


}
