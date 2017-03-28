<?php

class ApiController extends Controller
{
    protected $setting;
    protected $quota;
    protected $bench;

    /**
     * [__construct description]
     */
    public function __construct()
    {
        // default construct
        $input = Input::all();

        $store_id = array_get($input, 'store_id');

        date_default_timezone_set('Asia/Bangkok');
        App::setLocale('en');

        // check debug for return to client
        if (isset($input['debug']) && $input['debug']) {
            header('HTTP/1.1 500 Internal Server Error');
            Config::set('cache.driver', 'array');
        }
    }

    public function benchmark()
    {
        $benchmark = 'false';

        if (Input::get('bench') == 1) {
            $before_core = false;
            if (defined('LARAVEL_START')) {
                $before_core = $this->bench->start_time['core'] - LARAVEL_START;
            }

            $benchmark = array(
                'elapsed_time' => array(
                    'before_core' => $before_core,
                    'core' => $this->bench->getTime('core', true),
                    'partial_response' => $this->bench->getTime('partial_response', true),
                    'validator' => $this->bench->getTime('validator', true),
                    'orm' => $this->bench->getTime('orm', true),
                    'orm2' => $this->bench->getTime('orm2', true),
                    'orm3' => $this->bench->getTime('orm3', true),
                    'loop_from_orm' => $this->bench->getTime('loop_from_orm', true),
                    'partial_response_render' => $this->bench->getTime('partial_response_render', true),
                ),
                'memory_peak' => $this->bench->getMemoryPeak(),
                'query_count' => count(DB::getQueryLog()),
            );

            if (defined('LARAVEL_START')) {
                $elapsed = microtime(true) - LARAVEL_START;
                $benchmark['elapsed_time']['total'] = $elapsed;
            }

            // show query logs
            if (Input::get('query_logs')) {
                $benchmark['query_logs']=DB::getQueryLog();
            }
        }

        return $benchmark;
    }

    public function makePagination()
    {
        $view    = Config::get('view');
        $perpage = Input::get('perpage');
        $take    = (int) (isset($perpage)) ? $perpage : $view['perpage'];
        $take    = $take == 0 ? $view['perpage'] : $take;
        $take    = $take > $view['perpage_max'] ? $view['perpage_max'] : $take;
        $page    = (Input::get('page') > 0) ? Input::get('page') : 1;
        $skip    = ($page - 1) * $take;

        $page = array(
            'perpage' => $perpage,
            'page'    => $page,
            'take'    => $take,
            'skip'    => $skip
        );

        return (object) $page;
    }
}
