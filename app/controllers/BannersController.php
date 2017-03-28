<?php

class BannersController extends ApiController
{
    public function __construct()
    {
        $this->pathcache = 'api.0.banners';
    }

    public function index()
    {
        $data = Input::all();

        // Validator request
        $rules = array(
            'user_id' => 'integer|min:1',
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

        $user_id = array_get($data, 'user_id', 0);
        $order = isset($data['order']) ? $data['order'] : 'position';
        $sort = isset($data['sort']) ? $data['sort'] : 'asc';

        // Set Pagination
        $take = (int) (isset($data['perpage'])) ? $data['perpage'] : 20;
        $take = $take == 0 ? 20 : $take;
        $page = (int) (isset($data['page']) && $data['page'] > 0) ? $data['page'] : 1;
        $skip = ($page - 1) * $take;

        $filters = array();
        if ($user_id = array_get($data, 'user_id', false)) {
            $filters['user_id'] = $user_id;
        }

        $parameters = array(
            'filters' => $filters,
            'skip' => $skip,
            'take' => $take,
            'order' => array_get($data, 'order', 'position'),
            'sort' => array_get($data, 'sort', 'asc'),
        );
        
        isset($data['s']) ? $filters['s'] = $data['s'] : '';

        $query = Banners::filters($filters)
            ->with('images')
            ->orderBy($order, $sort);

        $count = (int) $query->count();
        $results = $query->skip($skip)->take($take)->get();
        $results = json_decode($results, true);

        if (!$results) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        //Loop data
        $entries = array();
        if (isset($results) && is_array($results)) {
            foreach ($results as $key => $value) {
                $entry = array();
                if (isset($value) && is_array($value)) {
                    // $user_id = array_get($value, 'id', 0);
                    foreach ($value as $key2 => $value2) {
                        if ($key2 == 'images') {
                            // Loop images
                            $images = loopImages($value2, $user_id, 'banners');
                            $entry[$key2] = $images;
                        } else if ($key2 == 'categories') {
                            $category['id'] = $value2['id'];
                            $category['title'] = $value2['title'];
                            $entry[$key2] = $category;
                        } else {
                            $entry[$key2] = $value2;
                        }
                    }
                }
                $entries[] = $entry;
            }
        }

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

    public function show($id)
    {
        $data = Input::all();
        $data['id'] = $id;

        // Validator request
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

        $filters = array(
            'id' => $id,
        );
        $query = Banners::filters($filters)
            ->with('images')->get();
        $results = json_decode($query, true);

        if (!$results) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        //Loop data
        $entries = array();
        if (isset($results) && is_array($results)) {
            foreach ($results as $key => $value) {
                $entry = array();
                if (isset($value) && is_array($value)) {
                    $user_id = array_get($value, 'id', 0);
                    foreach ($value as $key2 => $value2) {
                        if ($key2 == 'images') {
                            // Loop images
                            $images = loopImages($value2, $user_id);
                            $entry[$key2] = $images;
                        } else if ($key2 == 'categories') {
                            $category['id'] = $value2['id'];
                            $category['title'] = $value2['title'];
                            $entry[$key2] = $category;
                        } else {
                            $entry[$key2] = $value2;
                        }
                    }
                }
                $entries[] = $entry;
            }
        }

        $entries  = $entries[0];
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

        // Validator request
        $rules = array(
            'user_id' => 'required|integer|min:1',
            'title' => 'min:1|max:255',
            'subtitle' => 'min:1|max:255',
            'button' => 'integer|min:1|in:0,1',
            'button_title' => 'min:1|max:50',
            'button_url' => 'min:1|max:150',
            'images' => 'required',
            'position' => 'integer|max:2',
            'type' => 'integer|min:1',
            'status' => 'integer|min:1|in:0,1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $parameters = array(
            'user_id' => $data['user_id'],
            'title' => (isset($data['title']) ? $data['title'] : ''),
            'subtitle' => (isset($data['subtitle']) ? $data['subtitle'] : ''),
            'button' => (isset($data['button']) ? $data['button'] : '1'),
            'button_title' => (isset($data['button_title']) ? $data['button_title'] : ''),
            'button_url' => (isset($data['button_url']) ? $data['button_url'] : ''),
            'position' => (isset($data['position']) ? $data['position'] : '0'),
            'type' => (isset($data['type']) ? $data['type'] : '1'),
            'status' => (isset($data['status']) ? $data['status'] : '1'),
            'updated_at' => "0000-00-00 00:00:00",
            'created_at' => date("Y-m-d H:i:s"),
        );

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
            $response = array();

            return API::createResponse($response, 1001);
        }

        $id = (isset($query->id) ? $query->id : null);

        // Insert images
        if ($images = array_get($data, 'images', false)) {
            foreach ($images as $key => $value) {
                $image = self::insertImageable($value, $id, 'banners');

                if (!$image) {
                    return API::createResponse('Error, Insert image', 1001);
                }
            }
        }

        $response = array(
            'data' => $data,
        );

        // Clear cache value
        clearCacheStore($this->pathcache);

        return API::createResponse($response, 0);
    }

    public function update($id = null)
    {
        $data = Input::all();
        $data['id'] = $id;

        // Validator request
        $rules = array(
            'id' => 'required|integer|min:1',
            // 'user_id' => 'required|integer|min:1',
            'title' => 'min:1|max:255',
            'subtitle' => 'min:1|max:255',
            'button' => 'integer|in:0,1',
            'button_title' => 'min:1|max:50',
            'button_url' => 'min:1|max:150',
            'images' => 'min:1|max:255',
            'position' => 'integer',
            'type' => 'integer|min:1',
            'status' => 'integer|in:0,1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        isset($data['title']) ? $banner['title'] = $data['title'] : '';
        isset($data['subtitle']) ? $banner['subtitle'] = $data['subtitle'] : '';
        isset($data['button']) ? $banner['button'] = $data['button'] : '';
        isset($data['button_title']) ? $banner['button_title'] = $data['button_title'] : '';
        isset($data['button_url']) ? $banner['button_url'] = $data['button_url'] : '';
        isset($data['image']) ? $banner['image'] = $data['image'] : '';
        isset($data['position']) ? $banner['position'] = $data['position'] : '';
        isset($data['type']) ? $banner['type'] = $data['type'] : '';
        isset($data['status']) ? $banner['status'] = $data['status'] : '';
        $banner['updated_at'] = date("Y-m-d H:i:s");

        if ($images = array_get($data, 'images', false)) {
            if ($images_old = array_get($data, 'images_old', false)) {
                if ($img_id = array_get($images_old, 'id', false)) {
                    // Delete imageables
                    $filters = array(
                        'images_id' => $img_id,
                        'imageable_id' => $id,
                        'imageable_type' => 'banners',
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
                $image = self::insertImageable($value, $id, 'banners');

                if (!$image) {
                    return API::createResponse('Error, Insert image', 1001);
                }
            }
        }

        $query = Banners::where('id', '=', $id)
            ->update($banner);

        if (!$query) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        $response = array(
            'record' => $data,
        );

        // Clear cache value
        clearCacheUpdate($this->pathcache, $id);

        return API::createResponse($response, 0);
    }

    public function destroy($id = null)
    {
        $data = Input::all();
        $data['id'] = $id;

        // Validator request
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

        $query = Banners::find($id);
        $query->delete();

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
                'imageable_type' => 'banners',
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
            'data' => $data,
        );

        // Clear cache value
        clearCacheDestroy($this->pathcache, $id);

        return API::createResponse($response, 0);
    }

    private function insertImageable($image_id = null, $banner_id = null, $section = null)
    {
        if (!isset($image_id) || !isset($banner_id) || !isset($section)) {
            return false;
        }

        // Insert imageables
        $parameters = array(
            'images_id' => $image_id,
            'imageable_id' => $banner_id,
            'imageable_type' => $section,
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
