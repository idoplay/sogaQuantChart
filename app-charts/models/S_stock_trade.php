<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class S_stock_trade extends Dao_model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_table_name()
    {
        return 's_stock_trade';
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