<?php

class CategoriesController extends ApiController
{
    public function __construct()
    {
        $this->pathcache = 'api.0.categories';
    }

    public function index()
    {
        $data = Input::all();

        $response = array(
            'data' => $data,
        );

        // Validator
        $rules = array(
            // 'user_id' => 'required|integer|min:1',
            'type'      => 'integer|min:1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first()
            );

            return API::createResponse($response, 1003);
        }

        // Get cache value
        $keycache = getKeyCache($this->pathcache . '.index', $data);

        if ($response = getCache($keycache)) {
            return API::createResponse($response, 0);
        }

        $order   = array_get($data, 'order', 'position');
        $sort    = array_get($data, 'sort', 'asc');

        // Set Pagination
        $take = (int) (isset($data['perpage'])) ? $data['perpage'] : 20;
        $take = $take == 0 ? 20 : $take;
        $page = (int) (isset($data['page']) && $data['page'] > 0) ? $data['page'] : 1;
        $skip = ($page - 1) * $take;
		
		// Filter
		$fild_arr = array(
			'id', 'title', 'description', 'parent_id', 'user_id', 'position', 'type', 'status', 's'
		);
        
		$filters = array();
		foreach ($fild_arr as $value) {
        	isset($data[$value]) ? $filters[$value] = array_get($data, $value, ''):'';
		}

        $query = Categories::filters($filters)
                ->with('images')
                ->orderBy($order, $sort);
        $count   = (int) $query->count();
        $results = $query->skip($skip)->take($take)->get();
        $results = json_decode($results, true);
        
        if (!$results) {
            return API::createResponse($response, 1004);
        }
		
		//Loop data
        $entries = array();
        if (isset($results) && is_array($results)) {
            foreach ($results as $key => $value) {
                $entry = array();
                if (isset($value) && is_array($value)) {
                    $user_id = 0;
                    foreach ($value as $key2 => $value2) {
                       if ($key2 == 'images') {
                            // Loop images
                            $images = loopImages($value2, $user_id, 'categories');
                            $entry[$key2] = $images;
                        } else {
                            $entry[$key2] = $value2;
                        }
                    }
                }
                $entries[] = $entry;
            }
        }

        $pagings = array(
            'page'    => $page,
            'perpage' => $take,
            'total'   => $count,
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
            'id'        => 'required|integer|min:1',
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

        $query = Categories::filters($filters)
                ->with('images')->get();
        $results = json_decode($query, true);
		
        if (!$results) {
            $response = array();

            return API::createResponse($response, 1004);
        }

		//Loop data
        $entries = array();
        if (isset($results) && is_array($results)) {
            foreach ($results as $value) {
                $entry = array();
                if (isset($value) && is_array($value)) {
                    $user_id = 0;
                    foreach ($value as $key2 => $value2) {
                       if ($key2 == 'images') {
                            // Loop images
                            $images = loopImages($value2, $user_id, 'categories');
                            $entry[$key2] = $images;
                        } else {
                            $entry[$key2] = $value2;
                        }
                    }
                }
                $entries[] = $entry;
            }
        }

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
            'title'       => 'required',
            // 'description' => 'required',
            'parent_id'   => 'required|integer',
            'user_id'   => 'required|integer',
            'position'    => 'required|integer',
            'images'      => 'required',
            'type'        => 'required|integer',
            'status'      => 'integer|in:0,1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

		// Parameter
		$date_time = date("Y-m-d H:i:s");
		$insert_allow = array(
			'title' => '', 
			'description' => '', 
			'parent_id' => '0', 
			'user_id' => '1', 
			'position' => '0',
			'type' => '0', 
			'status' => '1',
			'updated_at' => $date_time,
			'created_at' => $date_time,
		);
		$parameters = array();
		foreach ($insert_allow as $key => $val) {
			$parameters[$key] = array_get($data, $key, $val);
		}

        // Insert category
        $query = new Categories();
        foreach ($parameters as $key => $value) {
            $query->$key = $value;
        }
        $query->save();

        if (!isset($query) || !is_object($query)) {
            $response = array();

            return API::createResponse($response, 1001);
        }

        $id = (isset($query->id) ? $query->id : null);

  		// Insert images
        if ($images = array_get($data, 'images', false)) {
            foreach ($images as $key => $value) {
                $image = insertImageable($value, $id, 'categories');

                if (!$image) {
                    return API::createResponse('Error, Insert image', 1001);
                }
            }
        }

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
            'user_id' => 'required|integer'
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $id        = array_get($data, 'id', null);
        $user_id = array_get($data, 'user_id', null);
        $response  = array();
	
		// Images
		if ($images = array_get($data, 'images', false)) {
            if ($images_old = array_get($data, 'images_old', false)) {
                if ($img_id = array_get($images_old, 'id', false)) {
                    // Delete imageables
                    $filters = array(
                        'images_id' => $img_id,
                        'imageable_id' => $id,
                        'imageable_type' => 'categories',
                    );

                    $query_ia = Imageables::filters($filters);
                    if ($query_ia) {
                        $query_ia->delete();
                    }

                    // Delete image
                    $filters = array(
                        'id' => $img_id,
                    );

                    $query_i = Images::filters($filters);
                    if ($query_i) {
                        $query_i->delete();
                    }
                }
            }

            // Insert images
            foreach ($images as $key => $value) {
                $image = self::insertImageable($value, $id, 'categories');

                if (!$image) {
                    return API::createResponse('Error, Insert image', 1001);
                }
            }
        }

        // Update
        $update_allow = array(
            'title',
            'description',
            'parent_id',
            'user_id',
            'position',
            'type',
            'status',
        );

        foreach ($data as $key => $value) {
            if (in_array($key, $update_allow)) {
                isset($data[$key]) ? $parameters[$key] = $value: '';
            }
        }

        if (isset($parameters)) {
            $parameters['updated_at'] = date("Y-m-d H:i:s");

            // Update
            $query = Categories::where('id', '=', $id)
                ->where('user_id', '=', $user_id);
              
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
        $query = Categories::find($id);
        if ($query) {
            $query->delete();
        }

        if (!$query) {
            $response = array();

            return API::createResponse($response, 1004);
        }
		
		// Delete images
        if ($images_id = array_get($data, 'images_id', false)) {
            // Delete imageables
            $filters = array(
                'images_id' => $images_id,
                'imageable_id' => $id,
                'imageable_type' => 'categories',
            );

            $query_ia = Imageables::filters($filters);
            if ($query_ia) {
                $query_ia->delete();
            }

            // Delete image
            $filters = array(
                'id' => $images_id,
            );

            $query_i = Images::filters($filters);
            if ($query_i) {
                $query_i->delete();
            }
        }

        $response = array(
            'record' => $data,
        );

        // Clear cache value
        clearCacheDestroy($this->pathcache, $id);

        return API::createResponse($response, 0);
    }
	
	private function insertImageable($image_id = null, $imageable_id = null, $imageable_type = null)
    {
        if (!isset($image_id) || !isset($imageable_id) || !isset($imageable_type)) {
            return false;
        }

        // Insert imageables
        $parameters = array(
            'images_id' => $image_id,
            'imageable_id' => $imageable_id,
            'imageable_type' => $imageable_type,
        );

        $query = new Imageables();
        foreach ($parameters as $key => $value) {
            $query->$key = $value;
        }
        $query->save();

        if (!$query) {
            return false;
        }

        return true;
    }
}
