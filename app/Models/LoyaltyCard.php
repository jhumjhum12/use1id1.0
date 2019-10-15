<?php

namespace App\Models;

use Auth;
use Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\WorkerOptions;
use App\Http\Traits\ValidationTrait;

class LoyaltyCard extends Model
{
    use ValidationTrait;

//    protected $table = "UD_GEN_LOY_CARDS";  // DV0001
    protected $table = "loyalty_cards";   // DV0001
    protected $guarded = [ "user_id", "id"];
    public $timestamps = false;

    public function getFields()
    {
        return
            [
            ];
    }


}
