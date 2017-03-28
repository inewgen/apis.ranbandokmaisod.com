<?php

class Contacts extends Eloquent
{

    public function scopeFilters($query, $filters = array())
    {
        // Filter
        $fild_arr = array(
            'id', 'name', 'email', 'mobile', 'message', 'user_id', 'ip', 'url',
        );

        foreach ($fild_arr as $val2) {
            if ($val = array_get($filters, $val2)) {
                $query->where($val2, '=', $val);
            }
        }

        if (isset($filters['status'])) {
            $val = $filters['status'];
            if ($val != '') {
                $query->where('status', '=', $val);
            }
        }

        // Search
        $fild_search = array(
            'name', 'email', 'mobile', 'message',
        );

        if ($val = array_get($filters, 's')) {
            $i = 0;
            foreach ($fild_search as $val2) {
                if ($i == 0) {
                    $query->where($val2, 'LIKE', '%' . $val . '%');
                } else {
                    $query->orWhere($val2, 'LIKE', '%' . $val . '%');
                }
                $i++;
            }
        }

        return $query;
    }
}
