<?php

class Quotes extends Eloquent {

	public function scopeFilters($query, $filters = array())
    {
		// Filter
		$fild_arr = array(
			'id', 'title', 'description', 'author', 'user_id', 'position', 'type', 'status'
		);
		
		foreach ($fild_arr as $val2) {
			if ($val = array_get($filters, $val2)) {
				$query->where($val2, '=', $val);
			}
		}

		// Search
		$fild_search = array(
			'title', 'description', 'author'
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

    /*public function news()
    {
        return $this->belongsTo('News');
    }*/
	public function news()
    {
        return $this->belongsTo('Images', 'imageable');
    }

    public function pages()
    {
        return $this->belongsTo('Images', 'imageable');
    }

    public function images()
    {
        return $this->morphToMany('Images', 'imageable');
    }
}