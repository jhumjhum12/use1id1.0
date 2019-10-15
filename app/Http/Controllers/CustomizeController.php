<?php

namespace App\Http\Controllers;

use App;
use Route;
use App\ScreenBuilder\Screen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ConfGmdCustomizingTree;
use App\SyTabTableDefinition;
use App\Country;
use App\Language;
use Response;

use Maatwebsite\Excel\Facades\Excel;
use File;

class CustomizeController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
	
	public function index(){
		$slug = Route::currentRouteName();
		$screen = Screen::where("slug", $slug)->first();
        if(!$screen) {
            return [
                'result' => "",
                'error' => "No Such Page"
            ];
        }
		$layouts_id = Screen::where('parent',$screen->id)->get();
		$layouts = array();
		foreach($layouts_id as $lay){
			$data = DB::table('labels')->select('msg_txt')->where("lang", App::getLocale())->where('key',$lay->label)->orderBy("key")->first();
			$layouts[] = $data->msg_txt;
		}
			// echo '<pre>';print_r($layouts);
		
		// exit;
		return view('admin/customizer/customizetree',compact('layouts'));
		
	}
	
	function fetchdata(){
		$id=explode('_',$_POST['id']);
		$class=$_POST['dclass'];
		$select_class=explode(' ',$class);
		$table_id=$_POST['id'];
		
			$tree_data=DB::table('sy_tab_table_definitions')
				->where('id',$id[1])				
				->first();
				
				
				$table_data=DB::table(strtolower($tree_data->table))							
				->get();
				
				$table_column=DB::getSchemaBuilder()->getColumnListing(strtolower($tree_data->table));	
				$table_name=$tree_data->table;
				
		
		//echo '<pre>';print_r($table_column);exit;
		
		return view('admin/customizer/resultlist',compact('table_data','table_column','table_name','table_id'));
		
	}
	
	public function savecountry(){

         $input = $_POST;
		 //echo '<pre>';print_r($input);
		 $table_column=DB::getSchemaBuilder()->getColumnListing(strtolower($input['table_name']));	
		 $i=0;
		 $new_arr;
		
		 foreach($table_column as $column) 
			{
				
					if(($column!='id') && ($column!='created_at') && ($column!='updated_at'))	
					{							
						//$new_arr[$i]=$column.'=>'.$input['data_row'][$i];
						
						$new_arr[$column]=$input['data_row'][$i];
						//echo $column.'=>'.$input['data_row'][$i-1].',';
						
						$i++;	
					}	
					
			}
			
		
		 
		 DB::table(strtolower($input['table_name']))->where('id', $input['row_id'])->update($new_arr); 
		
		
	
    }

	public function showLayout($layout){
		$tree = ConfGmdCustomizingTree::where('upper', '=', '')->get();
       
		foreach($tree as $category){
			$category->tab1=ConfGmdCustomizingTree::cus();
			$category->child=$category->childs;
			
			if(count($category->childs) == '0') {
                $configGroup = $category->config_group;
				$tree2=DB::table('sy_tab_table_definitions')				
					->where('config_group',$configGroup)
					->orderBy('order','ASC')				
					->get();
					
					
					if(!empty($tree2)){
						$category->tab2=ConfGmdCustomizingTree::cus();
						$category->child1=$tree2;
						$category->tab3=SyTabTableDefinition::sytab();
					}
					
            } else {
				foreach($category->childs as $t1)
				{
					
					$tree2=DB::table('sy_tab_table_definitions')				
					->where('config_group',$t1->config_group)
					->orderBy('order','ASC')				
					->get();
					$category->tab2=ConfGmdCustomizingTree::cus();
					$t1->child1=$tree2;
					$t1->tab3=SyTabTableDefinition::sytab();
				}
			}
		}
		
		
		// $tree=DB::table('conf_gmd_customizing_tree')
		// ->where('upper','')
		// ->orderBy('order','ASC')
		// ->get();
		
		// $i=0;
		// $treelist=array();
		// foreach($tree as $t)
		// {
			
			// $tree1=DB::table('conf_gmd_customizing_tree')
			// ->where('upper',$t->config_group)
			// ->orderBy('order','ASC')
			// ->get();
			// $t->tab1=ConfGmdCustomizingTree::cus();
			// $t->child=$tree1;
			
			// foreach($tree1 as $t1)
			// {
				// $tree2=DB::table('sy_tab_table_definitions')				
				// ->where('config_group',$t1->config_group)
				// ->orderBy('order','ASC')				
				// ->get();
				// $t->tab2=ConfGmdCustomizingTree::cus();
				// $t1->child1=$tree2;
				// $t1->tab3=SyTabTableDefinition::sytab();
			// }
			
		// }
			
		return view('admin/customizer/layout',compact('tree','layout'));
	}
	
	function fetchLayoutData(){
		$id=explode('_',$_POST['id']);
		$class=$_POST['dclass'];
		$layout=$_POST['layout'];
		$select_class=explode(' ',$class);
		$table_id=$_POST['id'];
		if(count($select_class)>1)
		{
			$tree_data=ConfGmdCustomizingTree::where('id',$id[1])->first();
				
				$modal='<table class="table table-condensed" >
				<tr><td>Project</td><td><input type="text" value="'.$tree_data->project.'"/></td></tr>		
		<tr><td>Config Group</td><td><input type="text" value="'.$tree_data->config_group.'"/></td></tr>
		<tr><td>Description</td><td><textarea>'.$tree_data->description.'</textarea></td></tr>	
		<tr><td>Order</td><td><input type="text" value="'.$tree_data->order.'"/></td></tr>
		<tr><td>Upper</td><td><input type="text" value="'.$tree_data->upper.'"/></td></tr>
		<tr><td>Help Text</td><td><input type="text" value="'.$tree_data->text_id.'"/></td></tr>
		</table>';
		}
		else
		{
			$tree_data=SyTabTableDefinition::where('id',$id[1])->first();
				
				
				$table_data=DB::table(strtolower($tree_data->table))							
				->get();
				
				//$table_column=DB::getSchemaBuilder()->getColumnListing(strtolower($tree_data->table));
				$table_column=DB::table(strtolower('SY_TAB_TABLE_FIELDS'))->select('field')->where('table',$tree_data->table)->where('CUSTOMIZABLE','Yes')->get();
					
				$table_name=$tree_data->table;
				
		}
		//echo '<pre>';print_r($table_data);exit;
		
		return view('admin/customizer/layoutdata',compact('table_data','table_column','table_name','table_id','layout'));
		
	}

	public function saveLayoutData(){
		$input = $_POST;
		$column = $input['namearray'];
		//echo '<pre>';print_r($input);
		if(!empty($column)){
			
			$check=DB::table(strtolower($input['table_name']))
			//->where('is_active','1')
			->where(function($q) use ($column,$input){
				foreach($column as $k=>$c){
					$q->Where($c,'=',$input['valarray'][$k]);
				}
			})
			->count();
			//echo $input['tabId'];
			
			foreach($column as $k=>$c){
				$arr[$c]=$input['valarray'][$k];
			}
			if($input['tabId'] == 'new'){
				if($check == '0'){
					DB::table(strtolower($input['table_name']))->insert($arr);
				}
			} else {	
				if($check == '0'){
					DB::table(strtolower($input['table_name']))->where('id', $input['tabId'])->update($arr);
				}
			}
		}
	}
	
	
	public function deletecustomizedata(){
		$input = $_POST;
			$delete=DB::table(strtolower($input['table_name']))
			//->where('is_active','1')
			->where('id', $input['tabId'])
			->delete();
			
	}
	
	public function getaddlayout()
	{
		$input = $_POST;
		$table_name=$input['table_name'];
		$table_id=$input['table_id'];
		 //echo '<pre>';print_r($input);
		 $table_column=DB::getSchemaBuilder()->getColumnListing(strtolower($input['table_name']));	
		 return view('admin/customizer/modal',compact('table_column','table_name','table_id'));
	}
	
	public function addnewrow()
	{
		$input = $_POST;
		 //echo '<pre>';print_r($input);
		 $table_column=DB::getSchemaBuilder()->getColumnListing(strtolower($input['table_name']));	
		 $i=0;
		 $new_arr;
		
		 foreach($table_column as $column) 
			{
				
					if(($column!='id') && ($column!='created_at') && ($column!='updated_at'))	
					{							
						//$new_arr[$i]=$column.'=>'.$input['data_row'][$i];
						
						$new_arr[$column]=$input['data_row'][$i];
						//echo $column.'=>'.$input['data_row'][$i-1].',';
						
						$i++;	
					}	
					
			}
			
		
		 
		 DB::table(strtolower($input['table_name']))->insert($new_arr); 
	}
	
	
	
	public function importdata()
	{
		
		// For CSV
		$inputfile = \Input::file('image');
		$ext=$inputfile->extension();		
		$table_name = \Input::get('table_name');
		
		$input=$_POST;
		$file =$inputfile;
		$table_column=DB::getSchemaBuilder()->getColumnListing(strtolower($table_name));
		if(($ext=='txt') || ($ext=='csv'))
		{
			
			
			$customerArr = $this->csvToArray($file);
			//print_r($customerArr);
			for ($i = 0; $i < count($customerArr); $i ++)
			{
				//print_r($customerArr[$i]);
				DB::table(strtolower($table_name))->insert($customerArr[$i]); 
			}
			
			echo 'done';
		}
		
		else{
			//$path =public_path('demo.xls');
			$data = Excel::load($file)->get();
			
			////////////for excel/////////////
				$k=0;
				// echo $data->count();
				// die(0);
			if($data->count()){			
				foreach ($data as $value) {
					// if($k!=0)
					// {
						//echo '<pre>';print_r($value);exit;
						foreach($table_column as $column) {								
							 $column1=strtolower($column);
							if($column1 != 'id' && $column1 != 'is_active' && $column1 != 'created_at' && $column1 != 'updated_at'){
								//echo $column1;
								$arr1[$column1]=$value->$column1;								
							}	
						}	
															

							DB::table(strtolower($table_name))->insert($arr1);
					//}
					$k++;
				}
			}
			echo 'done';
		}		
		
	}
	
	
	
	function csvToArray($filename = '', $delimiter = ',')
	{
		if (!file_exists($filename) || !is_readable($filename))
			return false;

		$header = null;
		$data = array();
		if (($handle = fopen($filename, 'r')) !== false)
		{
			while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
			{
				foreach($row as &$field)
				{
					// Remove any invalid or hidden characters
					$field = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $field);
					
					// Escape characters for MySQL (single quotes, double quotes, linefeeds, etc.)
			   
				}
				if (!$header)
					
					$header = $row;
				else				
					$data[] = array_combine($header, $row);
						
			}
				fclose($handle);
		}

		return $data;
	}

	public function downloadCustomizeTables($type,$tableId){
		// echo storage_path();
		// die(0);
		$ids = explode(",",$tableId);
		$tables = DB::table('sy_tab_table_definitions')
					->select('table')
					->whereIn('id',$ids)
					->get();
		foreach($tables as $table){
		$tableName = strtolower($table->table);
		$acg = $this->exportTable($type,$tableName);
		}
		// $publicPath = storage_path() . '/exports/';
		// $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			// 'Content-Disposition: attachment;filename="table"'];
		// return response()->download($publicPath);
		
		 $files = glob(storage_path() . '/exports/');
		$zipper = new \Chumper\Zipper\Zipper;
        $flgFile = $zipper->make(public_path('CustomizeTable.zip'))->add($files)->close();
		File::deleteDirectory(storage_path() . '/exports');
		return response()->download(public_path('CustomizeTable.zip'))->deleteFileAfterSend(true);
		
	}
	
	function exportTable($type,$tableName){
		
		$items = DB::table($tableName)->get()->toArray();
		$items = array_map(function ($v) {
			return (array) $v ; // convert to array 
		}, $items);			
	
	    if($items){
			$key = $items[0];
			$newkey = array();
			foreach($key as $k=>$v){
				$newkey[] = $k;
			}
			array_unshift($items,$newkey);
		}
	
		return Excel::create($tableName, function($excel) use($items) {
			  $excel->sheet('ExportFile', function($sheet) use($items) {
				  $sheet->createSheetFromArray($items);
			  });
		})->store($type, false, true);
		  
	}
	
	public function getCustomizeTableInfo($id){
	    
	    $layout=$_REQUEST['layout'];
		$textId =	SyTabTableDefinition::select('table','text_id')->where('id', $id)->first();
		$data = DB::table('conf_lang_interface_texts')				
					->where('text_id',$textId->text_id)
					->first();
		$table_name = $textId->table;			
		return view('admin/customizer/tableinfo',compact('table_name','data','layout'));
	}
	
	public function getTextAreaPopUp(){
		$id = $_POST['id'];
		$val = $_POST['val'];
		return view('admin/customizer/textareapopup',compact('id','val'));
	}
	
	
	
	public function tablefieldentry()
	{
		$tables = DB::select('SHOW TABLES');
		foreach($tables as $table)
		{
			echo $table->Tables_in_use1id_com;
			echo "<br/>" ;
			//echo "Column:";
			$column=$this->getTableColumns($table->Tables_in_use1id_com);
			//print_r($column);
			
			$i=1;
			foreach($column as $col)
			{
				//echo $col;
				//echo "<br/>" ;
				if($table->Tables_in_use1id_com != 'sy_tab_table_fields_test')
				{
					$arr1;
					$arr1['project']='STANDARD';
					$arr1['table']=strtoupper($table->Tables_in_use1id_com);
					$arr1['field']=$col;
					$arr1['order']=$i;
					$arr1['key']=0;
					$arr1['check_table']='';
					$arr1['check_field']='';
					$arr1['dependency']='';
					
					
					DB::table(strtolower('SY_TAB_TABLE_FIELDS'))->insert($arr1);
					$i++;
				}
			}
			
		}
		return;
	}
	
	
	public function getTableColumns($table)
{
    return DB::getSchemaBuilder()->getColumnListing($table);

    // OR

    //return Schema::getColumnListing($table);

}
	
}
