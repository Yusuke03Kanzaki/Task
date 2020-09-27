<?php

class Request
{
    /**
     * リクエストメソッドがPOSTかどうか判定
     *
     * @return boolean
     */
    public function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        }

        return false;
    }

    /**
     * GETパラメータを取得
     *
     * @param string $name
     * @param mixed $default 指定したキーが存在しない場合のデフォルト値
     * @return mixed
     */
    public function getGet($name, $default = null)
    {
        if (isset($_GET[$name])) {
            return $_GET[$name];
        }

        return $default;
    }

    /**
     * POSTパラメータを取得
     *
     * @param string $name
     * @param mixed $default 指定したキーが存在しない場合のデフォルト値
     * @return mixed
     */
    public function getPost($name, $default = null)
    {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }

        return $default;
    }

    /**
     * ホスト名を取得
     *
     * @return string
     */
    public function getHost()
    {
        if (!empty($_SERVER['HTTP_HOST'])) {
            return $_SERVER['HTTP_HOST'];
        }
        
        return $_SERVER['SERVER_NAME'];
    }

    /**
     * SSLでアクセスされたかどうか判定
     *
     * @return boolean
     */
    public function isSsl()
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            return true;
        }
        return false;
    }

    /**
     * リクエストURIを取得
     *
     * @return string
     */
    public function getRequestUri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * ベースURLを取得
     *
     * @return string
     */
    public function getBaseUrl()
    {
        $script_name = $_SERVER['SCRIPT_NAME'];
        // var_dump($script_name);

        $request_uri = $this->getRequestUri();
        // var_dump($request_uri);
        // var_dump(dirname($script_name));
        if (0 === strpos($request_uri, $script_name)) {
            return $script_name;
        } else if (0 === strpos($request_uri, dirname($script_name))) {
            // var_dump(rtrim(dirname($script_name), '/'));
            return rtrim(dirname($script_name), '/');
        }

        return '';
    }

    /**
     * PATH_INFOを取得
     *
     * @return string
     */
    public function getPathInfo()
    {
        $base_url = $this->getBaseUrl();
        // var_dump($base_url);
        $request_uri = $this->getRequestUri();
        // var_dump($request_uri);

        // var_dump($pos = strpos($request_uri, 'i'));
        if (false !== ($pos = strpos($request_uri, '?'))) {
            $request_uri = substr($request_uri, 0, $pos);
            // var_dump($request_uri);
        }

        // var_dump(strlen($base_url));
        // var_dump(strlen($request_uri));

        $path_info = (string)substr($request_uri, strlen($base_url));
        // var_dump($path_info);

        return $path_info;
    }
}
