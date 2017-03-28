<?php

class NewsController extends ApiController
{
    
    public function __construct()
    {
        $this->pathcache = 'api.0.news';
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

        $user_id       = array_get($data, 'user_id', 0);

        // Set Pagination
        $take = (int) (isset($data['perpage'])) ? $data['perpage'] : 20;
        $take = $take == 0 ? 20 : $take;
        $page = (int) (isset($data['page']) && $data['page'] > 0) ? $data['page'] : 1;
        $skip = ($page - 1) * $take;

        $filters = array(
            'user_id' => $user_id,
        );

        isset($data['s']) ? $filters['s'] = $data['s'] : '';
        isset($data['type']) ? $filters['type'] = $data['type'] : '';
        isset($data['category_id']) ? $filters['categories'] = $data['category_id'] : '';

        // Query
        $order   = array_get($data, 'order', 'updated_at');
        $sort    = array_get($data, 'sort', 'desc');

        $query = News::filters($filters)
                ->with('images')
                ->with('categories')
                ->with('tags')
                ->orderBy($order, $sort);
        $count   = (int) $query->count();
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
                $entries[] = $entry;
            }
        }

        $pagings = array(
            'page'    => $page,
            'perpage' => $take,
            'total'   => $count
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
            'id'        => 'required|integer|min:1',
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
        $keycache = getKeyCache($this->pathcache . '.show.' . $id, $data);
        
        if ($response = getCache($keycache)) {
            return API::createResponse($response, 0);
        }

        $user_id = array_get($data, 'user_id', 0);

        $filters = array(
            'id'        => $id,
            'user_id' => $user_id,
            'ids_type'  => '2'
        );

        // Query
        $order   = array_get($data, 'order', 'updated_at');
        $sort    = array_get($data, 'sort', 'desc');

        $query   = News::filters($filters)
                ->with('images')
                ->with('tags')
                ->with('categories')
                ->orderBy($order, $sort);
        $count   = (int) $query->count();
        $results = $query->get();
        $results = json_decode($results, true);

        if (!$results) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        //Loop data
        $entries = array();
        if (isset($results) && is_array($results)) {
            foreach ($results as $key => $value) {
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

        // Validator request
        $rules = array(
            'title'            => 'required',
            'sub_description'  => 'required',
            'description'      => 'required',
            'images'           => 'required',
            'position'         => 'required|integer',
            'status'           => 'required|integer|in:0,1',
            'type'             => 'required|integer',
            'user_id'          => 'required|integer|min:1',
            'tags'             => 'required',
            // 'reference'     => 'min:1|max:150',
            // 'reference_url' => 'min:1|max:150',
            'category_id'      => 'required|min:1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        // Add news
        $parameters = array(
            
            'title'           => (isset($data['title'])?$data['title']:''),
            'sub_description' => (isset($data['sub_description'])?$data['sub_description']:''),
            'description'     => (isset($data['description'])?$data['description']:''),
            'position'        => (isset($data['position'])?$data['position']:''),
            'status'          => (isset($data['status'])?$data['status']:'1'),
            'type'            => (isset($data['type'])?$data['type']:'1'), //1=general,2=highlight
            'user_id'         => (isset($data['user_id'])?$data['user_id']:'0'),
            'reference'       => (isset($data['reference'])?$data['reference']:''),
            'reference_url'   => (isset($data['reference_url'])?$data['reference_url']:''),
            'categories'     => (isset($data['category_id'])?$data['category_id']:'0'),
            'views'           => (isset($data['views'])?$data['views']:'0'),
            'likes'           => (isset($data['likes'])?$data['likes']:'0'),
            'share'           => (isset($data['share'])?$data['share']:'0'),
            'updated_at'      => date("Y-m-d H:i:s"),
            'created_at'      => date("Y-m-d H:i:s"),
        );

        // Insert
        $query = new News();
        foreach ($parameters as $key => $value) {
            $query->$key = $value;
        }
        $query->save();
        $id = (isset($query->id)?$query->id:null);

        if (!$query || empty($id)) {
            $response = array();

            return API::createResponse($response, 1001);
        }

        // Add Images
        $parameters = array(
            'images'         => array_get($data, 'images', ''),
            'imageable_id'   => $id,
            'imageable_type' => 'news',
        );
        $images_i = $this->addImages($parameters);

        if (!$images_i) {
            $response = array();

            return API::createResponse($response, 1001);
        }

        // Add Tags
        $parameters = array(
            'title'        => array_get($data, 'tags', ''),
            'tagable_id'   => $id,
            'tagable_type' => 'news',
        );

        $tags_i = $this->addTags($parameters);

        if (!$tags_i) {
            $response = array();

            return API::createResponse($response, 1001);
        }

        $response = array(
            'id' => $id,
            'record' => $data,
        );

        // Clear cache value
        clearCacheStore($this->pathcache);

        return API::createResponse($data, 0);
    }

    public function update($id = null)
    {
        $data = Input::all();
        $data['id'] = $id;

        // Validator request
        $rules = array(
            'id' => 'required|integer',
            /*'title'            => 'required',
            'sub_description'  => 'required',
            'description'      => 'required',
            'position'         => 'required|integer',
            'status'           => 'required|integer|in:0,1',
            'type'             => 'required|integer',
            'user_id'        => 'required|integer|min:1',
            'category_id'      => 'required|min:1',*/
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

        // Edit news
        $parameters = array();
        isset($data['title']) ? $parameters['title'] = $data['title']: '';
        isset($data['sub_description']) ? $parameters['sub_description'] = $data['sub_description']: '';
        isset($data['description']) ? $parameters['description'] = $data['description']: '';
        // isset($data['images']) ? $parameters['images'] = $data['images']: '';
        isset($data['position']) ? $parameters['position'] = $data['position']: '';
        isset($data['status']) ? $parameters['status'] = $data['status']: '';
        isset($data['type']) ? $parameters['type'] = $data['type']: '';
        isset($data['user_id']) ? $parameters['user_id'] = $data['user_id']: '';
        isset($data['reference']) ? $parameters['reference'] = $data['reference']: '';
        isset($data['reference_url']) ? $parameters['reference_url'] = $data['reference_url']: '';
        isset($data['category_id']) ? $parameters['categories'] = $data['category_id']: '';
        // isset($data['tags']) ? $parameters['tags'] = $data['tags']: '';
        isset($data['views']) ? $parameters['views'] = $data['views']: '';
        isset($data['likes']) ? $parameters['likes'] = $data['likes']: '';
        isset($data['share']) ? $parameters['share'] = $data['share']: '';
        isset($data['updated_at']) ? $parameters['updated_at'] = $data['updated_at']: '';
        //$parameters['updated_at'] = date("Y-m-d H:i:s");

        // Update news
        $query = News::where('id', '=', $id);
            
        if ($query) {
            $query->update($parameters);
        } else {
            $response = array();

            return API::createResponse($response, 1004);
        }

        if ($images = array_get($data, 'images', false)) {
            // Add Images
            $parameters = array(
                'images'         => $images,
                'imageable_id'   => $id,
                'imageable_type' => 'news',
            );
            $images_i = $this->addImages($parameters);

            if (!$images_i) {
                $response = array();

                return API::createResponse($response, 1001);
            }
        }

        if ($tags = array_get($data, 'tags', false)) {
            // Add Tags
            $parameters = array(
                'title'        => $tags,
                'tagable_id'   => $id,
                'tagable_type' => 'news',
            );

            $tags_i = $this->addTags($parameters);

            if (!$tags_i) {
                $response = array();

                return API::createResponse($response, 1001);
            }
        }

        $response = array(
            'record' => $query,
        );

        // Clear cache value
        clearCacheUpdate($this->pathcache, $id);

        return API::createResponse($data, 0);
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
        
        // Delete news
        $query = News::find($id);
        if ($query) {
            $query->delete();

            if ($query) {
                // Add Images
                $parameters = array(
                    'imageable_id'   => $id,
                    'imageable_type' => 'news',
                );
                $images_i = $this->addImages($parameters);

                if (!$images_i) {
                    $response = array();

                    return API::createResponse($response, 1001);
                }

                // Add Tags
                $parameters = array(
                    'tagable_id'   => $id,
                    'tagable_type' => 'news',
                );

                $tags_i = $this->addTags($parameters);

                if (!$tags_i) {
                    $response = array();

                    return API::createResponse($response, 1001);
                }
            }
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

    private function addTags($data)
    {
        // Validator
        $rules = array(
            'tagable_id'   => 'required|integer',
            'tagable_type' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return false;
        }

        $tagable_id = array_get($data, 'tagable_id', '');
        $tagable_type = array_get($data, 'tagable_type', '');

        // Delete Tagables
        $filters = array(
            'tagable_id'   => $tagable_id,
            'tagable_type' => $tagable_type,
        );
        $query = Tagables::filters($filters);
        if ($query) {
            $query->delete();
        }

        if (!$query) {
            return false;
        }

        if ($title = array_get($data, 'title', false)) {
            $title = explode(',', $title);

            foreach ($title as $key => $tt) {
                // Insert Tags
                $filters = array(
                    'title' => $tt,
                );

                $query = Tags::filters($filters)->get();
                $count   = (int) $query->count();

                if ($count == 0) {
                    // Insert
                    $parameters2 = array(
                        'title'      => $tt,
                        'status'     => array_get($data, 'status', '1'),
                        'updated_at' => date("Y-m-d H:i:s"),
                        'created_at' => date("Y-m-d H:i:s"),
                    );

                    $query2 = new Tags();
                    foreach ($parameters2 as $key2 => $value2) {
                        $query2->$key2 = $value2;
                    }

                    $query2->save();

                    if (!$query2) {
                        return false;
                    }

                    $tags_id = (isset($query2->id) ? $query2->id : '');
                } else {
                    if ($tags_id = (isset($query[0]->id) ? $query[0]->id : '')) {
                        $parameters2['updated_at'] = date("Y-m-d H:i:s");

                        // Update
                        $query2 = Tags::where('id', '=', $tags_id);
                          
                        if ($query2) {
                            $query2->update($parameters2);
                        } else {
                            return false;
                        }
                    }
                }

                // Insert Tagables
                $filters3   = array(
                    'tags_id'      => $tags_id,
                    'tagable_id'   => $tagable_id,
                    'tagable_type' => $tagable_type,
                );

                $query3 = Tagables::filters($filters3)->get();
                $count3   = (int) $query3->count();

                if ($count3 == 0) {
                    // Insert
                    $parameters4 = array(
                        'tags_id'    => $tags_id,
                        'tagable_id'   => $tagable_id,
                        'tagable_type' => $tagable_type,
                        'updated_at' => date("Y-m-d H:i:s"),
                        'created_at' => date("Y-m-d H:i:s"),
                    );

                    $query4 = new Tagables();
                    foreach ($parameters4 as $key4 => $value4) {
                        $query4->$key4 = $value4;
                    }
                    $query4->save();

                    if (!$query4) {
                        return false;
                    }
                } else {
                    if ($tags_id = (isset($query3[0]->tags_id) ? $query3[0]->tags_id : false)) {
                        $parameters5['updated_at'] = date("Y-m-d H:i:s");

                        // Update
                        $query5 = Tagables::where('tags_id', '=', $tags_id);
                          
                        if ($query5) {
                            $query5->update($parameters5);
                        } else {
                            return false;
                        }
                    }
                }
            }
        }

        return true;
    }

    private function addImages($data)
    {
        // Delete imageables
        $imageable_id = array_get($data, 'imageable_id', '');
        $imageable_type = array_get($data, 'imageable_type', '');
        $filters = array(
            'imageable_id' => $imageable_id,
            'imageable_type' => $imageable_type,
        );

        $query_ia = Imageables::filters($filters);
        if ($query_ia) {
            $query_ia->delete();
        }

        // Insert images
        if ($images = array_get($data, 'images', false)) {
            $position = 0;
            foreach ($images as $key => $value) {
                // Update image
                $parameters = array(
                    'position' => $position,
                );
                $query = Images::where('id', '=', $value);

                if ($query) {
                    $query->update($parameters);
                } else {
                    return false;
                }

                // Insert imageables
                $parameters = array(
                    'images_id' => $value,
                    'imageable_id' => $imageable_id,
                    'imageable_type' => $imageable_type,
                );

                $query = new Imageables();
                foreach ($parameters as $key2 => $value2) {
                    $query->$key2 = $value2;
                }
                $query->save();

                if (!$query) {
                    return false;
                }

                $position++;
            }
        }

        return true;
    }

    public function updateStat()
    {
        $data = Input::all();

        // Validator request
        $rules = array(
            'type' => 'required|in:views,likes,unlikes,share',
            'id' => 'required|integer|min:1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $id = array_get($data, 'id', '');
        $type = array_get($data, 'type', '');
        $action = array_get($data, 'action', '1');

        $filters = array(
            'id' => $id,
        );

        // Query
        $query   = News::filters($filters);
        $results = $query->get(array('views','likes','unlikes','share'));
        $count   = (int) $query->count();
        $results = json_decode($results, true);

        if ($count == 0) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        $type_num = '';
        if ($type_num = array_get($results, '0', false)) {
            // 2 = Decrease
            if ($action == '2') {
                if ($type_num[$type] > 0) {
                    $num = $type_num[$type] - 1;
                } else {
                    $num = 0;
                }

                $parameters[$type] = $num;
                $type_num[$type] = $num;

            // 3 = Increase and Decrease
            } else if ($action == '3') {
                if ($type == 'likes') {
                    $num = $type_num['likes'] + 1;
                    $parameters['likes'] = $num;
                    $type_num['likes'] = $num;

                    if ($type_num['unlikes'] > 0) {
                        $num2 = $type_num['unlikes'] - 1;
                    } else {
                        $num2 = 0;
                    }
                    $parameters['unlikes'] = $num2;
                    $type_num['unlikes'] = $num2;
                } else if ($type == 'unlikes') {
                    if ($type_num['likes'] > 0) {
                        $num = $type_num['likes'] - 1;
                    } else {
                        $num = 0;
                    }
                    $parameters['likes'] = $num;
                    $type_num['likes'] = $num;

                    $num2 = $type_num['unlikes'] + 1;
                    $parameters['unlikes'] = $num2;
                    $type_num['unlikes'] = $num2;
                }

            // 1 = Increase
            } else {
                $num = $type_num[$type]  + 1;
                $parameters[$type] = $num;
                $type_num[$type] = $num;
            }

            // Update news
            $query = News::where('id', '=', $id);

            if ($query) {
                $query->update($parameters);
            } else {
                $response = array();

                return API::createResponse($response, 1004);
            }
        }

        $response = $type_num;

        return API::createResponse($response, 0);
    }
}
