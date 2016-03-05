<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'stock';
$query_builder = TRUE;

$_db['local'] = array(
    'dsn'   => 'mysql:host=127.0.0.1;port=3306;dbname=stock',
    'hostname' => '127.0.0.1',
    'username' => 'root',
    'password' => '1234asdf',
    'database' => 'stock',
    'dbdriver' => 'pdo',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => TRUE,
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
$db['stock'] = $_db['local'];
