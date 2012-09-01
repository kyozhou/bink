<?php
function getConfig($keys = array()){
    $sql = "select name,words from #pre#config ";
    if(count($keys)>0){
        $sql .= "where name in(".  implode(" , ", $keys) .')';
    }
    $rs = query($sql);
    $arr = array();
    while($row = mysql_fetch_array($rs)){
        $arr[$row['name']] = $row['words'];
    }
    return $arr;
}
/**
 +----------------------------------------------------------
 * 字符串截取，支持中文和其他编码
 +----------------------------------------------------------
 * @static
 * @access public
 +----------------------------------------------------------
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function msubstr($str, $start=0, $length=200, $charset="utf-8", $suffix=true)
{
    if(function_exists("mb_substr"))
        return mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        return iconv_substr($str,$start,$length,$charset);
    }
    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    if($suffix) return $slice."...";
    return $slice;
}

function get_pager($sql, $page_row=null) {
    import("ORG.Util.Page");
    $temp_list = D()->query($sql);
    $count = count($temp_list);
    $page_row = $page_row ? $page_row : C('PAGE_LISTROWS');
    $p = new Page($count, $page_row);
    $p->setConfig('header', '篇文章');
    $p->setConfig('prev', "上一页");
    $p->setConfig('next', '下一页');
    $p->setConfig('first', '首页');
    $p->setConfig('last', '末页');
    return array('pager' => $p->show(), 'list' => D()->query($sql . ' limit ' . $p->firstRow . ',' . $p->listRows));
}