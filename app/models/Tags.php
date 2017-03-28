<?php

class Tags extends Eloquent
{

    public function news()
    {
        return $this->morphedByMany('News', 'tagable');
    }

    public function pages()
    {
        return $this->morphedByMany('Pages', 'tagable');
    }

    public function tagables()
    {
        return $this->hasMany('Tagables');
    }

    public function scopeFilters($query, $filters = array())
    {
        // Filter
        $fild_arr = array(
            'id', 'title', 'status'
        );
        
        foreach ($fild_arr as $val2) {
            if ($val = array_get($filters, $val2)) {
                $query->where($val2, '=', $val);
            }
        }

        // Search
        $fild_search = array(
            'title'
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
