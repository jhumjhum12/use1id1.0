<?php

namespace App\Models;

use Auth;
use Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\WorkerOptions;
use App\Http\Traits\ValidationTrait;

class BankAccountsCards extends Model
{

    use ValidationTrait;

//    protected $table = "UD_GEN_BANK_BANK_ACCOUNTS"; DV0001
    protected $table = "bank_accounts_cards"; // DV0001
    protected $guarded = ['id'];
    public $timestamps = false;


	public function getFields()
    {
        return
            [
				'card'=> ['label'=>'card', 'validation'=>'required', 'type'=>'text'],
            ];
    }

    public function read()
    {
		
        return [
            'data'=>BankAccountsCards::where("user_id", Auth::user()->id)->get(),
            'buttons'=>['edit']
        ];
		

    }

    public function getBankData()
    {
        $xml = @file_get_contents("https://binlist.net/json/" . $this->card);
        if($xml) {
            $data = \GuzzleHttp\json_decode($xml);
            if(isset($data->bank)) {
                return $data->brand . " (" . $data->bank . ", " . $data->country_name . ")";
            }
            else return "?";
        }
        else return "?";
    //    https://binlist.net/json/4929507964821833
    //    {"bin":"492950","brand":"VISA","sub_brand":"","country_code":"GB","country_name":"United Kingdom","bank":"BARCLAYS BANK PLC","card_type":"CREDIT","card_category":"","latitude":"54","longitude":"-2"}
    }


}
