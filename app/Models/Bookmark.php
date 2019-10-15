<?php

namespace App\Models;


use Auth;
use Input;
use DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\WorkerOptions;
use App\Http\Traits\ValidationTrait;

class Bookmark extends Model
{
	use ValidationTrait;

//    protected $table = "UD_TAG_REVIEW"; // DV0001
    protected $table = "bookmarks";  // DV0001

    protected $guarded = ["id", "user_id"];

    // protected $fillable = [ "user_id", "title", "url", "starred"];

    public $timestamps = false;

	public function tags()
	{
		return $this->belongsToMany('App\Models\Tag');
	}
	
    public function getFields()
    {
        return
            [
                'title'=> [ 'label'=>'title', 'validation'=>'required', 'type'=>'text'  ],
                'url'=> [ 'label'=>'url', 'validation'=>'required', 'type'=>'text'  ],
                'starred'=> [ 'label'=>'starred', 'validation'=>'', 'type'=>'text'  ],
                'tags[]'=> [ 'label'=>'tags', 'validation'=>'', 'type'=>'read-later-tags'  ],
            ];
    }


    public function afterSave($data, $originalData, $resource_id)
    {
        if(empty($originalData['tags']) || !is_array($originalData['tags'])) {
            return false;
        }

        $bookmark = self::where("id", $resource_id)->where("user_id", Auth::user()->id)->firstOrFail();

        // drop bookmark-tag relations for given document and reconstruct them from the scratch
   //     DB::table("UD_TAG_REVIEW")->where("bookmark_id", $bookmark->id)->delete(); // DV0001
        DB::table("bookmark_tag")->where("bookmark_id", $bookmark->id)->delete(); // DV0001

        foreach($originalData['tags'] as $tag) {
            if(!empty($tag)) {
                // get tag ID, create tag if tag doesn't exists
                $potentialTag = Tag::where("name", $tag)->where("user_id", Auth::user()->id)->first();
                if (!$potentialTag) {
                    $newTag = new Tag();
                    $newTag->user_id = Auth::user()->id;
                    $newTag->name = $tag;
                    $newTag->save();
                    $id = $newTag->id;
                } else {
                    $id = $potentialTag->id;
                }

                // create bookmark_tag relation
//                DB::table("bookmark_tag")->insert(    // DV0001            
                DB::table("bookmark_tag")->insert(   // DV0001
                    [
                        "bookmark_id" => $bookmark->id,
                        "tag_id" => $id
                    ]
                );
            }
        }

    }

    public static function render($class)
    {

        // try to get GET parameter for bookmarks
        $getParamterName = $class->getDBtable();
        $input = isset($_GET[$getParamterName]) ? $_GET[$getParamterName] : null;

        if($input) {

            $data = self::where("id", $input)->with('tags')->first();

            $view = View::make('html-controls.multiselect-autocomplete', [
                'data' => $data->tags,
                'autocomplete' => Tag::where("user_id", Auth::user()->id)->distinct('name')->orderBy('name')->get()
            ]);

            return $view->render();
        }

        return "";

    }



}
