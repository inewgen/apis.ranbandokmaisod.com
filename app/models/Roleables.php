<?php

class Roleables extends Eloquent
{

    public function scopeFilters($query, $filters = array())
    {
        if ($val = array_get($filters, 'roles_id')) {
            $query->where('roles_id', '=', $val);
        }

        if ($val = array_get($filters, 'roleable_id')) {
            $query->where('roleable_id', '=', $val);
        }

        if ($val = array_get($filters, 'roleable_type')) {
            $query->where('roleable_type', '=', $val);
        }

        return $query;
    }
}
