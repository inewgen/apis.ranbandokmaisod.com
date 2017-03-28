<?php

class Images extends Eloquent
{

    public function scopeFilters($query, $filters = array())
    {
        if ($val = array_get($filters, 'id')) {
            $query->where('id', '=', $val);
        }

        if ($val = array_get($filters, 'user_id')) {
            $query->where('user_id', '=', $val);
        }

        if ($val = array_get($filters, 'code')) {
            $query->where('code', '=', $val);
        }

        if ($val = array_get($filters, 'name')) {
            $query->where('name', '=', $val);
        }

        if ($val = array_get($filters, 's')) {
            $query->where('name', 'LIKE', '%'.$val.'%');
            $query->orWhere('code', 'LIKE', '%'.$val.'%');
        }

        return $query;
    }

    public function products()
    {
        return $this->morphedByMany('Products', 'imageable');
    }

    public function news()
    {
        return $this->morphedByMany('News', 'imageable');
    }

    public function pages()
    {
        return $this->morphedByMany('Pages', 'imageable');
    }

    public function users()
    {
        return $this->morphedByMany('Users', 'imageable');
    }

    public function banners()
    {
        return $this->morphedByMany('Banners', 'imageable');
    }

    public function categories()
    {
        return $this->morphedByMany('Categories', 'imageable');
    }

    public function quotes()
    {
        return $this->morphedByMany('Quotes', 'imageable');
    }

    public function imageables()
    {
        return $this->hasMany('Imageables');
        $this->hasMany('Imageables', 'images_id', 'id');
    }
}
