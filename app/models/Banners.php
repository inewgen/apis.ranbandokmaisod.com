<?php

class Banners extends Eloquent
{
    public function images()
    {
        return $this->morphToMany('Images', 'imageable');
    }

    public function scopeFilters($query, $filters = array())
    {
        if ($val = array_get($filters, 'id')) {
            $query->where('id', '=', $val);
        }

        if ($val = array_get($filters, 'user_id')) {
            $query->where('user_id', '=', $val);
        }

        if ($val = array_get($filters, 's')) {
            $query->where('title', 'LIKE', '%'.$val.'%');
            $query->orWhere('subtitle', 'LIKE', '%'.$val.'%');
        }

        return $query;
    }
}