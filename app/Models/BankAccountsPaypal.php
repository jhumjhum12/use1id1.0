<?php

namespace App\Models;

use Auth;
use Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\WorkerOptions;
use App\Http\Traits\ValidationTrait;

class BankAccountsPaypal extends Model
{

    use ValidationTrait;
//  protected $table = "UD_GEN_BANK_BANK_ACCOUNTS_PAYPAL  // DV0001
    protected $table = "bank_accounts_paypal";  // DV0001
    public $timestamps = false;


    public function getFields()
    {
        return
            [
				'user_email'=> ['label'=>'user_email', 'validation'=>'required', 'type'=>'email'],
            ];
    }

}
