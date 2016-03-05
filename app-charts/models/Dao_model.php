<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Dao_model extends CI_Model
{

    public $read_from_master = true;
    const NONE_TABLE_PK = "nonepk";

    public function __construct()
    {
        parent::__construct();
    }

    public function find_by_id($id)
    {
        return $this->_fetch_row(array($this->get_table_pk() => $id));
    }

    public function find_by_ids($id_array=array())
    {
        if (empty($id_array) || !is_array($id_array)) {
            return array();
        }

        $id_array = $this->format_id_array($id_array);
        $pk = $this->get_table_pk();
        $where[$pk] = $id_array;
        $query = $this->_fetch_all($where,null,count($id_array));
        $res = array();
        foreach ($query as $val) {
            $res[$val[$pk]] = $val;
        }
        return $res;
    }

    public function find($where = array(), $order = null, $limit = 100, $offset = 0)
    {
        $res = $this->_fetch_all($where,$order,$limit,$offset);
        return $res;
    }
     //查找指定条件的行数(包含去重复计数)
    public function find_count ($where = array(), $field = '') {
        $db = $this->get_db();
        if ($where) {
            $this->_set_where($where,$db);
        }
        return $db->count_all_results($this->get_table_name());
    }
    //得到指定字段的总合 SUM
    public function find_sum($feild,$where = array()){
         //TODO
    }

    //查找一行记录
    public function find_row($where = array(), $order = null) {
        $res = $this->_fetch_row($where,$order);
        return $res;
    }
    //返回的结果以主键作为key
    public function find_assoc($where = array(), $order = null, $limit = 100, $offset = 0) {
        $query = $this->find($where,$order,$limit,$offset);
        if (empty($query)) {
            return array();
        }
        $pk = $this->get_table_pk();
        $res = array();
        foreach ($query as $val) {
            $res[$val[$pk]] = $val;
        }
        return $res;
    }

    public function find_by_sql($sql='',$params=array()){
        $sql = trim($sql);
        if (empty($sql)) {
            return false;
        }
        //cache
        $res = $this->execute($sql,$params);
        return $res;
    }
    protected function _fetch_all($where = array(), $order = null, $limit = 100, $offset = 0,$select='*'){
        $db = $this->get_db();

        $table = $this->get_table_name();
        //TODO
        $this->_set_where($where,$db);
        if ($order) {
            $db->order_by($order);
        }
        if ($select != '*') {
            $db->select($select);
        }
        if ($limit > 0) {
            $db->limit($limit, $offset);
        }
        //echo $db->get_compiled_select($table);
        $res = $db->get($table)->result_array();
        return $res;
    }
    protected function build_where ($where) {
        $_where = array('where' => '', 'params' => array());
        if (empty($where)) {
            return $_where;
        }
        if (is_array($where) && count($where)) {
            foreach ($where as $key => $value) {
                if (preg_match("/\?/", $key)) {
                    $_where['field'][] = '(' . $key . ')';
                } else {
                    $_where['field'][] = '(`' . $key . '` = ?)';
                }
                $_where['params'][] = self::escape_value($value);
            }
            $_where['where']=' WHERE ' . implode(' AND ',$_where['field']);
        }else{
            $_where['where']=' WHERE ' . $where;
        }
        return $_where;
    }
    //TODO这里先不兼容like
    protected function _set_where($where,$db=null)
    {
        if(is_null($db)){return false;}
        if (is_array($where)) {
            foreach ($where as $key => $value) {
                if ($key == 'findinset') {
                    $db->where("1", "1 AND FIND_IN_SET($where)", FALSE);
                    continue;
                }
                if (is_array($value)) {
                    $db->where_in($key, $value);
                } else {
                    $db->where($key, $value);
                }
            }
        } else {
            $db->where($where);
        }
    }
    protected function _fetch_row ($where = array(), $order = null) {
        $rows = (array)$this->_fetch_all($where, $order, 1, 0);
        $res = array_pop($rows);
        if ($res === null) {
            $res = array();
        }
        return $res;
    }

    public function insert($data=array())
    {
        if (empty($data)) {
            return false;
        }
        $db = $this->get_db(true);
        $db->insert($this->get_table_name(), $data);
        return $db->insert_id();
    }

    public function batch_insert($data=array())
    {
        if (empty($data)) {
            return false;
        }
        $db = $this->get_db(true);
        $db->insert_batch($this->get_table_name(), $data);
        $count = $db->affected_rows();
        return $count;
    }

    public function update($data = array(),$where = array(),$status=FALSE)
    {
        return $this->_update($data,$where,$status);
    }

    public function update_by_id($id,$data,$status = FALSE)
    {
        return $this->_update($data,array($this->get_table_pk()=>$id),$status);
    }

    public function remove($where)
    {
        $db = $this->get_db(true);

        $this->_set_where($where,$db);

        $db->delete($this->get_table_name());
        return $db->affected_rows();
    }

    public function remove_by_id($id)
    {
        if ($this->get_table_pk() == self::NONE_TABLE_PK) {
            return false;
        }
        if (empty($id)) {
            return false;
        }
        return $this->remove(array($this->get_table_pk()=>$id));

    }
    public function remove_by_ids($ids){
        if ($this->get_table_pk() == self::NONE_TABLE_PK) {
            return false;
        }
        if (empty($ids)) {
            return false;
        }
        if (!is_array($ids)) {
            $ids = array($ids);
        }
        $ids = $this->format_id_array($ids);
        if(empty($ids)) {
            return false;
        }
        return $this->remove(array($this->get_table_pk()=>$ids));
    }
    //执行自动返回结果
    protected function execute($sql, $params = array(), $write = false) {
        $db = $this->get_db($write);
        $type = strtoupper(substr($sql, 0, 6));

        $query = $db->query($sql);
        $result = null;
        switch ($type) {
            case 'INSERT':
                $result = $db->insert_id();
                if (!$result) {
                    $result = $db->affected_rows();
                }
                break;
            case 'UPDATE':
            case 'DELETE':
                $result = $db->affected_rows();
                break;
            case 'SELECT':
                $result = $query->result_array();
                break;
            default:
                break;
        }
        return $result;
    }

    protected function _update ($data = array(),$condition = array(),$status = FALSE) {
        $data_count  = count($data);
        if ($data_count < 1) {
            return false;
        }
        if (empty($condition)) {
            return false;
        }
        //防止误更新
        if (is_numeric($condition)) {
            return false;
        }
        $sql = "UPDATE " . $this->get_table_name() . " SET ";
        $sql .= $this->implode_field_value($data);

        if(empty($condition)) {
            $_where = '1';
        } elseif(is_array($condition)) {
            $_where = $this->implode_field_value($condition, ' AND ');
        }else{
            $_where = $condition;
        }

        $sql .= " WHERE $_where";
        $db = $this->get_db(true);
        $result = $db->query($sql);
        $count = $db->affected_rows();

        return ($count == 0) ? $result : $count;

    }

    protected function _insert ($data,$replace = false, $silent = false) {

    }
    //select master or salve
    protected function get_db($write = false){
        if ($write) {
            return $this->load->database($this->get_write_pdo_name(), TRUE);
        } else {
            if ($this->read_from_master) {
                return $this->load->database($this->get_write_pdo_name(), TRUE);
            }
        }
        return $this->load->database($this->get_read_pdo_name(),TRUE);
    }

    protected function implode_field_value($where, $glue = ',') {
        $sql = $comma = '';
        foreach ($where as $k => $v) {
            if (is_array($v)){//TODO 区别是字符串和数字
                $sql .= $comma."`$k` IN ('".implode("','",$v)."')";
            }else{
                $sql .= $comma."`$k`='$v'";
            }
            $comma = $glue;
        }
        return $sql;
    }

    public static function format_to_string ($data) {
        if (is_array($data)) {
            $str = "";
            foreach ($data as $key => $value) {
                $str .= $key . "," . $value;
            }
            return $str;
        }
        return $data;
    }

    public function format_id_array($id_array) {
        foreach ($id_array as $key=>$val) {
            $val = intval($val);
            if ($val<1) {
                unset($id_array[$key]);
            }else {
                $id_array[$key] = $val;
            }
        }
        return $id_array;
    }

    public static function escape_value ($value) {
        if (is_numeric($value) || is_string($value)) {
            return str_replace(array("'",'\\'),array("''",'\\\\'),$value);
        } else {
            return $value;
        }
    }
}