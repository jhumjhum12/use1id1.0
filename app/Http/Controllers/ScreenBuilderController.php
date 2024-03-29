<?php

namespace App\Http\Controllers;

use App\Translate;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\ScreenBuilder\HTMLBuilder as HTMLBuilder;
use App\ScreenBuilder\Screen;
use App\ScreenBuilder\ScreenFields;
use App\ScreenBuilder\ScreenSegments;
use App\Label;
use App\User as User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;


class ScreenBuilderController extends Controller
{

    var $screenStructure = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('admin');
    }


    /**
     * SCREEN: GET
     * Get single screen for UPDATE (id!=0) or creates new model for INSERT
     * @param $id
     * @return mixed
     */

    public function getScreen($id)
    {
        $screen = ($id) ? Screen::where("id", $id)->firstOrFail() : new Screen();
        if(!isset($screen->id)) $screen->id = 0;

        $data = Screen::activeAndDrafts()->get();
        $this->buildTree($data, 0);

        return view('admin.screen-builder.screen')
            ->with('screen', $screen)
            ->with('availableStatuses', [
                Screen::SCREEN_DRAFT => 'Draft',
                Screen::SCREEN_ACTIVE => 'Active',
                Screen::SCREEN_DELETED => 'Deleted'])
            ->with('availableTemplates', ['render-full-screen'=>'render-full-screen', 'render'=>'render'])
            ->with('availableSegments', ScreenSegments::where('screen_id', $screen->id)->get())
            ->with('availableScreens', $this->screenStructure);
    }


    /**
     * SCREEN: POST
     * Will Update existing or Insert new screen
     * If new screen is inserted, one Screen Segment will be created as well
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function postScreen($id)
    {
        $buildSegment = false;
        if($id) {
            $screen = Screen::where("id", $id)->firstOrFail();
        } else {
            $screen = new Screen();
            $screen->id = uniqid();
            $buildSegment = true;
        }
        $screen->name = !empty(Input::get('name')) ? Input::get('name') : "[Untitled]";
        $screen->label = !empty(Input::get('label')) ? Input::get('label') : "";
        $screen->slug = Input::get('slug');
        $screen->template = !empty(Input::get('template')) ? Input::get('template') : "render-full-screen";
        if(!empty(Input::get('parent'))) {
            $screen->parent = Input::get('parent');
        };
        $screen->status = !empty(Input::get('status')) ? Input::get('status') : 1;

        $screen->help_label = !empty(Input::get('help_label')) ? Input::get('help_label') : null;
        $screen->help_video_url = !empty(Input::get('help_video_url')) ? Input::get('help_video_url') : null;
        $screen->help_html = !empty(Input::get('help_html')) ? Input::get('help_html') : null;

        $screen->save();
        if($buildSegment) {
            $screenSegment = new ScreenSegments();
            $screenSegment->id = uniqid();
            $screenSegment->name = "Untitled Segment";
            $screenSegment->screen_id = $screen->id;
            $screenSegment->save();
        }

        // in case Angular Screen Builder called this method as AJAX call
        if(isset($_GET['noredirect'])) exit();

        return redirect(route('builder.screens'));
    }

    /**
     * SCREEN SEGMENT: POST
     * Will CREATE or UPDATE existing screen segment
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function postScreenSegment($id)
    {		
        if($id) {
            $screenSegment = ScreenSegments::where("id", $id)->firstOrFail();
        } else {
            $screenSegment = new ScreenSegments();
            $screenSegment->id = uniqid();
            $screenSegment->screen_id = Input::get("screen_id");
        }

        $screenSegment->name = !empty(Input::get('name')) ? Input::get('name') : "";
        $screenSegment->model = !empty(Input::get('model')) ? Input::get('model') : "";
        $screenSegment->sort = !empty(Input::get('sort')) ? Input::get('sort') : 1;
        $screenSegment->status = !empty(Input::get('status')) ? Input::get('status') : 1;
        $screenSegment->action = !empty(Input::get('action')) ? $screenSegment->id . "::" . Input::get('action') : "";
        $screenSegment->render_type = !empty(Input::get('render_type')) ? Input::get('render_type') : "1";
        $screenSegment->sort = 1;

        $screenSegment->save();

        // in case Angular Screen Builder called this method as AJAX call
        if(isset($_GET['noredirect'])) exit();

        return redirect()->action(
            'ScreenBuilderController@getScreenFields', ['sid' => $screenSegment->id]
        );
    }


    /**
     * SCREEN FIELDS: GET
     * Will get fields for given Screen Segment or pick individual field from same
     * Screen Segment for editing
     * @param $sid
     * @param null $fid
     * @return mixed
     */

    public function getScreenFields($sid, $fid=null)
    {

        $availableModels = self::getModels();

        $mode = ($fid) ? "edit" : "insert";

        try {
            $screenSegment = ScreenSegments::where("id", $sid)->firstOrFail();
        } catch (ModelNotFoundException $ex) {
            exit("Screen Builder: No such Screen Segment.");
        }

        $dbFields = $screenSegment->getSegmentFields();
        $dbActions = $screenSegment->getSegmentActions();

        $screen = Screen::where("id", $screenSegment->screen_id)->firstOrFail();

        $fields = ScreenFields::where("screen_segment_id", $screenSegment->id)->orderBy('sort', 'asc')->get();

        if($fid) $editingField = ScreenFields::where('id', $fid)->firstOrFail();
        else $editingField = new ScreenFields();

        return view('admin.screen-builder.screen-builder')
            ->with('screen', $screen)
            ->with('screenSegment', $screenSegment)
            ->with('mode', $mode)
            ->with('availableModels', $availableModels)
            ->with('dbFields', $dbFields)
            ->with('dbActions', $dbActions)
            ->with('availableScreens', Screen::activeAndDrafts()->orderBy('slug')->pluck('slug', 'id')->prepend(null, null))
            ->with('editingField', $editingField)
            ->with('fields', $fields);
    }


    /**
     * SCREEN FIELD: POST
     * Will UPDATE or CREATE new field & pack it's meta data
     * This method is also used in Angular builder as AJAX call
     * We are using inputOverride to use custom dataset instead of POST variable
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function postScreenFields($segment_id, $inputOverride=[])
    {
        $input = Input::all();
        if(!empty($inputOverride)) {
            $input = $inputOverride;
        }
        $meta = [];
        $screenSegment = ScreenSegments::where("id", $segment_id)->firstOrFail();

        if(!empty($input['id'])) {
            $field = ScreenFields::where('id', $input['id'])->firstOrFail();
        } else {
            $field = new ScreenFields();
            $field->id = uniqid();
        }

        $field->screen_segment_id = $screenSegment->id;
        $field->type = !empty($input['type']) ? $input['type'] : "text";
        $field->label = !empty($input['label']) ? $input['label'] : "";
        $field->name = !empty($input['name']) ? $input['name'] : "";
        $field->action = !empty($input['action']) ? $input['action'] : "";
        foreach(ScreenFields::metaFields() as $m) {
            if(isset($input[$m])) $meta[$m] = $input[$m];
        }
        $field->meta = json_encode($meta);
        $field->sort = !empty($input['sort']) ? $input['sort'] : 1000000;
        $field->save();

        // in case Angular Screen Builder called this method as AJAX call
        if(!empty($inputOverride)) return true;
        if(isset($_GET['noredirect'])) exit();

        return redirect()->action(
            'ScreenBuilderController@getScreenFields', ['sid' => $screenSegment->id]
        );
    }



    /**
     *
     * BUILD TREE (PRIVATE)
     * Fills array (this->screenStructure) with nice structure that can be used for picking parent page
     * from select box.
     *
     * @param $elements
     * @param int $parentId
     * @param int $level
     * @return array
     */

    private function buildTree($elements, $parentId = 0, $level=0) {
        $branch = array();

        foreach ($elements as $element) {

            if(!isset($element->level)) $element->level=0;
            else $element->level = $level;

            if ($element->parent == $parentId) {
                $this->screenStructure[] = ["id"=> $element->id ,"name"=> str_repeat(" - ", $level) . $element->name ];
                $children = $this->buildTree($elements, $element->id, ($level+1));
                if ($children) {
                    $element->children = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }


    /**
     * GET AVAILABLE MODELS
     * Private static function that gets all available models
     * @return array
     */

    private static function getModels ()
	{
		$return = self::getFiles(app_path('Models'), 'App\\Models\\');
        $availableModels = [];
        $availableModels[] = [""];
        foreach ($return as $m) {
            if(!in_array($m, ["", ".", ".."])) {
                $className = $m;
                $test = new $className();
                if(!isset($test->hideModel)) {
                $availableModels[$m] = $m;
                }
            }
        }
        return $availableModels;
	}


    /**
     * GET AVAILABLE MODELS: HELPER FUNCTION
     * @param $dir
     * @param $prefix
     * @return array
     */
	
	private static function getFiles ($dir, $prefix)
	{
        $return = [null, 'App\User'];
		$files = scandir($dir);
		foreach($files as $f){
			if($f != '.' && $f != '..'){
				
				if(is_dir($dir.'/'.$f)) {
					$return = array_merge($return, self::getFiles($dir.'/'.$f, $prefix.$f .'\\'));
				} else {
					$return[] = $prefix.pathinfo($f, PATHINFO_FILENAME);
				}
			}
		}
		return $return;		
	}


    /**
     * ANGULAR VIEW ONLY
     */

    public static function getAngularView()
    {
        //$screen = Screen::where("id", $id)->firstOrFail();
        return view('admin.screen-builder.angular-builder');
        //    ->with('screen', $screen);
    }

    /**
     * PREPARE DATA FOR ANGULAR APP:
     * current screen data, and each segment with available data and actions
     */

    public function getAngularData($id)
    {		
        $output = [];
        $output['screen'] = Screen::where("id", $id)->firstOrFail()->toArray();
        $segments = ScreenSegments::where("screen_id", $id)->where("status", 1)->orderBy('sort', 'asc')->get();
        $output['segments'] = [];

        $data = Screen::activeAndDrafts()->get();
        $this->buildTree($data, 0);

        $output['allScreens'] = $this->screenStructure;
        $output['allModels'] = $this->getModels();
        $output['allSegments'] = [];
        $output['allStatuses'] = [
            Screen::SCREEN_DRAFT => 'Draft',
            Screen::SCREEN_ACTIVE => 'Active',
            Screen::SCREEN_DELETED => 'Deleted'];

        foreach($segments as $segment) {
            $segmentData = $segment->toArray();
            $parts = explode("::", $segmentData['action']);
            if(isset($parts[1])) $segmentData['action'] = $parts[1];
            $segmentData['fields'] = $segment->getSegmentFields(true);
            $segmentData['actions'] = $segment->getSegmentActions();
            $rows = ScreenFields::where("screen_segment_id", $segment->id)->orderBy('sort', 'asc')->get();
            $segmentData['selectedFields'] = [];
            foreach($rows as $row)
            {
                $row->unpackMeta();
                $segmentData['selectedFields'][] = $row->toArray();
            }

            $output['segments'][$segment->id] = $segmentData;
            $output['allSegments'][$segment->id] = $segment->name;
        }

        header('Content-Type: application/json');
        echo json_encode($output);
    }

    /**
     * PREPARE ANGULAR DATA IF NO SCREEN IS PROVIDED
     */

    public function getAngularDataPartial()
    {
        $output = [];

        $data = Screen::activeAndDrafts()->get();		
        $this->buildTree($data, 0);

        $output['allScreens'] = $this->screenStructure;
        $output['allModels'] = $this->getModels();

        header('Content-Type: application/json');
        echo json_encode($output);

    }


    /**
     * PREPARE ANGULAR TRANSLATION DATA
     */

    public function getAngularTranslationData()
    {
        $output = [];
        $output['labels'] = Translate::labelsPlainArray();
        header('Content-Type: application/json');
        echo json_encode($output);

    }


    /**
     * PARSING FIELD SET FROM ANGULAR
     * @param $segment_id
     */


    public function updateFields($segment_id)
    {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);
        ScreenFields::where("screen_segment_id", $segment_id)->delete();
        foreach($request as $field)
        {
            unset($field['id']);
            $this->postScreenFields($segment_id, $field);
        }
    }

    /**
     * MISC: Read all tables and all fields
     */

    public static function readAllTablesAndAllFields()
    {
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            foreach ($table as $key => $value) {
                echo "<b>" . $value . "</b><br>";
                $columns = Schema::getColumnListing($value);
                foreach($columns as $k => $column) {
                    echo $column . "<br>";
                }
            }
            echo "<br>";
        }

    }



}
