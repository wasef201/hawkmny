<?php

namespace App\Traits;

use App\Helpers\Localization;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait FilterScopeModelTrait
{
    public function scopeUse_search_or_where($query, $search_key, $columns)
    {

        //check if search key exist
        $search_key = trim($search_key);
        if (strlen($search_key) == 0 || count($columns)==0)
            return $query;

        $query->where(function($q)use($search_key,$columns){
            //foreach search column
            foreach ($columns as $key => $option) {
                $key=is_int($key)?$option:$key;
                $search_key=  "%$search_key%" ;
                if ($option['is_trans'] ?? false) {
                    if ($option['all_lang'] ?? false) {
                        $q->orWhere($key . '->ar', "like", $search_key)->orWhere($key . '->en', "like", $search_key);
                    } else {
                        $q->orWhere($key . '->'.Localization::getlocale(), "like", $search_key);
                    }
                } else{
                    $q->orWhere($key , "like", $search_key);
                }
            }
        });

        return $query;
    }

    // search with one relationship
    public function scopeUse_search_or_where_with_relation($query, $search_key ,$relation)
    {
        //check if search key exist
        $search_key = trim($search_key);
        $search_key=  "%$search_key%" ;
        if (strlen($search_key) == 0)
            return $query;
        $query->orWhere(function ($q1) use($relation, $search_key){
            $q1->whereHas($relation, function ($q) use ($search_key){
                $q->where('name'. '->'.Localization::getlocale(), "like", $search_key);
            });
        });
        return $query;
    }
    // search with one multiple relationship by name
    public function scopeUse_search_or_where_with_relations($query, $search_key ,$relations = [])
    {
        //check if search key exist
        $search_key = trim($search_key);
        $search_key=  "%$search_key%" ;
        if (strlen($search_key) == 0)
            return $query;
        foreach ($relations as $relation){
            $query->orWhere(function ($q1) use($relation, $search_key){
                $q1->whereHas($relation, function ($q) use ($search_key){
                    $q->where('name'. '->'.Localization::getlocale(), "like", $search_key);
                });
            });
        }
        return $query;
    }

    public function scopeWhere_country($q,$country_id)
    {
        return $q->whereCountryId($country_id??Auth::user()->country_id);
    }
}
