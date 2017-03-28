<?php

class Comments extends Eloquent {

	public function scopeFilters($query, $filters = array())
    {
		// Filter
		$fild_arr = array(
			'id', 'name', 'email', 'message', 'user_id', 'commentable_type', 'commentable_id', 'number', 'status', 'ip'
		);
		
		foreach ($fild_arr as $val2) {
			if ($val = array_get($filters, $val2)) {
				$query->where($val2, '=', $val);
			}
		}

		if ($val = array_get($filters, 'blockwords_type')) {
			$query->where('blockwords_type', 'LIKE', '%'.$val.'%');
		}

		// Search
		$fild_search = array(
			'name', 'email', 'message'
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

	public function commentables()
    {
        return $this->hasMany('Commentables');
    }
}