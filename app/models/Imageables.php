<?php

class Imageables extends Eloquent
{

    public function scopeFilters($query, $filters = array())
    {
        if ($val = array_get($filters, 'images_id')) {
            $query->where('images_id', '=', $val);
        }

        if ($val = array_get($filters, 'imageable_id')) {
            $query->where('imageable_id', '=', $val);
        }

        if ($val = array_get($filters, 'imageable_type')) {
            $query->where('imageable_type', '=', $val);
        }

        return $query;
    }

    public function images()
    {
        return $this->belongsTo('Images');
    }

}
