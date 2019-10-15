<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\SavedPassword;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class SavedPasswordController extends Controller
{
    public function index (Request $request)
	{
		$user = $request->user();
		$list = DB::table("saved_passwords")->where("user_id", $user->id)->get();
		$return = [
			"status" => "success", 
			"data" => [
				"sites" => $list
			]
		];
		return Response::json($return);
	}
	
	public function updateSite (Request $request) 
	{
		$user = $request->user();
		$input = Input::all();
		$id = (int) $input['id'];
		$return = ["status" => "success", "data" => [
			"id" => $id,
			"update" => []
		]];
		$new = new SavedPassword();
		$possible = array_keys($new->getFields());
		$update = [];
		if ($id) {
			foreach ($input as $key => $val) {
				if (in_array($key, $possible)) {
					$update[$key] = $val;
				}
			}
			$return["data"]["update"] = $update;
		}
		DB::table('saved_passwords')
            ->where('id', $input['id'])
            ->update($update);
		
		return Response::json($return);
	}
	
	public function createSite (Request $request) 
	{
		$user = $request->user();
		$input = Input::all();
		$return = ["status" => "success", "data" => [
			"create" => []
		]];
		
		$new = new SavedPassword();
		$possible = array_keys($new->getFields());
		$data = ["user_id" => $user->id];
		
		foreach ($input as $key => $val) {
			if (in_array($key, $possible)) {
				$data[$key] = $val;
			}
		}
		
		
		$data['id'] = DB::table('saved_passwords')
            ->insertGetId($data);
		
		$return["data"]["create"] = $data;
		return Response::json($return);
	}
}
