<?php

class Roles extends Eloquent
{

    public function scopeFilters($query, $filters = array())
    {
        if ($val = array_get($filters, 'id')) {
            $query->where('id', '=', $val);
        }

        return $query;
    }

    public function users()
    {
        return $this->morphedByMany('Users', 'roleable');
    }
}
