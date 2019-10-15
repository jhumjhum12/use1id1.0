<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tag extends Model
{
    public $timestamps = false;

//    protected $table = 'UD_TAG_REVIEW';  // DV0001
    protected $table = 'tags';  // DV0001

    // hide this model from screen builder
    public $hideModel = true;



}
