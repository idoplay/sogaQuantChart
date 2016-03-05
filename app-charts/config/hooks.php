<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
$hook['pre_controller'][] = array(
    'class'    => 'ClientFilter',
    'function' => 'init',
    'filename' => 'ClientFilter.php',
    'filepath' => 'hooks',
    'params'   => array()
);
*/
$hook['post_controller_constructor'][] = array(
    'class'    => 'Debugger',
    'function' => 'set_debug',
    'filename' => 'Debugger.php',
    'filepath' => 'hooks',
    'params'   => array()
);

$hook['post_controller'] = array(
    'class'    => 'CacheControl',
    'function' => 'init',
    'filename' => 'CacheControl.php',
    'filepath' => 'hooks',
    'params'   => array()
);