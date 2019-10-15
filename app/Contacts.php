<?php

namespace App;

use App;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
	protected $fillable = ['user_1', 'user_2', 'status'];


    public static function getByKey($key, $lang = null)
	{
	}

	public function member()
	{
		if($this->user_1 == Auth::user()->id) {
			return $this->hasOne('App\User', 'id', 'user_2');
		}
		else {
			return $this->hasOne('App\User', 'id', 'user_1');
		}
	}

	public function scopeForUser($query, $id)
	{
		return $query->where(function($query) use ($id) {
			$query->where("user_1", $id)
				->orWhere("user_2", $id);
		});
	}

	public function scopeMutualConnection($query, $id)
	{
		return $query->where(function($query) use ($id) {
			$query->where("user_1", $id)
				->orWhere("user_2", $id);
		})->where(function($query) use ($id) {
			$query->where("user_1", Auth::user()->id)
				->orWhere("user_2", Auth::user()->id);
		});
	}

	public function getStatus() {

		if($this->status==1) return "Connected";
		if($this->status==0) {
			if($this->user_1 == Auth::user()->id) {
				return "Connection Pending";
			}
			if($this->user_2 == Auth::user()->id) {
				return "Connection Requested";
			}
		}
	}

	public function confirmationPending()
	{
		return ($this->user_2 == Auth::user()->id && $this->status==0) ? true : false;
	}

	public static function isPendingOrApproved($id)
	{
		$c1 = self::where("user_1", $id)->where("user_2", Auth::user()->id)->first();
		$c2 = self::where("user_2", $id)->where("user_1", Auth::user()->id)->first();
		return ($c1 || $c2) ? true : false;
	}

	public static function getContact($id)
	{
		if(!Auth::check()) return false;
 		$c1 = self::where("user_1", $id)->where("user_2", Auth::user()->id)->where("status",1)->first();
		if($c1) return $c1;
		$c2 = self::where("user_2", $id)->where("user_1", Auth::user()->id)->where("status",1)->first();
		if($c2) return $c2;
		return false;
	}

	public static function getContactWithStatus($id)
	{
		$c1 = self::where("user_1", $id)->where("user_2", Auth::user()->id)->first();
		if($c1) return $c1;
		$c2 = self::where("user_2", $id)->where("user_1", Auth::user()->id)->first();
		if($c2) return $c2;
		return false;
	}

	public static function isContact($id)
	{
		$c1 = self::where("user_1", $id)->where("user_2", Auth::user()->id)->where("status",1)->first();
		$c2 = self::where("user_2", $id)->where("user_1", Auth::user()->id)->where("status",1)->first();
		return ($c1 || $c2) ? true : false;
	}

	public static function sharingOptions()
	{
		return [
			1=>Label::get('work_experience'),
			2=>Label::get('companies'),
			3=>Label::get('projects'),
			4=>Label::get('references'),
			5=>Label::get('education'),
			6=>Label::get('spoken_languages'),
			7=>Label::get('contact_info'),
		];
	}

	public function getShare()
	{
		if($this->user_1 == Auth::user()->id)
		{
			$decode = json_decode($this->user_1_shares, true);
			return (is_array($decode)) ? $decode : [];
		}

		if($this->user_2 == Auth::user()->id)
		{
			$decode = json_decode($this->user_2_shares, true);
			return (is_array($decode)) ? $decode : [];
		}

		return false;
	}

	public function getShareInverted()
	{
		if($this->user_2 == Auth::user()->id)
		{
			$decode = json_decode($this->user_1_shares, true);
			return (is_array($decode)) ? $decode : [];
		}

		if($this->user_1 == Auth::user()->id)
		{
			$decode = json_decode($this->user_2_shares, true);
			return (is_array($decode)) ? $decode : [];
		}

		return false;
	}


}
