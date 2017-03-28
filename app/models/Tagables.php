<?php

class Tagables extends Eloquent
{
    public function tags()
    {
        return $this->belongsTo('Tags');
    }

    public function news()
    {
        return $this->hasOne('News', 'id', 'tagable_id');
    }

    public function pages()
    {
        return $this->hasOne('Pages', 'id', 'tagable_id');
    }

    public function scopeFilters($query, $filters = array())
    {
        // Filter
        $fild_arr = array(
            'tags_id', 'tagable_id', 'tagable_type'
        );
        
        foreach ($fild_arr as $val2) {
            if ($val = array_get($filters, $val2)) {
                $query->where($val2, '=', $val);
            }
        }

        // Search
        $fild_search = array(
            'tags_id', 'tagable_id', 'tagable_type'
        );
        
        if ($val = array_get($filters, 's')) {
            $i = 0;
            foreach ($fild_search as $val2) {
                if ($i == 0) {
                    $query->where($val2, 'LIKE', '%'.$val.'%');
                } else {
                    $query->orWhere($val2, 'LIKE', '%'.$val.'%');
                }
                $i++;
            }
        }

        return $query;
    }
}
