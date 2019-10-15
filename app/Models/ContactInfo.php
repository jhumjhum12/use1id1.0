<?php

namespace App\Models;

use Auth;
use Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\WorkerOptions;
use App\Http\Traits\ValidationTrait;
use View;

class ContactInfo extends Model
{

    use ValidationTrait;

//    protected $table = "UD_GEN_CON_CONTACT_INFO"; // DV0001
    protected $table = "contact_info";  // DV0001
	
	public function getFields()
    {
        return
            [
                'type'=> [ 'label'=>'type', 'validation'=>'required', 'type'=>'text'  ],
                'content'=> [ 'label'=>'content', 'validation'=>'required', 'type'=>'text'  ],
                'contacts[]'=> [ 'label'=>'contacts', 'validation'=>'', 'type'=>'contact-list'  ],

            ];
            
            
// start of insertion DV0001
// Attempt insert query execution
// $sql = "INSERT INTO UD_LOG_CODE_SCAN (created_at, id, path) VALUES (now() , 1 , 'http://use1id.com/prototype1.0/app/Models/ContactInfo.php FUNCTION getFields')";
// if(mysqli_query($link, $sql)){
//     echo "Records inserted successfully.";
// } else{
//     echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
//}
// end of insertion DV0001
    }


    public static function render($class)
    {

            $data = self::where("user_id", Auth::user()->id)->get();
            $view = View::make('html-controls.contact-info', [
                'contactOptions' => self::optionsProvider(),
                'data' => $data
            ]);
            return $view->render();

    }



    public static function optionsProvider()
    {
// DV0001 Hard-coded. Should be in a table         
        return [
            '0'=>null,
            '1'=>'Mobile Home',
            '2'=>'Home Phone',
            '3'=>'E-Mail'
        ];
// start of insertion DV0001
// Attempt insert query execution
//$sql = "INSERT INTO UD_LOG_CODE_SCAN (created_at, id, path) VALUES (now() , user_id , 'http://use1id.com/prototype1.0/app/Models/ContactInfo.php FUNCTION optionsProvider')";
//if(mysqli_query($link, $sql)){
//    echo "Records inserted successfully.";
//} else{
//    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
//}
// end of insertion DV0001
    }


}
