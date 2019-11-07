<?php

namespace App;
use App;
use DB;
use Illuminate\Database\Eloquent\Model;

class ConfScrIncludedVideos extends Model
{
	protected $table = 'conf_scr_included_videos';
    
	public static function get($key)
	{
		$return = self::where('video_id', $key)->first();
		return (!empty($return->file)) ? $return->file : $key;
	}                                                                         
	
}
