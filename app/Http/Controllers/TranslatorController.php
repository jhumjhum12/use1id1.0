<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Language;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class TranslatorController extends Controller
{
	/**
	 *
	 * @var type
	 */
	private $translatorTables = [
		'labels' => 'Labels',
		'messages' => 'Messages'
	];

	/**
	 *
	 */
    public function __construct()
    {
        $this->middleware('admin');
    }

	/**
	 *
	 * @param Request $request
	 * @param type $key
	 * @return type
	 */
    public function show(Request $request, $key = null)
    {
		$languages = Language::getAll();
		$categories = $this->translatorTables;
		$rows = [];
		$cat = $lng = null;
		$mode = 'list';
		$input = $request->all();
		//echo '<pre>'; var_dump($languages);exit();
		// check if values from GET exist in DB
		if (!empty($input)) {
			$cat = !empty($input['cat']) && !empty($categories[$input['cat']])
				? $input['cat'] : null;
			$lng = !empty($input['lng']) && !empty($languages[$input['lng']])
				? $input['lng'] : 'EN';
		}

		if (!empty($key) && !empty($cat)) {
			// get data for single key
			$result = DB::table($input['cat'])->where('key', $key)->get();

			if (count($result)) {
				foreach ($result as $r) {
					if (!isset($rows[$r->key])) {
						$rows[$r->key] = [
							'_missing' => []
						];
					}

					$rows[$r->key][$r->lang] = [
						'id' => $r->id,
						'msg_txt' => $r->msg_txt
					];
				}
				$mode = 'edit';
			}


		}

		if (!empty($cat) && $mode == 'list') {
			// category selected
			$result = DB::table($input['cat'])->orderBy('key', 'asc')->get();

			foreach ($result as $r) {
				if (!isset($rows[$r->key])) {
					$rows[$r->key] = [
						'_missing' => []
					];
				}
				$rows[$r->key][$r->lang] = [
					'id' => $r->id,
					'msg_txt' => $r->msg_txt
				];
			}
		}

		foreach ($languages as $k => $v) {

			foreach ($rows as &$r) {
				if (empty($r[$k])) {
					// not translated to current lang.
					$r['_missing'][] = $k;
				}
			}
			unset($r);
		}

		// check if language folder is writable
		$ok = is_writable(base_path().'/resources/lang/');
		if (!$ok) {
			Session::flash('message', 'ERROR: Language folder not writable! Please do: "sudo chown -R www-data resources/lang" (LAMP)');
			Session::flash('alert-class', 'alert-danger');
		}
		//var_dump($languages);exit();
        return view('admin.translator.main')
            ->with('categories', $categories)
			->with('rows', $rows)
			->with('mode', $mode)
			->with('key', $key)
			->with('selectedCat', $cat)
			->with('selectedLng', $lng)
			->with('languages', $languages);
    }

	private static function compileLanguageFiles () {
		$languages = Language::getAll();
		// check if language folder is writable
		$ok = is_writable(base_path().'/resources/lang/');
		if (!$ok) {
			Session::flash('message', 'ERROR: Language folder not writable! Please do: "sudo chown -R www-data resources/lang" (LAMP)');
			Session::flash('alert-class', 'alert-danger');
		} else {
			foreach ($languages as $k => $v) {
				$f = strtolower($k);
				$path = base_path().'/resources/lang/' . $f;

				if (!file_exists($path)) {
					mkdir($path);
				}

				// get data
				$messages = DB::table('messages')
						->where('lang', $k)
						->where('context', 'laravel')
						->get();

				$langArray = [];
				foreach ($messages as $m) {
					if (!empty($m->msg_txt)) {
						self::assignArrayByPath($langArray, $m->key, $m->msg_txt);
					}

				}

				$langString = '<?php return ' . var_export($langArray, true) . ';';
				$langFile = $path . '/validation.php';

				// overwrite original file
				$fh = fopen($langFile, 'w');
				fwrite($fh, $langString);
				fclose($fh);
			}
		}
	}

	private static function assignArrayByPath(&$arr, $path, $value, $separator='.') {
		$keys = explode($separator, $path);

		foreach ($keys as $key) {
			$arr = &$arr[$key];
		}

		$arr = $value;
	}
	/**
	 *
	 * @param Request $request
	 * @return type
	 */
	public function addNew (Request $request)
	{
		$languages = Language::getAll();
		$categories = $this->translatorTables;
		$input = $request->all();
		$category = $lng = null;

		$key = $input['key'];
		$enTxt = $input['EN'];

		// check if values from input exist in DB
		if (!empty($input)) {
			$category = !empty($input['cat']) && !empty($categories[$input['cat']])
				? $input['cat'] : null;
			$lng = !empty($input['lng']) && !empty($languages[$input['lng']])
				? $input['lng'] : 'EN';
		}

		if (empty($key) || empty($category) || empty($enTxt)) {
			return redirect(route('translator'));
		}

		$result = DB::table($input['cat'])->where('key', $key)->get();
		if (count($result)) {
			// key exists
			return redirect(route('translator'));
		}

		$insert = [
					'key' => $key,
					'lang' => 'EN',
					'msg_txt' => $enTxt
				];

		// TODO: Set context
		if ($category == 'messages') {
			$insert['context'] = 'x';
		}
		DB::table($category)->insert($insert);

		if ($category == 'messages') {
			self::compileLanguageFiles();
		}

		return redirect(route('translator', [$key, "cat=$category&lng=$lng"]));
	}

	public function compile ()
	{
		self::compileLanguageFiles();
		Session::flash('message', 'Compiled');
		Session::flash('alert-class', 'alert-success');
		return redirect()->back();
	}

	/**
	 *
	 * @param Request $request
	 * @param type $key
	 * @return type
	 */
	public function update(Request $request, $key) {
		$input = $request->all();
		$category = $input['cat'];
		$lng = $input['lng'];
		if (empty($key) || empty($category)) {
			return redirect(route('translator'));
		}

		$result = DB::table($input['cat'])->where('key', $key)->get();
		if (!count($result)) {
			return redirect(route('translator'));
		}
		$laravel = false;
		if ($category == 'messages') {
			foreach ($result as $r) {
				if ($r->lang == 'EN' && $r->context == 'laravel') {
					$laravel = true;
				}
			}
		}

		$languages = Language::getAll();
		foreach ($languages as $k => $v) {
			if (!empty($input["$k:id"]) && !empty($input[$k])) {
				// translation exists - update
				DB::table($category)
					->where('id', $input["$k:id"])
					->where('lang', $k)
					->update(['msg_txt' => $input[$k]]);
			} elseif (!empty($input[$k])) {
				// new record
				$insert = [
						'key' => $key,
						'lang' => $k,
						'msg_txt' => $input[$k]
				];
				if ($category == 'messages') {
					$insert['context'] = $laravel ? 'laravel' : 'x';
				}
				DB::table($category)->insert($insert);
			}
		}
		if ($category == 'messages') {
			self::compileLanguageFiles();
		}
		return redirect(route('translator', [null, "cat=$category&lng=$lng"]));
	}

	public function ajaxUpdate(Request $request) {
		$input = $request->all();
		$return = ["status" => "success", "data" => ["new_id" => false]];

		if (!empty($input["key"]) && !empty($input["cat"]) && !empty($input["cat"])) {
			$category = $input['cat'];
			$key = $input['key'];
			$lng = $input['lng'];

			$result = DB::table($category)->where('key', $key)->get();
			if (count($result)) {
				$laravel = false;
				if ($category == 'messages') {
					foreach ($result as $r) {
						if ($r->lang == 'EN' && $r->context == 'laravel') {
							$laravel = true;
						}
					}
				}

				if (!empty($input["id"]) && !empty($input["text"])) {
					// translation exists - update
					$record = DB::table($category)
						->where('id', $input["id"])
						->where('lang', $lng)
						->update(['msg_txt' => $input["text"]]);
					$return["data"]["new_id"] = $input['id'];
				} else if (!empty($input['text'])) {
					// new record
					$insert = [
							'key' => $key,
							'lang' => $lng,
							'msg_txt' => $input["text"]
					];
					if ($category == 'messages') {
						$insert['context'] = $laravel ? 'laravel' : 'x';
					}
					$newID = DB::table($category)->insertGetId($insert);
					$return["data"]["new_id"] = $newID;
				}
				if ($category == 'messages') {
					self::compileLanguageFiles();
				}
			} // end if count(result)

		}	// end if not empty
		//return Response::json($return);
		return Response::json($return);
	}

	public function translateFromYandex($forLang)
	{

		$yandex_api_key = "trnsl.1.1.20161013T110602Z.5f55bba57bd745ac.b70978811cb21bcfe5b3af6ee8c5d8e0747fb087";

		$labels = DB::table('labels')->where('lang', 'EN')->get();
		$langs_available = [];
		$langs_available[] = $forLang;

		$i = 1;

		foreach($labels as $label) {

			foreach($langs_available as $l) {

				echo $i++ . " lang=" . $l . ", key=" . $label->key . " ";

				$currentTranslation = DB::table('labels')->where('lang', $l)->where('key', $label->key)->first();

				if(!$currentTranslation) {
					$uri = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=" .  $yandex_api_key . "&text=" . urlencode($label->msg_txt) . "&lang=" . strtoupper($l);
					$translation = file_get_contents( $uri );
					$json = json_decode($translation);

					DB::table('labels')->insert(
						[
							'key'=>$label->key,
							'lang'=>strtoupper($l),
							'msg_txt'=>$json->text[0],
						]
					);

					echo "; <strong>trasnslated=" . $json->text[0] . " </strong></br>";

				} else {

					echo "; translation exists (" . $currentTranslation->msg_txt . ") <br>";

				}

			}


		}

		exit("done");

	}

}
