<?php

class CommentsController extends ApiController
{

    public function __construct()
    {
        $this->pathcache = 'api.0.comments';
    }

    public function index()
    {
        $data = Input::all();

        // Validator request
        $rules = array(
            // 'code' => 'integer',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        // Get cache value
        $keycache = getKeyCache($this->pathcache . '.index', $data);

        if ($response = getCache($keycache)) {
            return API::createResponse($response, 0);
        }

        // Set Pagination
        $take = (int) (isset($data['perpage'])) ? $data['perpage'] : 20;
        $take = $take == 0 ? 20 : $take;
        $page = (int) (isset($data['page']) && $data['page'] > 0) ? $data['page'] : 1;
        $skip = ($page - 1) * $take;

        // Filter
		$fild_arr = array(
			'id', 'name', 'email', 'message', 'user_id', 'commentable_type', 'commentable_id', 'number', 'status', 's'
		);
        
		$filters = array();
		foreach ($fild_arr as $value) {
        	isset($data[$value]) ? $filters[$value] = array_get($data, $value, ''):'';
		}

        // Query
        $order = array_get($data, 'order', 'updated_at');
        $sort = array_get($data, 'sort', 'asc');

        $query = Comments::filters($filters)
            ->orderBy($order, $sort);
        $count = (int) $query->count();
        $results = $query->skip($skip)->take($take)->get();
        $results = json_decode($results, true);

        if (!$results) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        $entries = $results;

        $pagings = array(
            'page' => $page,
            'perpage' => $take,
            'total' => $count,
        );

        $response = array(
            'cached'     => false,
            'pagination' => $pagings,
            'record'     => $entries,
        );

        // Save cache value
        saveCache($keycache, $response);

        return API::createResponse($response, 0);
    }

    public function show($id = null)
    {
        $data = Input::all();
        $data['id'] = $id;

        // Validator
        $rules = array(
            'id' => 'required|integer|min:1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        // Get cache value
        $keycache = getKeyCache($this->pathcache . '.show.' . $id, $data);
        
        if ($response = getCache($keycache)) {
            return API::createResponse($response, 0);
        }
		
		// Filter
		$fild_arr = array(
			'id'
		);
        
		$filters = array();
		foreach ($fild_arr as $value) {
        	isset($data[$value]) ? $filters[$value] = array_get($data, $value, ''):'';
		}

        $query = Comments::filters($filters)
                ->get();
        $results = json_decode($query, true);
		
        if (!$results) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        $entries = $results;
		
        $response = array(
            'cached' => false,
            'record' => $entries
        );

        // Save cache value
        saveCache($keycache, $response);

        return API::createResponse($response, 0);
    }

    public function store()
    {
        $data = Input::all();

        // Validator
        $rules = array(
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'commentable_type' => 'required',
            'commentable_id' => 'required',
            //'number' => 'required',
            'ip' => 'required'
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        // Get Blockwords
        $filters = array(
            'type' => '1'
        );
        $query = Blockwords::filters($filters)
                ->get();
        $results = json_decode($query, true);
        
        if (!$results) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        if ($message2 = array_get($data, 'message2', false)) {
            $data['message2'] = $message2;
        } else {
            // Check Blockwords
            $data['message2'] = replaceBlockwords(array_get($data, 'message', ''), '1', '***');
        }

        // Get next number
        $filters = array(
            'commentable_type' => array_get($data, 'commentable_type', ''),
            'commentable_id' => array_get($data, 'commentable_id', ''),
        );

        $query = Comments::filters($filters);
        $count = (int) $query->count();
        $count_next = $count + 1;
        $data['number'] = $count_next;

        // Parameter
        $date_time = date("Y-m-d H:i:s");
        $insert_allow = array(
            'name' => '',
            'email' => '',
            'message' => '',
            'message2' => '',
            'user_id' => '',
            'commentable_type' => '',
            'commentable_id' => '',
            'number' => '1',
            'status' => '1',
            'ip' => '',
            'updated_at' => $date_time,
            'created_at' => $date_time,
        );
        $parameters = array();
        foreach ($insert_allow as $key => $val) {
            $parameters[$key] = array_get($data, $key, $val);
        }

        // Insert category
        $query = new Comments();
        foreach ($parameters as $key => $value) {
            $query->$key = $value;
        }
        $query->save();

        if (!isset($query) || !is_object($query)) {
            $response = array();

            return API::createResponse($response, 1001);
        }

        $id = (isset($query->id) ? $query->id : null);

        $response = array(
            'id' => $id,
            'record' => $data,
        );

        // Clear cache value
        clearCacheStore($this->pathcache);

        return API::createResponse($response, 0);
    }

    public function update($id = null)
    {
        $data = Input::all();
        $data['id'] = $id;

        // Validator
        $rules = array(
            'id'        => 'required|integer|min:1',
            'user_id' => 'integer'
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $id = array_get($data, 'id', '');
        $user_id = array_get($data, 'user_id', '');
        
        if ($message2 = array_get($data, 'message2', false)) {
            $data['message2'] = $message2;
        } else {
            // Check Blockwords
            $data['message2'] = replaceBlockwords(array_get($data, 'message', ''), '1', '***');
        }
        
        $response  = array();

        // Update
        $update_allow = array(
            'name',
            'email',
            'message',
            'message2',
            'user_id',
            'commentable_type',
            'commentable_id',
            'status',
            'ip',
        );

        foreach ($data as $key => $value) {
            if (in_array($key, $update_allow)) {
                isset($data[$key]) ? $parameters[$key] = $value: '';
            }
        }

        if (isset($parameters)) {
            $parameters['updated_at'] = date("Y-m-d H:i:s");

            // Update
            $query = Comments::where('id', '=', $id);
              
            if ($query) {
                $query->update($parameters);
                $id = (isset($query->id)?$query->id:null);
            } else {
                return API::createResponse($response, 1004);
            }
        }

        $response = array(
            'record' => $data,
        );

        // Clear cache value
        clearCacheUpdate($this->pathcache, $id);

        return API::createResponse($data, 0);
    }

    public function destroy($id = null)
    {
        $data = Input::all();
        $data['id'] = $id;

        // Validator
        $rules = array(
            'id' => 'required|integer|min:1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        // Delete
        $query = Comments::find($id);
        if ($query) {
            $query->delete();
        }

        if (!$query) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        $response = array(
            'record' => $data,
        );

        // Clear cache value
        clearCacheDestroy($this->pathcache, $id);

        return API::createResponse($response, 0);
    }

    public function blockwords()
    {
        $data = Input::all();

        // Validator request
        $rules = array(
            // 'code' => 'integer',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        // Get cache value
        $key_cache = 'api.0.comments.blockword.' . md5(serialize($data));

        if ($response = getCache($key_cache)) {
            $response['cached'] = true;
            return API::createResponse($response, 0);
        }

        // Gen Blockwords Type
        $filters = array();
        $query = Comments::filters($filters)->get();
        $results = json_decode($query, true);

        if (!$results) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        if (is_array($results)) {
            foreach ($results as $key => $value) {
                // Check Blockwords
                $message = array_get($value, 'message', '');
                $id = array_get($value, 'id', '');
                $blockwords_type = array_get($value, 'blockwords_type', '');

                $check_type = array(
                    '1', // Blocked
                    '2', // Warning
                );

                foreach ($check_type as $value2) {
                    $checkBlockwords = checkBlockwords($message, $value2);
                    if ($checkBlockwords) {
                        if (strpos($blockwords_type, $value2) > -1) {
                            // Nothing
                        } else {
                            if (!empty($blockwords_type)) {
                                $blockwords_type = $blockwords_type.','.$value2;
                            } else {
                                $blockwords_type = $value2;
                            }
        
                            // Update
                            $parameters = array(
                                'blockwords_type' => $blockwords_type
                            );
                            $query = Comments::where('id', '=', $id);
                              
                            if ($query) {
                                $query->update($parameters);
                            } else {
                                return API::createResponse($response, 1001);
                            }
                        }
                    }
                }
            }
        }

        // Set Pagination
        $take = (int) (isset($data['perpage'])) ? $data['perpage'] : 20;
        $take = $take == 0 ? 20 : $take;
        $page = (int) (isset($data['page']) && $data['page'] > 0) ? $data['page'] : 1;
        $skip = ($page - 1) * $take;

        // Filter
        $fild_arr = array(
            'id', 'name', 'email', 'message', 'user_id', 'commentable_type', 'commentable_id', 'number', 'status', 'blockwords_type', 'ip', 's'
        );
        
        $filters = array();
        foreach ($fild_arr as $value) {
            isset($data[$value]) ? $filters[$value] = array_get($data, $value, ''):'';
        }

        // Query
        $order = array_get($data, 'order', 'updated_at');
        $sort = array_get($data, 'sort', 'asc');

        $query = Comments::filters($filters)
            ->orderBy($order, $sort);
        $count = (int) $query->count();
        $results = $query->skip($skip)->take($take)->get();
        $results = json_decode($results, true);

        if (!$results) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        $entries = $results;

        $pagings = array(
            'page' => $page,
            'perpage' => $take,
            'total' => $count,
        );

        $response = array(
            'cached' => false,
            'pagination' => $pagings,
            'record' => $entries,
        );

        // Save cache value
        saveCache($key_cache, $response);

        return API::createResponse($response, 0);
    }

    public function genblockwords()
    {
        $data = Input::all();

        // Validator request
        $rules = array(
            // 'code' => 'integer',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $data['page'] = 1;
        $data['perpage'] = 10000;

        // Set Pagination
        $take = (int) (isset($data['perpage'])) ? $data['perpage'] : 20;
        $take = $take == 0 ? 20 : $take;
        $page = (int) (isset($data['page']) && $data['page'] > 0) ? $data['page'] : 1;
        $skip = ($page - 1) * $take;

        // Filter
        $fild_arr = array(
            'id', 'name', 'email', 'message', 'user_id', 'commentable_type', 'commentable_id', 'number', 'status', 'blockwords_type', 'ip', 's'
        );
        
        $filters = array();
        foreach ($fild_arr as $value) {
            isset($data[$value]) ? $filters[$value] = array_get($data, $value, ''):'';
        }

        // Query
        $order = array_get($data, 'order', 'updated_at');
        $sort = array_get($data, 'sort', 'asc');

        $query = Comments::filters($filters)
            ->orderBy($order, $sort);
        $count = (int) $query->count();
        $results = $query->skip($skip)->take($take)->get();
        $results = json_decode($results, true);

        if (!$results) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        // Gen Blockwords Type
        $i = 0;
        if (is_array($results)) {
            foreach ($results as $key => $value) {
                // Check Blockwords
                $message = array_get($value, 'message', '');
                $id = array_get($value, 'id', '');
                $blockwords_type = array_get($value, 'blockwords_type', '');

                $check_type = array(
                    '1', // Blocked
                    '2', // Warning
                );

                $message2 = $message;
                foreach ($check_type as $value2) {
                    $message2 = replaceBlockwords($message2, $value2, '***');

                }

                if ($message2) {
                    //Update
                    $parameters = array(
                        'message2' => $message2,
                        'status' => '2'
                    );
                    $query = Comments::where('id', '=', $id);
                      
                    if ($query) {
                        $query->update($parameters);
                        $i++;
                    } else {
                        return API::createResponse($response, 1001);
                    }
                }
            }
        }

        $response = array(
            'total' => $i,
            'data' => $data
        );

        return API::createResponse($response, 0);
    }
}
