<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
	/**
	 * Get all available languages 
	 * Default language will be first in collection
	 * 
	 * @return Illuminate\Support\Collection
	 */
    public static function getAll()
	{
		return self::orderBy('lang_default', 'desc')
				->get()->pluck('lang_txt', 'lang')->toArray();
	}

    public static function getAllIds()
	{
		return self::orderBy('lang_default', 'desc')
				->get()->pluck('lang_txt', 'id')->toArray();
	}

    public static function getIdLang()
	{
		return self::orderBy('lang_default', 'desc')
				->get()->pluck('id', 'lang')->toArray();
	}

    public static function getLangId()
	{
		return self::orderBy('lang_default', 'desc')
				->get()->pluck('lang', 'id')->toArray();
	}
	
	
	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
