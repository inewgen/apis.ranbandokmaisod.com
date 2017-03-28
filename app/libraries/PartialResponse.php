<?php

class PartialResponse
{

    public $debug = false;
    public $detectLang = true;
    public $lang = array('th' => 0, 'en' => 1);
    public $fields = array();

    public function make($fields = false)
    {
        if (!$fields) {
            $this->fields = false;

            return $this->fields;
        }

        $fields = strtolower($fields);
        $fields = preg_replace('/[^a-z0-9_\-\/\(\)\*\,\:]/s', '', $fields);

        try {
            if (Input::get('disable_detect_lang', false)) {
                $this->detectLang(false);
            }

            // should have cache this data
            //$this->checkFormat($fields); // turn off for optimize
            $this->fields = $this->setup($fields);
            // should have cache this data
            return $this->fields;
        } catch (Exception $e) {
            return array('errors' => array('message' => $e->getMessage(), 'code' => $e->getCode()));
        }
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function setDebug($bool = false)
    {
        $this->debug = $bool;
    }

    public function setLang($data)
    {
        $new = array();

        foreach ($data as $lang) {
            $new[$lang] = '';
        }

        $this->lang = $new;
    }

    public function setBenchmark($bool)
    {
        $this->benchmark = $bool;
    }

    public function detectLang($bool)
    {
        $this->detectLang = $bool;
    }

    public function render($data = array())
    {
        if (!$this->fields) {
            return $data;
        }

        $result = array();

        if (is_array($data)) {
            $keys = array_keys($data);
        } else {
            if (is_array($data)) {
                $keys = key($data);
            } else {
                $keys = false;
            }
        }

        if (isset($keys[0]) && is_string($keys[0])) {
            $result = $this->map($this->fields, $data);
        } else {
            foreach ($data as $v) {
                $result[] = $this->map($this->fields, $v);
            }
        }

        return $result;
    }

    public function isField($arr1 = false, $arr2 = false, $arr3 = false)
    {
        $fields = $this->fields;

        if ($arr3) {
            if ((!$fields or (isset($fields[$arr1]) && $fields[$arr1] === true) or (isset($fields[$arr1][$arr2]) && $fields[$arr1][$arr2] === true)) or isset($fields[$arr1][$arr2][$arr3])) {
                return true;
            }
        } elseif ($arr2) {
            if ((!$fields or (isset($fields[$arr1]) && $fields[$arr1] === true)) or isset($fields[$arr1][$arr2])) {
                return true;
            }
        } else {
            if ((!$fields or (isset($fields[$arr1])))) {
                return true;
            }
        }

        return false;
    }

    public function lang($arr1 = false, $arr2 = false, $arr3 = false, $arr4 = false)
    {
        $lang = false;
        $fields = $this->fields;

        if ($arr4) {
            if (isset($fields[$arr1][$arr2][$arr3][$arr4]) && is_array($fields[$arr1][$arr2][$arr3][$arr4])) {
                $lang = array_keys($fields[$arr1][$arr2][$arr3][$arr4]);
            }
        } elseif ($arr3) {
            if (isset($fields[$arr1][$arr2][$arr3]) && is_array($fields[$arr1][$arr2][$arr3])) {
                $lang = array_keys($fields[$arr1][$arr2][$arr3]);
            }
        } elseif ($arr2) {
            if (isset($fields[$arr1][$arr2]) && is_array($fields[$arr1][$arr2])) {
                $lang = array_keys($fields[$arr1][$arr2]);
            }
        } else {
            if (isset($fields[$arr1]) && is_array($fields[$arr1])) {
                $lang = array_keys($fields[$arr1]);
            }
        }

        if ($lang) {
            return array_flip($lang);
        } else {
            return $this->lang;
        }
    }

    public function lang_value($arr1 = false, $arr2 = false, $arr3 = false, $arr4 = false)
    {
        $lang = false;
        $fields = $this->fields;

        if ($arr4) {
            if (isset($fields[$arr1][$arr2][$arr3][$arr4]) && is_array($fields[$arr1][$arr2][$arr3][$arr4])) {
                $lang = array_keys($fields[$arr1][$arr2][$arr3][$arr4]);
            }
        } elseif ($arr3) {
            if (isset($fields[$arr1][$arr2][$arr3]) && is_array($fields[$arr1][$arr2][$arr3])) {
                $lang = array_keys($fields[$arr1][$arr2][$arr3]);
            }
        } elseif ($arr2) {
            if (isset($fields[$arr1][$arr2]) && is_array($fields[$arr1][$arr2])) {
                $lang = array_keys($fields[$arr1][$arr2]);
            }
        } else {
            if (isset($fields[$arr1]) && is_array($fields[$arr1])) {
                $lang = array_keys($fields[$arr1]);
            }
        }

        if ($lang) {
            return $lang;
        } else {
            return array_flip($this->lang);
        }
    }

    private function map($fields, $data)
    {
        $_result = array();

        if (is_array($fields)) {
            foreach ($fields as $k => $v) {
                if (isset($data[$k])) {
                    if (is_array($data[$k])) {
                        $keys = array_keys($data[$k]);
                    } else {
                        if (is_array($data)) {
                            $keys = key($data);
                        } else {
                            $keys = false;
                        }
                    }

                    if (isset($keys[0]) && is_string($keys[0])) {
                        // map seleted lang to parent node
                        if ($this->detectLang) {
                            if (isset($this->lang[$k])) {
                                return array('_lang_' => $data[$k]);
                            }
                        }

                        $_result[$k] = $this->map($v, (array) $data[$k], $_result);
                        if ($this->detectLang && isset($_result[$k]['_lang_'])) {
                            $_result[$k] = $_result[$k]['_lang_'];
                        }
                    } else {
                        foreach ($data[$k] as $k2 => $v2) {
                            if (is_array($v2)) {
                                $keys = array_keys($v2);
                            } else {
                                if (is_array($v2)) {
                                    $keys = key($v2);
                                } else {
                                    $keys = false;
                                }
                            }

                            if (isset($keys[0]) && is_string($keys[0])) {
                                $_result[$k][] = $this->map($v, (array) $v2);
                            } else {
                                $_result[$k] = array($this->map($v, (array) $v2));
                            }
                        }
                    }
                }

                if (isset($data[$k]) && $data[$k]) {
                    if ($v === true) {
                        $_result[$k] = $data[$k];
                    } elseif ($v == '*') {
                        $_result[$k] = $data[$k];
                    } elseif (is_string($v)) {
                        $_result[$k] = $data[$k];
                    }
                } else {
                    if (isset($data[$k])) {
                        $_result[$k] = $data[$k];
                    } else {
                        unset($_result[$k]);
                    }
                }

                if ($this->detectLang) {
                    if (isset($this->lang[$k]) && !isset($data[$k])) {
                        $_result = '';
                    }
                }
            }
        }

        return $_result;
    }

    private function checkFormat($fields)
    {
        if ($fields == '') {
            throw new Exception('fields is empty', 406);
        }

        if (preg_match('/([a-z]+)\/([a-z]+)\(/', $fields)) {
            throw new Exception('subselection not allowed in field sub selector', 406);
        }

        if (preg_match('/\)([a-z]+)/', $fields)) {
            throw new Exception('invalid format with comma (,)', 406);
        }

        if (preg_match('/\,\)/', $fields)) {
            throw new Exception('invalid format with comma (,)', 406);
        }

        if (preg_match('/\,\(/', $fields)) {
            throw new Exception('invalid format with comma (,)', 406);
        }

        if (preg_match('/\(\,/', $fields)) {
            throw new Exception('invalid format with comma (,)', 406);
        }

        if (preg_match('/\,,/', $fields)) {
            throw new Exception('cannot double with comma (,)', 406);
        }

        if (preg_match('/\/\//', $fields)) {
            throw new Exception('cannot double with slash (/)', 406);
        }

        if (preg_match('/\(\(/', $fields)) {
            throw new Exception('cannot double with open bracket (/)', 406);
        }
    }

    private function setup($fields, $result = array())
    {
        $result = $this->recusive($fields, $result);
        $reformat = $result['data'];

        // Algorithm Structure
        if ($this->debug) {
            echo '<br /> start ---------------- Algorithm Structure <br />';
            $this->debug($reformat);
            echo '<br /> end ---------------- Algorithm Structure <br />';
        }

        // Reformat Structure (new)
        foreach ($reformat as $k => $v) {
            if ($v['field'] == '') {
                $key_item = $this->findItem($reformat, $k - 1);

                if (is_array($key_item)) {
                    $_tmp = array();

                    foreach ($key_item as $pos) {
                        $_tmp[$pos] = $reformat[$pos];
                        unset($reformat[$pos]);
                    }

                    $key_not_item = $this->findNotItem($reformat, $pos - 1);

                    if (is_array($reformat[$key_not_item]['child'])) {
                        $key_items2 = $this->findItems($reformat, $key_not_item - 1);

                        if ($key_items2) {
                            $_pos = array_reverse($key_items2);
                            $key_not_item2 = $this->findNotItem($reformat, $_pos[0] - 1);

                            if (is_array($reformat[$key_not_item2]['child'])) {
                                unset($reformat[$k]);
                            } else {
                                $key_items2[] = $key_not_item;

                                foreach ($key_items2 as $pos) {
                                    $_tmp[$pos] = $reformat[$pos];
                                    unset($reformat[$pos]);
                                }

                                if (is_array($reformat[$key_not_item2]['child'])) {
                                    $reformat[$key_not_item2]['child'] = $reformat[$key_not_item2]['child'] + $_tmp;
                                } else {
                                    $reformat[$key_not_item2]['child'] = $_tmp;
                                }
                            }
                        } else {
                            // for item append to last sub-selection
                            $pos = $this->findNotItem($reformat, $key_not_item);
                            $key_not_item2 = $this->findNotItem($reformat, $pos - 1);
                            $_tmp[$pos] = $reformat[$pos];
                            unset($reformat[$pos]);

                            if (is_array($reformat[$key_not_item2]['child'])) {
                                $reformat[$key_not_item2]['child'] = $reformat[$key_not_item2]['child'] + $_tmp;
                            } else {
                                $reformat[$key_not_item2]['child'] = $_tmp;
                            }
                        }
                    } else {
                        $reformat[$key_not_item]['child'] = $_tmp;
                    }
                } else {
                    $key_not_item = $this->findNotItem($reformat, $k - 1);

                    if (is_array($reformat[$key_not_item]['child'])) {
                        $key_items2 = $this->findItems($reformat, $key_not_item - 1);

                        if ($key_items2) {
                            $_pos = array_reverse($key_items2);
                            $key_not_item2 = $this->findNotItem($reformat, $_pos[0] - 1);

                            if (is_array($reformat[$key_not_item2]['child'])) {
                                unset($reformat[$k]);
                            } else {
                                $key_items2[] = $key_not_item;
                                $_tmp = array();
                                foreach ($key_items2 as $pos) {
                                    $_tmp[$pos] = $reformat[$pos];
                                    unset($reformat[$pos]);
                                }

                                if (is_array($reformat[$key_not_item2]['child'])) {
                                    $reformat[$key_not_item2]['child'] = $reformat[$key_not_item2]['child'] + $_tmp;
                                } else {
                                    $reformat[$key_not_item2]['child'] = $_tmp;
                                }
                            }
                        }
                    }
                }

                unset($reformat[$k]);

                // check algorithm fields
                if ($this->debug) {
                    echo '<br/> ------------- start '.$key_not_item.' --------- start <br/>';
                    echo 'key item <br/>';
                    $this->debug($key_item);
                    echo 'key not item <br/>';
                    $this->debug($key_not_item);
                    $this->debug($reformat);
                    echo '<br/> ------------- end '.$key_not_item.' ------------- end <br/>';
                }
            }
        }

        // check algorithm fields
        if ($this->debug) {
            echo '<br /> start ---------------- reformat <br />';
            $this->debug($reformat);
            echo '<br /> end ---------------- reformat <br />';
        }

        // Lookup Structure
        $lookup = $this->lookup($reformat);
        unset($reformat);

        // check algorithm fields
        if ($this->debug) {
            echo '<br /> start ---------------- fields <br />';
            $this->debug($lookup);
            echo '<br /> end ---------------- fields <br />';
        }

        return $lookup;
    }

    private function lookup($result)
    {
        $_result = array();

        foreach ($result as $k => $v) {
            if (isset($v['child']) && is_array($v['child'])) {
                // Optimize Sort fields by client
                if (!$v['disable_child']) {
                    $v['child'] = array_reverse($v['child']);
                }

                $_result[$v['field']] = $this->lookup($v['child']);
            } else {

                if (strpos($v['field'], ',') !== false) {

                    $_field = explode(',', $v['field']);
                    $_field = array_flip($_field);
                } else {
                    $_field = array($v['field'] => true);
                }

                if (isset($_field)) {
                    foreach ($_field as $k => $v) {
                        if (strpos($k, '/') !== false) {
                            $_slash = explode('/', $k, 2);
                            if (isset($_result[$_slash[0]]) && is_array($_result[$_slash[0]])) {
                                $_result[$_slash[0]] = $_result[$_slash[0]] + $this->slashRecusive($_slash[1]);
                            } else {
                                $_result[$_slash[0]] = $this->slashRecusive($_slash[1]);
                            }
                        } elseif (strpos($k, ':') !== false) {
                            $_collon = explode(':', $k);
                            $_result[$_collon[0]][$_collon[1]] = true;
                        } elseif (strpos($k, '*') !== false) {
                            return "*";
                        } else {
                            $_result[$k] = true;
                        }
                    }
                }
            }
        }

        return $_result;
    }

    private function findItem($result, $position, $_keys = array())
    {
        if ($position < 0) {
            return false;
        }

        if (!isset($result[$position])) {
            return $this->findItems($result, --$position, $_keys);
        }

        if (isset($result[$position]['item']) && $result[$position]['item']) {
            $_keys[] = $position;
        }

        $count = count($_keys);

        if ($count == 0) {
            $_keys = false;
        }

        return $_keys;
    }

    private function findItems($result, $position, $_keys = array())
    {
        if ($position < 0) {
            return false;
        }

        if (!isset($result[$position])) {
            return $this->findItems($result, --$position, $_keys);
        }

        if (isset($result[$position]['item']) && $result[$position]['item']) {
            $_keys[] = $position;

            return $this->findItems($result, --$position, $_keys);
        }

        if (isset($result[$position]['child']) && is_array($result[$position]['child'])) {
            $_keys[] = $position;

            return $this->findItems($result, --$position, $_keys);
        }

        $count = count($_keys);

        if ($count == 0) {
            $_keys = false;
        }

        return $_keys;
    }

    private function findNotItem($result, $position)
    {
        if ($position < 0) {
            return false;
        }

        if (!isset($result[$position])) {
            return $this->findNotItem($result, --$position);
        }

        if (isset($result[$position]['item']) && $result[$position]['item']) {
            return $this->findNotItem($result, --$position);
        }

        return $position;
    }

    private function findEnd($result, $position, $put = array())
    {
        if (!isset($result[$position])) {
            return $this->findEnd($result, --$position, $put);
        } else {
            if (isset($result[$position]['child']) && $result[$position]['child'] !== false) {
                $put[] = $position;

                return $this->findEnd($result, --$position, $put);
            }

            // used with skip disable child for merge
            if (isset($result[$position]['disable_child']) && $result[$position]['disable_child'] !== false) {
                $put[] = $position;

                return $this->findEnd($result, --$position, $put);
            }
        }

        return array('put' => $put, 'position' => $position);
    }

    private function recusive($fields, $new_result = array(), $open_bracket = 0, $close_bracket = 0, $level = 0, $end_bracket = false)
    {
        $pos = strpos($fields, '(');
        $_column = substr($fields, 0, $pos);

        $check_slash = strpos($fields, '/');
        $check_collon = strpos($fields, ':');
        $check_comma = strpos($fields, ',');
        $check_close_bracket = strpos($fields, ')');
        $node_item = false;
        $node_child = false;
        $disable_child = false;
        $recusive_for_close_bracket = false;

        $level++;

        if ($check_close_bracket !== false && $check_close_bracket < $pos) {
            $_column2 = substr($_column, $check_close_bracket);
            $_column = str_replace($_column2, '', $_column);
            $fields = $_column2 . $fields;
            $close_bracket++;
            $node_item = true;
            $recusive_for_close_bracket = true;
        } elseif ($check_close_bracket !== false && $pos === false) {
            $_column2 = substr($_column, $check_close_bracket);
            $_column = substr($fields, 0, $check_close_bracket);
            $fields = substr($fields, $check_close_bracket);
            $close_bracket++;
            $node_item = true;
            $recusive_for_close_bracket = true;
        } elseif ($check_slash !== false && $check_slash < $pos) {
            $check_slash2 = strpos($fields, ',');
            if ($check_slash2 === false) {
                $check_slash2 = strpos($fields, ')');
            }
            $_column2 = substr($_column, $check_slash2);
            $_column = str_replace($_column2, '', $_column);
            $fields = $_column2 . $fields;
            $node_item = true;
        } elseif ($check_collon !== false && $check_collon < $pos) {
            $check_collon2 = strpos($fields, ',');
            if ($check_collon2 === false) {
                $check_collon2 = strpos($fields, ')');
            }
            $_column2 = substr($_column, $check_collon2);
            $_column = str_replace($_column2, '', $_column);
            $fields = $_column2 . $fields;
            $disable_child = true;

            if ($open_bracket > 0) {
                $node_item = true;
                $disable_child = false;
            }
        } elseif ($check_comma !== false && $check_comma < $pos) {
            $check_comma2 = strpos($fields, ',');
            if ($check_comma2 === false) {
                $check_comma2 = strpos($fields, ')');
            }
            $_column2 = substr($_column, $check_comma2);
            $_column = str_replace($_column2, '', $_column);
            $fields = $_column2 . $fields;
            $disable_child = true;
            $node_item = true;
        } else {
            if ($pos !== false) {
                $open_bracket++;
            } else {
                $pos_comma = strpos($fields, ',');
                if ($pos_comma !== false) {
                    $_column = substr($fields, 0, $pos_comma);
                    $fields = substr($fields, $pos_comma);
                    $disable_child = true;
                } else {
                    $_column = $fields;
                    $fields = null;
                    $disable_child = true;
                }
            }
        }

        $fields = trim(substr($fields, $pos + 1), ',');

        // check algorithm
        if ($this->debug) {
            echo $open_bracket . '/' . $close_bracket . ' # <span style="display:inline-block;width:25px;">' . $pos . '</span> # <span style="display:inline-block;width:200px;">' . $_column . '</span> # ' . $fields . '<br />';
        }

        $new_result['data'][$level]['field'] = $_column;
        $new_result['data'][$level]['child'] = $node_child;
        $new_result['data'][$level]['item'] = $node_item;
        $new_result['data'][$level]['open_bracket'] = $open_bracket;
        $new_result['data'][$level]['close_bracket'] = $close_bracket;
        $new_result['data'][$level]['disable_child'] = $disable_child;

        // add recusive of end of bracket for mutiple fields of node
        if ($recusive_for_close_bracket) {
            $new_result = $this->recusive('', $new_result, $open_bracket, $close_bracket, $level, true);
            $level++;
        }

        if ($end_bracket) {
            $new_result['data'][$level]['child'] = true;
            if ($open_bracket == $close_bracket) {
                $new_result['data'][$level]['child'] = false;
            }
        }

        if ($open_bracket == $close_bracket) {
            $open_bracket = 0;
            $close_bracket = 0;
        }

        if ($fields) {
            return $this->recusive($fields, $new_result, $open_bracket, $close_bracket, $level);
        }

        return $new_result;
    }

    private function slashRecusive($_slash, $_result = array(), $init = true)
    {
        if ($init) {
            $_slash = explode('/', $_slash);
        } else {
            array_shift($_slash);
        }

        if (count($_slash) == 0) {
            return true;
        }

        foreach ($_slash as $v) {
            $_result[$v] = $this->slashRecusive($_slash, $_result, false);
            break;
        }

        return $_result;
    }

    private function debug($data)
    {
        //header('Content-Type: text/plain');
        echo'<pre>';
        print_r($data);
        echo'</pre>';
        //exit();
    }
}
