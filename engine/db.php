<?php
function getConn(){
    //require dirname(__FILE__)."/config.php";
    mysql_connect($_c['db_host'],$_c['db_user'],$_c['db_pass']);
    mysql_select_db($_c['db_name']);
    mysql_query("set names utf8");
}
function closeConn(){
    mysql_close();
}
function query($sql){
    return mysql_query(str_replace("#pre#",PREFIX,$sql));
}
function queryArray($sql){
    $rs = query($sql);
    $arr = array();
    while($row = mysql_fetch_assoc($rs)){
        array_push($arr, $row);
    }
    //mysql_close();
    return $arr;
}