<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 16-8-17
 * Time: 上午12:36
 */

// TODO : find a third parth library to do this
if (!function_exists("get_server_info")) {
    function get_server_info() {
        $host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] :
            (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
        $port = 80;

        $pos = strpos($host, ':');
        if ($pos !== false) {
            $port = substr($host, $pos + 1);
            $host = substr($host, 0, $pos);
        }

        // $host is '' when run script
        if ($host == '' || $host == 'localhost' || 0 === strpos($host, '192.168') || 0 === strpos($host, '127.0')) {
            $domain = "localhost";
            $url_base = "http://".$domain;
        }
        else {
            $pos = strpos($host, '.');
            if ($pos !== false) {
                $domain = substr($host, $pos + 1);
            }
            else {
                $domain = $host;
            }

            $url_base = "http://".$domain;
        }

        return compact("host", "port", "domain", "url_base");
    }
}
