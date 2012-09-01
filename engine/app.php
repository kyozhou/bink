<?php

//error_reporting("");
header("Content-type: text/html; charset=utf-8");
require dirname(__FILE__) . "/config.php";
define("ROOT", $_c['web_root']);
define("PREFIX",$_c['db_prefix']);
mysql_connect($_c['db_host'], $_c['db_user'], $_c['db_pass']);
mysql_select_db($_c['db_name']);
mysql_query("set names utf8");
require(dirname(__FILE__) . "/db.php");
include(dirname(__FILE__) . '/functions.php');

