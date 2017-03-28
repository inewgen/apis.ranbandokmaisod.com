<?php

class Navigations extends Eloquent
{
    protected $softDelete = true;
    /**
     * [boot description]
     * @return [type] [description]
     */
    public static function boot()
    {

    }

    /**
     * [scopeFilters description]
     * @param  [type] $query   [description]
     * @param  array  $filters [description]
     * @return [type] [description]
     */
    public function scopeFilters($query, $filters = array())
    {
        $filters_allow = ['id', 'user_id', 'status'];
        foreach ($filters_allow as $key) {
            if ($val = array_get($filters, $key)) {
                $query->where($key, '=', $val);
            }
        }

        return $query;
    }
}

//Members::observe(new MembersObserver());
