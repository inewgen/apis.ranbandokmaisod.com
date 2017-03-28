<?php

class NavigationsController extends ApiController
{

    public function __construct(NavigationsRepositoryInterface $navigationsRepository)
    {
        parent::__construct();
        $this->navigationsRepository = $navigationsRepository;
        $this->pathcache             = 'api.0.navigations';
    }

    public function index()
    {
        $data = Input::all();

        // Validator request
        $rules = array(
            'user_id' => 'required|integer|min:1',
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

        $parameters = $data;
        $results = $this->navigationsRepository->lists($parameters);

        if (!$results) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        $response = array(
            'cached' => false,
            'record' => $results,
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
        $query = Navigations::filters($filters)->get();
        $results = json_decode($query, true);

        if (!$results) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        $response = array(
            'cached' => false,
            'record' => array_get($results, '0', '')
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
            'title'     => 'required|min:1',
            'position'  => 'required|integer|min:1',
            'url'       => 'required|min:1',
            'status'    => 'required|min:1|in:true,false',
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
            'title'     => $data['title'],
            'position'  => $data['position'],
            'url'       => $data['url'],
            'status'    => ($data['status']=='false'?'0':'1'),
        );

        $results = $this->navigationsRepository->create($parameters);

        if (!$results) {
            $response = array();

            return API::createResponse($response, 1001);
        }

        $response = array(
            'record' => $results,
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
            'id'        => 'required|integer|min:1',
            'user_id' => 'required|integer|min:1',
            'title'     => 'required|min:1',
            'position'  => 'required|integer|min:1',
            'url'       => 'required|min:1',
            'status'    => 'required|min:1|in:true,false',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $parameters = array(
            'id'        => $data['id'],
            'user_id' => $data['user_id'],
            'title'     => $data['title'],
            'position'  => $data['position'],
            'url'       => $data['url'],
            'status'    => ($data['status']=='false'?'0':'1'),
        );

        $results = $this->navigationsRepository->update($parameters);

        if (!$results) {
            $response = array();

            return API::createResponse($response, 1001);
        }

        $response = array(
            'record' => $results,
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

        $parameters = array(
            'id'    => $data['id']
        );

        $results = $this->navigationsRepository->destroy($parameters);

        if (!$results) {
            $response = array();

            return API::createResponse($response, 1001);
        }

        $response = array(
            'record' => $results,
        );

        // Clear cache value
        clearCacheDestroy($this->pathcache, $id);

        return API::createResponse($response, 0);
    }
}
