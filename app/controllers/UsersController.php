<?php

class UsersController extends ApiController
{

    public function __construct()
    {
        $this->pathcache = 'api.0.users';
    }

    public function index()
    {
        $data = Input::all();

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

        $filters = array();
        isset($data['email']) ? $filters['email'] = $data['email'] : '';
        isset($data['password']) ? $filters['password'] = $data['password'] : '';
        isset($data['status']) ? $filters['status'] = $data['status'] : '';
        isset($data['active']) ? $filters['active'] = $data['active'] : '';
        isset($data['s']) ? $filters['s'] = $data['s'] : '';

        // Query
        $order = array_get($data, 'order', 'updated_at');
        $sort = array_get($data, 'sort', 'desc');

        $query = Users::filters($filters)
            ->with('images')
            ->with('roles')
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
                if (isset($value) && is_array($value)) {
                    $user_id = array_get($value, 'id', 0);
                    foreach ($value as $key2 => $value2) {
                        if ($key2 == 'images') {
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

        // Query
        $filters = array(
            'id' => $id,
        );

        $query = Users::filters($filters)
            ->with('images')
            ->with('roles')
            ->get();
        $results = json_decode($query, true);

        if (!$results) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        //Loop data
        $entries = array();
        if (isset($results) && is_array($results)) {
            foreach ($results as $key => $value) {
                if (isset($value) && is_array($value)) {
                    $user_id = array_get($value, 'id', 0);
                    foreach ($value as $key2 => $value2) {
                        if ($key2 == 'images') {
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

        $response = array(
            'cached' => false,
            'record' => $entries[0]
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
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required',
            'birthday' => 'date_format:"Y-m-d"',
            'uid_fb' => 'integer',
            'phone' => 'between:8,12',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $email = array_get($data, 'email', 0);
        $filters = array(
            'email' => $email,
        );

        $query = new Users();
        $query = Users::filters($filters)->get();
        $count = (int) $query->count();
        $query = $query->first();

        $id = isset($query->id) ? $query->id : 0;
        $mode = '';
        $images_old = array();

        // Create new user
        if ($count == 0) {
            // Insert new user
            $query = $this->insertUser($data);

            if (!$query) {
                return API::createResponse('Error, Insert user', 1001);
            }

            $id = (isset($query->id) ? $query->id : null);

            // Insert images for facebook
            if ($images = array_get($data, 'images', false)) {
                foreach ($images as $key => $value) {
                    $images_i = $this->insertImages($id, $value);

                    if (!$images_i) {
                        return API::createResponse('Error, Insert image', 1001);
                    }
                }
            }

            // Insert Role
            if ($role = array_get($data, 'role', false)) {
                foreach ($role as $key => $value) {
                    // Insert roles
                    $parameters = array(
                        'roles_id' => $value,
                        'roleable_id' => $id,
                        'roleable_type' => 'users',
                    );

                    $query = new Roleables();
                    foreach ($parameters as $key => $value) {
                        $query->$key = $value;
                    }
                    $query->save();

                    if (!$query) {
                        return API::createResponse('Error, Insert roleables', 1001);
                    }
                }
            }

            $mode = 'create';

            // Update exist user
        } else if ($count > 0) {
            $query = $this->updateUser($id, $data);

            if (!$query) {
                return API::createResponse('Error, Update user', 1001);
            }

            // Update images for facebook
            if ($images = array_get($data, 'images', false)) {
                foreach ($images as $key => $value) {
                    $images_i = $this->updateImages($id, $value);

                    if (!$images_i) {
                        return API::createResponse('Error, Update image', 1001);
                    }

                    if (isset($images_i['images_old'])) {
                        foreach ($images_i['images_old'] as $key => $value) {
                            $images_old[] = $value;
                        }
                    }
                }
            }

            $mode = 'update';
        }

        $response = array(
            'record' => $query,
            'mode' => $mode,
            'images_old' => $images_old,
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
            'id' => 'required|integer|min:1',
            'email' => 'email',
            // 'password' => 'between:4,40',
            'birthday' => 'date_format:"Y-m-d"',
            // 'photo'    => 'active_url',
            'uid_fb' => 'integer',
            'phone' => 'between:8,12',
            // 'status'   => 'boolean',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $response = array();

        // Update
        $update_allow = array(
            'email',
            'password',
            'name',
            'first_name',
            'last_name',
            'birthday',
            'phone',
            'photo',
            'uid_fb',
            'access_token_fb',
            'remember_token',
            'gender',
            'status',
            'active',
        );

        foreach ($data as $key => $value) {
            if (in_array($key, $update_allow)) {
                isset($data[$key]) ? $parameters[$key] = $value : '';
            }
        }

        if (isset($parameters)) {
            $parameters['updated_at'] = date("Y-m-d H:i:s");

            // Update
            $query = Users::where('id', '=', $id);

            if ($query) {
                $query->update($parameters);

                if (!$query) {
                    return API::createResponse($response, 1001);
                }

                // Insert Role
                if ($role = array_get($data, 'role', false)) {
                    // Delete old Roleables
                    $filters = array(
                        'roleable_id' => $id,
                        'roleable_type' => 'users',
                    );

                    $query_h = Roleables::filters($filters);
                    if (!$query_h) {
                        return false;
                    }
                    $query_h->delete();

                    foreach ($role as $key => $value) {
                        // Insert roles
                        $parameters = array(
                            'roles_id' => $value,
                            'roleable_id' => $id,
                            'roleable_type' => 'users',
                        );

                        $query = new Roleables();
                        foreach ($parameters as $key => $value) {
                            $query->$key = $value;
                        }
                        $query->save();

                        if (!$query) {
                            return API::createResponse('Error, Insert roleables', 1001);
                        }
                    }
                }

                if ($images = array_get($data, 'images', '')) {
                    if ($images != '') {
                        // Delete old imageables
                        $filters = array(
                            'imageable_id' => $id,
                            'imageable_type' => 'users',
                        );

                        $query_h = Imageables::filters($filters);
                        if (!$query_h) {
                            return false;
                        }
                        $query_h->delete();

                        if (is_array($images)) {
                            foreach ($images as $images_id) {
                                // Insert imageables
                                $parameters_i = array(
                                    'images_id' => $images_id,
                                    'imageable_id' => $id,
                                    'imageable_type' => 'users',
                                );

                                $query_i = new Imageables();
                                foreach ($parameters_i as $key => $value) {
                                    $query_i->$key = $value;
                                }
                                $query_i->save();

                                if (!$query_i) {
                                    return API::createResponse($response, 1001);
                                }
                            }
                        } else if (!empty($images)) {
                            // Insert imageables
                            $parameters_i = array(
                                'images_id' => $images,
                                'imageable_id' => $id,
                                'imageable_type' => 'users',
                            );

                            $query_i = new Imageables();
                            foreach ($parameters_i as $key => $value) {
                                $query_i->$key = $value;
                            }
                            $query_i->save();

                            if (!$query_i) {
                                return API::createResponse($response, 1001);
                            }
                        }
                    }
                }
            } else {
                return API::createResponse($response, 1004);
            }
        } else {
            return API::createResponse($data, 1018);
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
        $query = Users::find($id);
        if ($query) {
            $query->delete();
        }

        if (!$query) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        // Delete imageables
        $filters = array(
            'imageable_id' => $id,
            'imageable_type' => 'users',
        );

        $query_ia = Imageables::filters($filters);
        if ($query_ia) {
            $query_ia->delete();
        }

        // Delete image
        $filters = array(
            'user_id' => $id,
        );

        $query_i = Images::filters($filters);
        if ($query_i) {
            $query_i->delete();
        }

        $response = array(
            'record' => $data,
        );

        // Clear cache value
        clearCacheDestroy($this->pathcache, $id);

        return API::createResponse($response, 0);
    }

    private function insertUser($data = array())
    {
        $param = array(
            'email' => '',
            'password' => '',
            'name' => '',
            'first_name' => '',
            'last_name' => '',
            'gender' => '',
            'birthday' => '',
            'photo' => '',
            'uid_fb' => '',
            'link_fb' => '',
            'locale' => 'th_TH',
            'timezone' => '7',
            'access_token_fb' => '',
            'remember_token' => '',
            'active' => '',
            'status' => '1',
        );

        foreach ($param as $key => $value) {
            $parameters[$key] = array_get($data, $key, $value);
        }

        $datenow = date("Y-m-d H:i:s");
        $parameters['updated_at'] = $datenow;
        $parameters['created_at'] = $datenow;

        $query = new Users();
        foreach ($parameters as $key => $value) {
            $query->$key = $value;
        }
        $query->save();

        return $query;
    }

    private function updateUser($id = null, $data = array())
    {
        if (empty($id)) {
            return false;
        }

        $query = new Users();
        $update_allow = array(
            // 'email',
            // 'password',
            'name',
            'first_name',
            'last_name',
            'gender',
            'birthday',
            'photo',
            'uid_fb',
            'link_fb',
            'locale',
            'timezone',
            'access_token_fb',
            'remember_token',
            'active',
            // 'status',
        );

        foreach ($data as $key => $value) {
            if (in_array($key, $update_allow)) {
                isset($data[$key]) ? $parameters[$key] = $value : '';
                isset($data[$key]) ? $query->$key = $value : '';
            }
        }

        if (isset($parameters)) {
            $parameters['updated_at'] = date("Y-m-d H:i:s");

            // Update
            $query = Users::where('id', '=', $id);

            if ($query) {
                $query->update($parameters);
            }
        }

        $data['id'] = $id;

        return $data;
    }

    private function insertImages($user_id = null, $data = array())
    {
        if (!isset($user_id) || !isset($data['code']) || !isset($data['name']) || !isset($data['extension'])) {
            return false;
        }

        // Insert images
        $parameters = array(
            'user_id' => $user_id,
            'code' => $data['code'],
            'name' => $data['name'],
            'extension' => $data['extension'],
            'url' => (isset($data['url']) ? $data['url'] : ''),
            'type' => (isset($data['type']) ? $data['type'] : '0'), //Unknown in future
            'size' => (isset($data['size']) ? $data['size'] : '0'),
            'width' => (isset($data['width']) ? $data['width'] : '0'),
            'height' => (isset($data['height']) ? $data['height'] : '0'),
            'position' => (isset($data['position']) ? $data['position'] : '0'),
            'status' => (isset($data['status']) ? $data['status'] : '1'),
            'updated_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
        );

        $query = new Images();
        foreach ($parameters as $key => $value) {
            $query->$key = $value;
        }
        $query->save();
        $id = (isset($query->id) ? $query->id : null);

        if (!$query) {
            return false;
        }

        // Insert imageables
        $parameters = array(
            'images_id' => $id,
            'imageable_id' => $user_id,
            'imageable_type' => 'users',
        );

        $query = new Imageables();
        foreach ($parameters as $key => $value) {
            $query->$key = $value;
        }
        $query->save();

        if (!$query) {
            return false;
        }

        return $id;
    }

    private function updateImages($user_id = null, $data = array())
    {
        if (!isset($user_id) || !isset($data['code']) || !isset($data['name']) || !isset($data['extension'])) {
            return false;
        }

        $images_old = array();

        // Delete old imageables
        $filters = array(
            'imageable_id' => $user_id,
            'imageable_type' => 'users',
        );

        $query = Imageables::filters($filters);
        $query_i = Imageables::filters($filters)->get();
        if (!$query || !$query_i) {
            return false;
        }

        $query_i = json_decode($query_i);

        $query->delete();

        if (!$query) {
            return flase;
        }

        // Delete old images
        if (isset($query_i) && is_array($query_i)) {
            foreach ($query_i as $key => $value) {
                $images_id = $value->images_id;

                // Check image use another
                $filters = array(
                    'images_id' => $images_id,
                );

                $count = Imageables::filters($filters)->count();

                if ($count == 0) {
                    // Delete image
                    $query = Images::find($images_id);
                    $img_old = $query;

                    if (!$query) {
                        return false;
                    }

                    $query->delete();

                    if (!$query) {
                        return false;
                    }

                    $images_old[] = $img_old;
                }
            }
        }

        // Insert images
        $parameters = array(
            'user_id' => $user_id,
            'code' => $data['code'],
            'name' => $data['name'],
            'extension' => $data['extension'],
            'url' => (isset($data['url']) ? $data['url'] : ''),
            'type' => (isset($data['type']) ? $data['type'] : '0'), //Unknown in future
            'size' => (isset($data['size']) ? $data['size'] : '0'),
            'width' => (isset($data['width']) ? $data['width'] : '0'),
            'height' => (isset($data['height']) ? $data['height'] : '0'),
            'position' => (isset($data['position']) ? $data['position'] : '0'),
            'status' => (isset($data['status']) ? $data['status'] : '1'),
            'updated_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
        );

        $query = new Images();
        foreach ($parameters as $key => $value) {
            $query->$key = $value;
        }
        $query->save();
        $id = (isset($query->id) ? $query->id : null);

        if (!$query) {
            return false;
        }

        // Insert imageables
        $parameters = array(
            'images_id' => $id,
            'imageable_id' => $user_id,
            'imageable_type' => 'users',
        );

        $query = new Imageables();
        foreach ($parameters as $key => $value) {
            $query->$key = $value;
        }
        $query->save();

        if (!$query) {
            return false;
        }

        $return = array(
            'id' => $id,
            'images_old' => $images_old,
        );

        return $return;
    }
}
