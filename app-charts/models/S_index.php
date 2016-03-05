<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class S_index extends Dao_model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_table_name()
    {
        return 's_index';
    }
    public function get_table_pk()
    {
        return 'id';
    }
    public function get_read_pdo_name()
    {
        return 'stock';
    }

    public function get_write_pdo_name()
    {
        return 'stock';
    }
}