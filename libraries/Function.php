<?php

    function _debug($data)
    {
        echo '<pre style="background: #000; color: #fff; width: 100%; overflow: auto">';
        echo '<div>Your IP: ' . $_SERVER['REMOTE_ADDR'] . '</div>';

        $debug_backtrace = debug_backtrace();
        $debug = array_shift($debug_backtrace);

        echo '<div>File: ' . $debug['file'] . '</div>';
        echo '<div>Line: ' . $debug['line'] . '</div>';

        if(is_array($data) || is_object($data)) {
            print_r($data);
        }
        else {
            var_dump($data);
        }
        echo '</pre>';
    }

    function getInput($string)
    {
        return isset($_GET[$string]) ? $_GET[$string] : '';
    }

    function postInput($string)
    {
        return isset($_POST[$string]) ? $_POST[$string] : '';
    }

    function base_url()
    {
        return $url = "http://localhost/cnweb/";
    }

    function public_admin()
    {
        return base_url() . "public/admin/";
    }

    function public_frontend()
    {
        return base_url() . "public/frontend/";
    }

    function modules($url)
    {
        return base_url() . "admin/modules/" . $url;
    }

    function uploads()
    {
        return base_url() . "public/uploads";
    }

    if (! function_exists('redirectAdmin'))
    {
        function redirectAdmin($url = "")
        {
            header("location: ".base_url()."admin/modules/{$url}");exit();
        }
    }
    
    if (! function_exists('redirect'))
    {
        function redirect($url = "")
        {
            header("location: ".base_url().$url);exit();
        }
    }

    function to_slug($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(á|à|ạ|ả|ã|â|ấ|ầ|ậ|ẩ|ẫ|ă|ắ|ằ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ)/', 'e', $str);
        $str = preg_replace('/(í|ì|ỉ|ĩ|ị)/', 'i', $str);
        $str = preg_replace('/(ó|ò|ọ|ỏ|õ|ô|ố|ồ|ộ|ổ|ỗ|ơ|ớ|ờ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ú|ù|ụ|ủ|ũ|ư|ứ|ừ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ý|ỳ|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }

    if (! function_exists('xss_clean')) {
        function xss_clean($data)
        {
            $data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&lt;lt;', '&gt;gt;'), $data);
            $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
            $data = preg_replace('/(&#x*[0-9A-F]+);/iu', '$1;', $data);
            $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

            $data = preg_replace('#(<[^>]+?[\x00-\x20]"\')(?:on|xmlns)[^>]*+>#iu', '$1;', $data);

            $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
            $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
            $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

            $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
            $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
            $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

            $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

            do {
                $old_data = $data;
                $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
            } while ($old_data !== $data);

            return $data;
        }
    }

    if ( ! function_exists('formatPrice'))
    {
        function formatPrice($price)
        {
            return number_format($price, 0,',','.');
        }
    }
    // if ( ! function_exists('formatPricesale'))
    // {
    //     function money($price , $sale)
    //     {
    //         $price = ((100 - $sale)*$price)/100;
    //         return number_format($price, 0,',','.');
    //     }
    // }

?>