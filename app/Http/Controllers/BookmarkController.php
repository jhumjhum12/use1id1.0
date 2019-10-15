<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class BookmarkController extends Controller
{
	public function check(Request $request)
	{
		$user = $request->user();
		$input = Input::all();

		$return = [
			'status' => 'success',
			'data' => [
				'bookmark' => false
				]
			];

		if (!empty($input['url'])) {
			$bookmark = $user->bookmarks()->where('url', $input['url'])->first();
			$return['data']['bookmark'] = count($bookmark) ? $bookmark : false;
		}

		return Response::json($return);
	}

	public function add(Request $request)
	{
		$user = $request->user();
		$input = Input::all();

		$return = [
			'status' => 'success',
			'data' => [
				'bookmark' => false
				]
			];

		if (!empty($input['url'])) {
			$bm = new Bookmark;
			$bm->user_id = $user->id;
			$bm->url = $input['url'];
			$bm->title = empty($input['title']) ? '-' : $input['title'];
			$bm->starred = 0;
			$bm->save();

			$return['data']['bookmark'] = $bm;
		}

		return Response::json($return);
	}

	public function getTagsWithUrl(Request $request)
	{
		$user = $request->user();
		$tags = $user->tags->toArray();
		$return = [
			'status' => 'success',
			'data' => []
		];
		$input = Input::all();
		$tagged = [];
		if (!empty($input['url'])) {
			$bookmark = $user->bookmarks()->where('url', $input['url'])->first();
			if ($bookmark) {
				$tagged = $bookmark->tags;
			}
		}

		foreach ($tags as &$t) {
			$t['tagged'] = 0;
			foreach ($tagged as $bt) {
				if ($t['id'] == $bt->id) {
					$t['tagged'] = 1;
				}
			}
		}
		unset($t);
		$return['data'] = $tags;
		return Response::json($return);
	}

	public function delete()
	{
		$input = Input::all();

		$return = [
			'status' => 'success',
			'data' => [
				'deleted' => false
				]
			];

		if (!empty($input['bookmark_id'])) {
			Bookmark::destroy($input['bookmark_id']);
			DB::table('bookmark_tag')
				->where('bookmark_id', $input['bookmark_id'])
				->delete();
			$return['data']['deleted'] = true;
		}

		return Response::json($return);
	}

	public function tagBookmark(Request $request)
	{
		$user = $request->user();
		$return = ['status' => 'success', 'data' => ['saved' => false]];
		$input = Input::all();
		if (!empty($input['bookmark_id']) && !empty($input['tag_id'])) {
			$newID = DB::table('bookmark_tag')->insertGetId([
				'bookmark_id' => $input['bookmark_id'],
				'tag_id' => $input['tag_id']
			]);
			if ($newID) {
				$return['data']['saved'] = true;
			}
		}

		return Response::json($return);
	}

	public function untagBookmark(Request $request)
	{
		$user = $request->user();
		$return = ['status' => 'success', 'data' => ['saved' => false]];
		$input = Input::all();
		if (!empty($input['bookmark_id']) && !empty($input['tag_id'])) {
			DB::table('bookmark_tag')
				->where('bookmark_id', $input['bookmark_id'])
				->where('tag_id', $input['tag_id'])
				->delete();

			$return['data']['saved'] = true;
		}

		return Response::json($return);
	}

	public function addTag (Request $request)
	{
		$user = $request->user();
		$return = ['status' => 'success', 'data' => ['tag_id' => false]];
		$input = Input::all();
		if (!empty($input['new_tag'])) {
			$records = DB::table('tags')->where('user_id', $user->id)->where('name', $input['new_tag'])->get();
			if (!count($records)) {
				$tagID = DB::table('tags')->insertGetId([
					'user_id' => $user->id,
					'name' => $input['new_tag']
				]);
				$return['data']['tag_id'] = $tagID;
			}

		}

		return Response::json($return);
	}
}
