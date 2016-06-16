<?php

/*
|--------------------------------------------------------------------------
| 复写官方函数
|--------------------------------------------------------------------------
|
| 官方函数库路径
| Illuminate/Support/helpers.php
|
*/

if(! function_exists('get_ip')){
    /**
     * Get real IP.
     *
     * @param  string  $data
     * @return string json
     */
    function getIp($data = false)
    {
        $str = json_decode($this->httpRequest('http://test.ip138.com/query/'), true);
        return $data===false ? $str['ip'] : $str;
    }
}

if(! function_exists('is_mobile')){
    /**
     * 验证手机号是否正确
     * @author donghaichen
     * @param INT $mobile
     * 移动：134、135、136、137、138、139、150、151、152、157、158、159、182、183、184、187、188、178(4G)、147(上网卡)；
     * 联通：130、131、132、155、156、185、186、176(4G)、145(上网卡)；
     * 电信：133、153、180、181、189 、177(4G)；
     * 卫星通信：1349
     * 虚拟运营商：170
     */
    function is_mobile($mobile)
    {
        if (!is_numeric($mobile)) {
            return false;
        }
        return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#',
            $mobile) ? true : false;
    }
}

if(! function_exists('hide_str')){
    /**
     * hide str
     */
    function hide_str($type,$str,$auth=false)
    {
        switch($type)
        {
            case 'mobile';
                return $auth ? substr_replace($str, '****', 3, 4) : substr_replace($mobile, '*******', -7);
                break;
            case 'idCard';
                return strlen($str)==18?substr_replace($str,
                    '**************', 0, 14) : substr_replace($str, '***********', 0, 11);
                break;
            case 'name';
                return '*' . mb_substr($str, 1, 3, 'utf-8');
                break;
            case 'bankcard';
                return '**** **** ****' . substr($str, -4);
                break;
        }
    }
}

if(! function_exists('http_request')){
    //HTTP请求（支持HTTP/HTTPS，支持GET/POST）
    function httpRequest($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, TRUE);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}
if(! function_exists('is_idcard')){
    function isIdCard($idCard)
    {
        if (!eregi("^[1-9]([0-9a-zA-Z]{17}|[0-9a-zA-Z]{14})$", $idCard)) {
            $flag = 0;
        } else {
            if (strlen($idCard) == 18) {
                $tyear = intval(substr($idCard, 6, 4));
                $tmonth = intval(substr($idCard, 10, 2));
                $tday = intval(substr($idCard, 12, 2));
                if ($tyear > date("Y") || $tyear < (date("Y") - 100)) {
                    $flag = 0;
                }
                elseif ($tmonth < 0 || $tmonth > 12) {
                    $flag = 0;
                }
                elseif ($tday < 0 || $tday > 31) {
                    $flag = 0;
                } else {
                    if ((time() - mktime(0, 0, 0, $tmonth, $tday, $tyear)) < 18 * 365 * 24 * 60 * 60) {
                        $flag = 0;
                    } else {
                        $flag = 1;
                    }
                }

            }
            elseif (strlen($idCard) == 15) {
                $tyear = intval("19" . substr($idCard, 6, 2));
                $tmonth = intval(substr($idCard, 8, 2));
                $tday = intval(substr($idCard, 10, 2));
                if ($tyear > date("Y") || $tyear < (date("Y") - 100)) {
                    $flag = 0;
                }
                elseif ($tmonth < 0 || $tmonth > 12) {
                    $flag = 0;
                }
                elseif ($tday < 0 || $tday > 31) {
                    $flag = 0;
                } else {
                    $tdate = $tyear . "-" . $tmonth . "-" . $tday . " 00:00:00";
                    if ((time() - mktime(0, 0, 0, $tmonth, $tday, $tyear)) < 18 * 365 * 24 * 60 * 60) {
                        $flag = 0;
                    } else {
                        $flag = 1;
                    }
                }
            }
        }
        return $flag == 1 ? true : false ;
    }
}

if (! function_exists('route')) {
    /**
     * Generate a URL to a named route.
     *
     * @param  string  $route
     * @param  string  $parameters
     * @return string
     */
    function route($route, $parameters = array())
    {
        if (Route::getRoutes()->hasNamedRoute($route))
            return app('url')->route($route, $parameters);
        else
            return 'javascript:void(0)';
    }
}

if (! function_exists('link_to_route')) {
    /**
     * Generate a HTML link to a named route.
     *
     * @param  string  $name
     * @param  string  $title
     * @param  array   $parameters
     * @param  array   $attributes
     * @return string
     */
    function link_to_route($name, $title = null, $parameters = array(), $attributes = array())
    {
        if (Route::getRoutes()->hasNamedRoute($name))
            return app('html')->linkRoute($name, $title, $parameters, $attributes);
        else
            return '<a href="javascript:void(0)"'.HTML::attributes($attributes).'>'.$name.'</a>';
    }
}


/*
|--------------------------------------------------------------------------
| 延伸自拓展配置文件
|--------------------------------------------------------------------------
|
*/

if (! function_exists('style')) {
    /**
     * 样式别名加载（支持批量加载，后期可拓展为自动多文件压缩合并）
     * @param  dynamic  mixed  配置文件中的别名
     * @return string
     */
    function style()
    {
        $cssAliases = Config::get('extend.cssAliases');
        $styleArray = array_map(function ($aliases) use ($cssAliases) {
            if (isset($cssAliases[$aliases]))
                return HTML::style($cssAliases[$aliases]);
        }, func_get_args());
        return implode('', array_filter($styleArray));
    }
}

if (! function_exists('script')) {
    /**
     * 脚本别名加载（支持批量加载，后期可拓展为自动多文件压缩合并）
     * @param  dynamic  mixed  配置文件中的别名
     * @return string
     */
    function script()
    {
        $jsAliases   = Config::get('extend.jsAliases');
        $scriptArray = array_map(function ($aliases) use ($jsAliases) {
            if (isset($jsAliases[$aliases]))
                return HTML::script($jsAliases[$aliases]);
        }, func_get_args());
        return implode('', array_filter($scriptArray));
    }
}


/*
|--------------------------------------------------------------------------
| 自定义核心函数
|--------------------------------------------------------------------------
|
*/

if (! function_exists('l')) {
    /**
     * 辅助调试函数
     * @param  dynamic  mixed
     * @return void
     */
    function l()
    {
        // 被调用记录
        $backtrace = debug_backtrace();
        $content   = $_SERVER['REQUEST_URI'].PHP_EOL;
        $content  .= '  断点位置 => '.$backtrace[0]['file'].':'.$backtrace[0]['line'].PHP_EOL;
        $content  .= '  调试内容 => '.var_export($backtrace[0]['args'], true).PHP_EOL;
        // 写入日志
        Log::debug($content);
    }
}

if (! function_exists('log_sql')) {
    /**
     * 将 SQL 执行记录写入调试日志
     * @return void
     */
    function log_sql()
    {
        $sqlList = DB::getQueryLog();
        $sqlLog  = '';
        foreach ($sqlList as $sql) {
            foreach (explode('?', $sql['query']) as $key => $value) {
                $sqlLog .= isset($sql['bindings'][$key])
                    ? $value.$sql['bindings'][$key]
                    : $value;
            }
            $sqlLog .= PHP_EOL.PHP_EOL;
        }
        // 被调用记录
        $backtrace = debug_backtrace();
        $content   = $_SERVER['REQUEST_URI'].PHP_EOL.PHP_EOL;
        $content  .= '断点位置 => '.$backtrace[0]['file'].':'.$backtrace[0]['line'].PHP_EOL.PHP_EOL;
        // 写入日志
        Log::debug($content.$sqlLog);
    }
}

if (! function_exists('define_array')) {
    /**
     * 批量定义常量
     * @param  array  $define 常量和值的数组
     * @return void
     */
    function define_array($define = array())
    {
        foreach ($define as $key => $value)
            defined($key) OR define($key, $value);
    }
}

if (! function_exists('friendly_date')) {
    /**
     * 友好的日期输出
     * @param  string|\Carbon\Carbon $theDate 待处理的时间字符串 | \Carbon\Carbon 实例
     * @return string                         友好的时间字符串
     */
    function friendly_date($theDate)
    {
        // 获取待处理的日期对象
        if (! $theDate instanceof \Carbon\Carbon)
            $theDate = \Carbon\Carbon::createFromTimestamp(strtotime($theDate));
        // 取得英文日期描述
        $friendlyDateString = $theDate->diffForHumans(\Carbon\Carbon::now());
        // 本地化
        $friendlyDateArray  = explode(' ', $friendlyDateString);
        $friendlyDateString = $friendlyDateArray[0]
            .Lang::get('friendlyDate.'.$friendlyDateArray[1])
            .Lang::get('friendlyDate.'.$friendlyDateArray[2]);
        // 数据返回
        return $friendlyDateString;
    }
}

if (! function_exists('pagination')) {
    /**
     * 拓展分页输出，支持临时指定分页模板
     * @param  Illuminate\Pagination\Paginator $paginator 分页查询结果的最终实例
     * @param  string                          $viewName  分页视图名称
     * @return \Illuminate\View\View
     */
    function pagination(Illuminate\Pagination\Paginator $paginator, $viewName = null)
    {
        $viewName = $viewName ?: Config::get('view.pagination');
        $paginator->getEnvironment()->setViewName($viewName);
        return $paginator->links();
    }
}


if (! function_exists('strip')) {
    /**
     * 反引用一个经过 e（htmlentities）和 addslashes 处理的字符串
     * @param  string $string 待处理的字符串
     * @return 转义后的字符串
     */
    function strip($string)
    {
        return stripslashes(HTML::decode($string));
    }
}


/*
|--------------------------------------------------------------------------
| 公共函数库
|--------------------------------------------------------------------------
|
*/

if (! function_exists('close_tags')) {
    /**
     * 闭合 HTML 标签 （此函数仍存在缺陷，无法处理不完整的标签，暂无更优方案，慎用）
     * @param  string $html HTML 字符串
     * @return string
     */
    function close_tags($html)
    {
        // 不需要补全的标签
        $singleTags = array('meta', 'img', 'br', 'link', 'area');
        // 匹配开始标签
        preg_match_all('#<([a-z1-6]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $openedTags = array_filter(array_reverse($result[1]), function ($tag) use ($singleTags) {
            if (! in_array($tag, $singleTags)) return $tag;
        });
        // 匹配关闭标签
        preg_match_all('#</([a-z]+)>#iU', $html, $result);
        $closedTags = $result[1];
        // 开始补全
        foreach ($openedTags as $value) {
            if (in_array($value, $closedTags)) {
                unset($closedTags[array_search($value, $closedTags)]);
            } else {
                $html .= '</'.$value.'>';
            }
        }
        return $html;
    }
}

if (! function_exists('order_by')) {
    /**
     * 用于资源列表的排序标签
     * @param  string $columnName 列名
     * @param  string $default    是否默认排序列，up 默认升序 down 默认降序
     * @return string             a 标签排序图标
     */
    function order_by($columnName = '', $default = null)
    {
        $sortColumnName = Input::get('sort_up', Input::get('sort_down', false));
        if (Input::get('sort_up')) {
            $except = 'sort_up'; $orderType = 'sort_down';
        } else {
            $except = 'sort_down' ; $orderType = 'sort_up';
        }
        if ($sortColumnName == $columnName) {
            $parameters = array_merge(Input::except($except), array($orderType => $columnName));
            $icon       = Input::get('sort_up') ? 'chevron-up' : 'chevron-down' ;
        } elseif ($sortColumnName === false && $default == 'asc') {
            $parameters = array_merge(Input::all(), array('sort_down' => $columnName));
            $icon       = 'chevron-up';
        } elseif ($sortColumnName === false && $default == 'desc') {
            $parameters = array_merge(Input::all(), array('sort_up' => $columnName));
            $icon       = 'chevron-down';
        } else {
            $parameters = array_merge(Input::except($except), array('sort_up' => $columnName));
            $icon       = 'random';
        }
        $a  = '<a href="';
        $a .= action(Route::current()->getActionName(), $parameters);
        $a .= '" class="glyphicon glyphicon-'.$icon.'"></a>';
        return $a;
    }
}