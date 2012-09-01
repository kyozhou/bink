<?php

/**
 * 
 * 检测表中条目是否超过给定的数目
 * 给定的表为model中的类
 * 超过长度返回false
 * 
 * @param int $number
 * @param string $table
 */
function check_max($number, $table) {

    $tb = D($table);
    $count = $tb->count();
    if ($count >= $number) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function check_get($fields) {
    if($fields){
        $arr = explode(",",$fields);
        foreach($arr as $value){
            if(empty($_GET[$value])||empty($_POST[$value])){
                return false;
            }
        }
        return true;
    }else{
        return false;
    }
}

/**
 * 获取数据库配置
 * @param <type> $name 
 */
function get_config($name){
    $where['name']=$name;
    $data = D('Config')->where($where)->find();
    return $data?$data['words']:false;
}
/**
 * 设置数据库配置
 * @param <type> $name
 * @param <type> $words
 */
function set_config($name,$words){
    $where['name']=$name;
    $data['words']=$words;
    return D('Config')->where($where)->save($data);
}

/**
 * 将array里的值urldecode，最多支持2维，也就是一张表
 * @param type $arr 
 */
function urldecode_array($arr = array()){
    foreach ($arr as $key=>$row){
        if(is_array($row)){
            foreach($row as $k=>$value){
                $arr[$key][$k] = urldecode($value);
            }
        }else{
            $arr[$key] = urldecode($row);
        }
    }
}

?>