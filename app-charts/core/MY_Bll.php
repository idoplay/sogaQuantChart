<?php

class MY_Bll
{
    private $dao_list = null;
    private $bll_list = null;
    public function __construct() {
    }
    function __get($key)
    {
        $CI = & get_instance();
        return $CI->$key;
    }
    public function get_dao ($dao_name) {
        $object_name = str_replace('/','_',$bll_name);
        if (!isset($this->dao_list[$dao_name])) {
            $dao_file_path = APPPATH.'models/'.$dao_name.'.php';
            if(file_exists($dao_file_path)){
                require_once($dao_file_path);
                $service = explode('/',$dao_name);
                $service = $service[count($service)-1];
            }
            $this->dao_list[$object_name] = new $service();
        }
        return $this->dao_list[$object_name];
    }

    public static function sysSortArray($ArrayData, $KeyName1, $SortOrder1 = "SORT_ASC", $SortType1 = "SORT_REGULAR") {
        if(! is_array($ArrayData)) {
            return $ArrayData;
        }
        $ArgCount = func_num_args();

        for($I = 1; $I < $ArgCount; $I++) {
            $Arg = func_get_arg($I);
            if(! eregi("SORT", $Arg)) {
                $KeyNameList[] = $Arg;
                $SortRule[] = '$' . $Arg;
            } else {
                $SortRule[] = $Arg;
            }
        }
        foreach($ArrayData as $Key => $Info) {
            foreach($KeyNameList as $KeyName) {
                ${$KeyName}[$Key] = $Info[$KeyName];
            }
        }
        $EvalString = 'array_multisort(' . join(",", $SortRule) . ',$ArrayData);';
        eval($EvalString);
        return $ArrayData;
    }

    /**
     * 格式化ID数组，去掉空的项目
     * @param array $id_array
     */
    public function format_id_array($id_array) {
        if (empty($id_array) || !is_array($id_array)) {
            return array();
        }
        foreach ($id_array as $k=>$v) {
            if (empty($v)) {
                unset($id_array[$k]);
            } else {
                $id_array[$k] = intval($v);
            }
        }
        return $id_array;
    }

    /**
     * 将ID数组格式化成例如 1,2,3
     */
    public function join_id_array ($id_array) {
        $id_array = $this->format_id_array($id_array);
        if (empty($id_array)) {
            return '';
        } else {
            return join(',',$id_array);
        }
    }

    /**
     * 将 array('id1','id2') 这样的数组变成 'id1','id2' 这样的字符串，用户sql语句
     */
    public function join_string_array ($ids,$glue="'") {
        if (empty($ids) || !is_array($ids)) {
            return '';
        } else {
            $tmp = array();
            foreach ($ids as $val) {
                $tmp[] = addslashes($val);
            }
            return "$glue".join("$glue,$glue",$tmp)."$glue";
        }
    }
}