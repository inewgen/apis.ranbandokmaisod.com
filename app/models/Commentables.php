<?php

class Commentables extends Eloquent
{

    public function scopeFilters($query, $filters = array())
    {
        // Filter
		$fild_arr = array(
			'comments_id', 'commentable_id', 'commentable_type'
		);
		
		foreach ($fild_arr as $val2) {
			if ($val = array_get($filters, $val2)) {
				$query->where($val2, '=', $val);
			}
		}

		// Search
		$fild_search = array(
			'commentable_type'
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

    public function comments()
    {
        return $this->belongsTo('Comments');
    }

}
