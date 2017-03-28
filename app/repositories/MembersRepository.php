<?php

class MembersRepository implements MembersRepositoryInterface
{
    public function lists($input)
    {
        $filters    = isset($input['member_id']) ? $input['member_id'] : null;

        //required
        if (!isset($filters)) {
            return false;
        }

        $query = Members::filters($filters)
                    ->orderBy('member_id', 'desc');

        $results = $query->get();

        if (!isset($results) || !is_object($results)) {
            return false;
        }

        $result = json_decode($results, true);
        return $results;
    }
}
