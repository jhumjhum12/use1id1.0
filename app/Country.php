<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	// DB table
//	protected $table = 'CONF_MD_COUNTRIES';	// DV0001
	protected $table = 'conf_gmd_country_table'; // DV0001
	 protected $fillable = [
        'country', 'A2_ISO','Dialing_code'
    ];
	/**
	 * 
	 * @return array
	 */
    public static function getByTwo($key)
	{
		$languages = \App\Language::getAll();
		
		$return = [];
		$result = self::where('Two', strtoupper($key))->get()->toArray()[0];
		
		if (count($result)) {
			$return['two'] = strtoupper($key);
			$return['three'] = $result['Three'];
			$return['EN'] = $result['Full'];
			foreach ($result as $col => $val) {
				$found = false;
				foreach ($languages as $k=>$v) {
					if ($col === 'Full_' . strtolower($k)) {
						$found = true;
						break;
					}
				}
				
				if ($found) {
					$return[$k] = $val;
				}
			}			
		}		
		return $return;
	}
	
	/**
	 * 
	 * @return array
	 */
    public static function getByThree($key)
	{
		$languages = \App\Language::getAll();
		
		$return = [];
		$result = self::where('Three', strtoupper($key))->get()->toArray()[0];
		
		if (count($result)) {
			$return['two'] = $result['Two'];
			$return['three'] = $result['Three'];
			$return['EN'] = $result['Full'];
			foreach ($result as $col => $val) {
				$found = false;
				foreach ($languages as $k=>$v) {
					if ($col === 'Full_' . strtolower($k)) {
						$found = true;
						break;
					}
				}
				
				if ($found) {
					$return[$k] = $val;
				}
			}			
		}		
		return $return;
	}
	
	
	////return column/////////
	
	public function getTableColumns() {
	   
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
