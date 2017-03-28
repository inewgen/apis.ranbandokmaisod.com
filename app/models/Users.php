<?php

class Users extends Eloquent
{
    public function scopeFilters($query, $filters = array())
    {
        if ($val = array_get($filters, 'id')) {
            $query->where('id', '=', $val);
        }

        if ($val = array_get($filters, 'email')) {
            $query->where('email', '=', $val);
        }

        if ($val = array_get($filters, 'password')) {
            $query->where('password', '=', $val);
        }

        if ($val = array_get($filters, 'active')) {
            $query->where('active', '=', $val);
        }

        if (isset($filters['status'])) {
            $val = $filters['status'];
            $query->where('status', '=', $val);
        }

        if ($val = array_get($filters, 's')) {
            $query->where('name', 'LIKE', '%'.$val.'%');
            $query->orWhere('email', 'LIKE', '%'.$val.'%');
        }

        return $query;
    }

    public function images()
    {
        return $this->morphToMany('Images', 'imageable');
    }

    public function roles()
    {
        return $this->morphToMany('Roles', 'roleable');
    }
}
