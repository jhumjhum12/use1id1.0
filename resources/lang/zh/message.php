<?php
//return ['000001'=>'Welcome in laravel','000002'=>'Documentation','000003'=>'News'];
$lang=DB::table('md0001')
		->where('language_key','zh')
		->where('is_active','1')
		->get();
	foreach($lang as $l){
		$returns[$l->text_id] = $l->text;
	}	
	
 return $returns;
?>