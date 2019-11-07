<?php

namespace App;
use App;
use DB;
use Illuminate\Database\Eloquent\Model;

class ConfLangInterfaceTexts extends Model
{
	protected $table = 'conf_lang_interface_texts';
    
	public static function get($key)
	{
		$return = self::where('text_id', $key)->first();
		return (!empty($return->long_text)) ? $return->long_text : $key;
	}                                                                         
	
}
