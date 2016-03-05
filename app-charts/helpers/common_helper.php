<?php

function static_url($uri = '')
{
    $CI = & get_instance();
    if (defined('RELEASE_VERSION')) {
        return $CI->config->item('img_host') . RELEASE_VERSION . '/' . $uri;
    }
    $_lay_version = '';
    $_v_file = APPPATH.'../_version';
    if(file_exists($_v_file)){
        $_lay_version = trim(file_get_contents($_v_file));
    }
    $url = $CI->config->base_url('pages/'.$uri);
    return $url."?v=".$_lay_version;
}