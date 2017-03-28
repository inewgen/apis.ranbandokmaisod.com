<?php

class BannersRepository implements BannersRepositoryInterface
{
    public function lists($parameters)
    {
        $filters = isset($parameters['filters']) ? $parameters['filters'] : null;
        $skip = isset($parameters['skip']) ? $parameters['skip'] : null;
        $take = isset($parameters['take']) ? $parameters['take'] : null;
        $order = isset($parameters['order']) ? $parameters['order'] : 'position';
        $sort = isset($parameters['sort']) ? $parameters['sort'] : 'asc';

        //required
        if (!isset($filters) || !isset($skip) || !isset($take)) {
            return false;
        }

        $query = Banners::filters($filters)
            ->orderBy($order, $sort);

        $results[] = (int) $query->count();
        $results[] = $query->skip($skip)->take($take)->get();

        if (!isset($results[1]) || !is_object($results[1])) {
            return false;
        }

        $results[1] = json_decode($results[1], true);

        return $results;
    }

    public function find($parameters)
    {
        $id = isset($parameters['id']) ? $parameters['id'] : null;

        //required
        if (!isset($id)) {
            return false;
        }

        $results = Banners::find($id);

        if (!isset($results) || !is_object($results)) {
            return false;
        }

        $results = json_decode($results, true);

        return $results;
    }

    public function create($parameters)
    {
        //required
        if (!isset($parameters)) {
            return false;
        }

        // [1] Insert
        $query = false;
        if (isset($parameters) && is_array($parameters) && (count($parameters) > 0)) {
            $query = new Banners();
            foreach ($parameters as $key => $value) {
                $query->$key = $value;
            }
            $query->save();
        }

        if (!isset($query) || !is_object($query)) {
            return false;
        }

        return $query;
    }

    public function update($parameters)
    {
        //required
        if (!isset($parameters['id']) || !isset($parameters['data']) || !isset($parameters['member_id'])) {
            return false;
        }

        $id        = isset($parameters['id']) ? $parameters['id'] : null;
        $member_id = isset($parameters['member_id']) ? $parameters['member_id'] : null;
        $data      = isset($parameters['data']) ? $parameters['data'] : null;

        $query = Banners::where('id', '=', $id)
            ->where('member_id', '=', $member_id)
            ->update($data);

        if (!isset($query)) {
            return false;
        }

        return $query;
    }

    public function destroy($parameters)
    {
        //required
        if (!isset($parameters['id'])) {
            return false;
        }

        $id   = isset($parameters['id']) ? $parameters['id'] : null;

        $query = Banners::find($id);
        $query->delete();

        if (!isset($query)) {
            return false;
        }

        return $query;
    }
}
