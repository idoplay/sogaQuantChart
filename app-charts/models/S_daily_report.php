<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class S_daily_report extends Dao_model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_table_name()
    {
        return 's_daily_report';
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