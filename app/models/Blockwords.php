<?php

class Blockwords extends Eloquent {

	public function scopeFilters($query, $filters = array())
    {
		// Filter
		$fild_arr = array(
			'id', 'title', 'description', 'type', 'status'
		);
		
		foreach ($fild_arr as $val2) {
			if ($val = array_get($filters, $val2)) {
				$query->where($val2, '=', $val);
			}
		}

		// Search
		$fild_search = array(
			'title', 'description'
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
