<?php

namespace App;

use App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    /**
	 * 
	 * @return array
	 */
    public static function getByKey($key, $lang = null)
	{
		$lang = strtoupper(empty($lang) ? App::getLocale() : $lang);
		
		$return = self::where('key', $key)->select(['key', 'lang', 'msg_txt']);
		if ($lang !== 'ALL') {
			$return->where('lang', $lang);
		}
		return $return->orderBy('lang', 'asc')->get()->toArray();
	}

    /**
	 *
	 * @return string
	 */
    public static function get($key, $lang = null)
	{
		$lang = strtoupper(empty($lang) ? App::getLocale() : $lang);
		$return = self::where('key', $key)->where('lang', $lang)->first();
		return (!empty($return->msg_txt)) ? $return->msg_txt : $key;
	}

	public static function getCountry($code)
	{
		$lang = strtoupper(empty($lang) ? App::getLocale() : $lang);
// 		$row = DB::table('CONF_MD_COUNTRIES')->where("lang", $lang)->where("key", $code)->first(); // DV0001		
		$row = DB::table('countries')->where("lang", $lang)->where("key", $code)->first(); // DV0001
		return ($row) ? $row->msg_txt : $code;
	}

	public static function getURL($url="") {
		if (preg_match("#https?://#", $url) === 0) {
			$url = 'http://'.$url;
		}
		return $url;
	}


}
