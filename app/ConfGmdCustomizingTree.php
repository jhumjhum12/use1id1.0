<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfGmdCustomizingTree extends Model
{
	protected $table = 'conf_gmd_customizing_tree';
    public static function cus()
    {
       $cus = new ConfGmdCustomizingTree;
		$table = $cus->getTable();
		return $table;
    }
	                                                                                    
	public function childs() {
        return $this->hasMany('App\ConfGmdCustomizingTree','upper','config_group') ;
    }                                                                           
	
}
