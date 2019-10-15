<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App;


class Translate extends Model
{

	public static function labelsPlainArray()
	{
//		$rows = DB::table('CONF_LANG_LABELS')->where("lang", "EN")->orderBy("key")->get(); // DV0001
		$rows = DB::table('labels')->where("lang", "EN")->orderBy("key")->get(); // DV0001
		foreach($rows as $row) {
			$output[] = $row->key;
		}
		return $output;
	}

	/**
	 * Using this one as angular data provider only (for label selector)
	 */

	// todo deprecated

	public static function screenDescriptionPlainArray()
	{
		return "?";
		/*
		$rows = DB::table('screen_descriptions')->where("lang", "EN")->orderBy("key")->get();
		$output = [];
		foreach($rows as $row) {
			$output[] = $row->key;
		}
		return $output;
		*/
	}

	// todo deprecated

	public static function screenDescription($key, $lang = null)
	{
		return "?";
		/*
		$lang = strtoupper(empty($lang) ? App::getLocale() : $lang);
		$temp = DB::table('screen_descriptions')->where("lang", $lang)->where("key", $key)->first();
		if(!$temp || $temp->msg_txt==null)
		{
			if($lang=="EN") return "(translation not available)";
			if($lang!="EN") return self::screenDescription($key, 'EN');
		}
		return $temp->msg_txt;
		*/
	}

	public static function countriesList($lang = null)
	{
		$lang = strtoupper(empty($lang) ? App::getLocale() : $lang);
//		$pluck = DB::table('CONF_MD_COUNTRIES')->where("lang", $lang)->orderBy("msg_txt")->pluck('msg_txt', 'key');	 // DV0001	
		$pluck = DB::table('countries')->where("lang", $lang)->orderBy("msg_txt")->pluck('msg_txt', 'key');  // DV0001
		if(sizeof($pluck)==0) {
//			$pluck = DB::table('CONF_MD_COUNTRIES')->where("lang", "EN")->orderBy("msg_txt")->pluck('msg_txt', 'key');  // DV0001
			$pluck = DB::table('countries')->where("lang", "EN")->orderBy("msg_txt")->pluck('msg_txt', 'key');  // DV0001
		}
		$pluck->prepend(null);
		return $pluck;
	}

}