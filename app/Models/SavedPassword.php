<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ValidationTrait;

class SavedPassword extends Model
{
	use ValidationTrait;
	
	protected $guarded = ['password'];
//   protected $table = "UD_SOL_SP_SAVED_PASSWORDS"; // DV0001
    protected $table = "saved_passwords";  // DV0001


    public function getFields()
    {
        return
            [
                'url' => ['label'=>'url', 'validation'=>'required', 'type'=>'text' ],
                'name'=> [ 'label'=>'name', 'validation'=>'required', 'type'=>'text'  ],
				'username'=> [ 'label'=>'username', 'validation'=>'required', 'type'=>'text'  ],
				'password'=> [ 'label'=>'password', 'validation'=>'', 'type'=>'encrypted_password'  ],
				//'other_fields'=> [ 'label'=>'other_fields', 'validation'=>'', 'type'=>'text'  ], // TYPE JSON
                'notes'=> [ 'label'=>'notes', 'validation'=>'', 'type'=>'textarea'  ],
            ];
    }
}
