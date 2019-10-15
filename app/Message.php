<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
	 * 
	 * @return array
	 */
    public static function getByKey($key, $lang = null)
	{
		$lang = strtoupper(empty($lang) ? App::getLocale() : $lang);
		
		$return = self::where('key', $key)->select(['key', 'lang', 'msg_txt', 'context']);
		if ($lang !== 'ALL') {
			$return->where('lang', $lang);
		}
		return $return->orderBy('lang', 'asc')->get()->toArray();
	}
}
