<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SyTabTableDefinition extends Model
{
     public static function sytab()
    {
       $stab = new SyTabTableDefinition;
		$table = $stab->getTable();
		return $table;
    }
	
}
