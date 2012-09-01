<?php  function check_max($number, $table) { $tb = D($table); $count = $tb->count(); if ($count >= $number) { return FALSE; } else { return TRUE; } } function check_get($fields) { if($fields){ $arr = explode(",",$fields); foreach($arr as $value){ if(empty($_GET[$value])||empty($_POST[$value])){ return false; } } return true; }else{ return false; } } function get_config($name){ $where['name']=$name; $data = D('Config')->where($where)->find(); return $data?$data['words']:false; } function set_config($name,$words){ $where['name']=$name; $data['words']=$words; return D('Config')->where($where)->save($data); } function urldecode_array($arr = array()){ foreach ($arr as $key=>$row){ if(is_array($row)){ foreach($row as $k=>$value){ $arr[$key][$k] = urldecode($value); } }else{ $arr[$key] = urldecode($row); } } } return array ( 'app_debug' => false, 'app_domain_deploy' => false, 'app_plugin_on' => false, 'app_file_case' => false, 'app_group_depr' => '.', 'app_group_list' => '', 'app_autoload_reg' => false, 'app_autoload_path' => 'Think.Util.', 'app_config_list' => array ( 0 => 'taglibs', 1 => 'routes', 2 => 'tags', 3 => 'htmls', 4 => 'modules', 5 => 'actions', ), 'cookie_expire' => 3600, 'cookie_domain' => '', 'cookie_path' => '/', 'cookie_prefix' => '', 'default_app' => '@', 'default_group' => 'Home', 'default_module' => 'Index', 'default_action' => 'index', 'default_charset' => 'utf-8', 'default_timezone' => 'PRC', 'default_ajax_return' => 'JSON', 'default_theme' => 'default', 'default_lang' => 'zh-cn', 'db_type' => 'mysql', 'db_host' => 'localhost', 'db_name' => 'bink', 'db_user' => 'root', 'db_pwd' => '51865992', 'db_port' => 3306, 'db_prefix' => 'bink_', 'db_suffix' => '', 'db_fieldtype_check' => false, 'db_fields_cache' => true, 'db_charset' => 'utf8', 'db_deploy_type' => 0, 'db_rw_separate' => false, 'data_cache_time' => -1, 'data_cache_compress' => false, 'data_cache_check' => false, 'data_cache_type' => 'File', 'data_cache_path' => './admin/Runtime/Temp/', 'data_cache_subdir' => false, 'data_path_level' => 1, 'error_message' => '您浏览的页面暂时发生了错误！请稍后再试～', 'error_page' => '', 'html_cache_on' => false, 'html_cache_time' => 60, 'html_read_type' => 0, 'html_file_suffix' => '.shtml', 'lang_switch_on' => false, 'lang_auto_detect' => true, 'log_record' => false, 'log_file_size' => 2097152, 'log_record_level' => array ( 0 => 'EMERG', 1 => 'ALERT', 2 => 'CRIT', 3 => 'ERR', ), 'page_rollpage' => 5, 'page_listrows' => 10, 'session_auto_start' => true, 'show_run_time' => false, 'show_adv_time' => false, 'show_db_times' => false, 'show_cache_times' => false, 'show_use_mem' => false, 'show_page_trace' => false, 'show_error_msg' => true, 'tmpl_engine_type' => 'Think', 'tmpl_detect_theme' => false, 'tmpl_template_suffix' => '.html', 'tmpl_cachfile_suffix' => '.php', 'tmpl_deny_func_list' => 'echo,exit', 'tmpl_parse_string' => '', 'tmpl_l_delim' => '{', 'tmpl_r_delim' => '}', 'tmpl_var_identify' => 'array', 'tmpl_strip_space' => false, 'tmpl_cache_on' => false, 'tmpl_cache_time' => -1, 'tmpl_action_error' => 'Public:success', 'tmpl_action_success' => 'Public:success', 'tmpl_trace_file' => '/var/www/fw/Tpl/PageTrace.tpl.php', 'tmpl_exception_file' => '/var/www/fw/Tpl/ThinkException.tpl.php', 'tmpl_file_depr' => '/', 'taglib_begin' => '<', 'taglib_end' => '>', 'taglib_load' => true, 'taglib_build_in' => 'cx', 'taglib_pre_load' => '', 'tag_nested_level' => 3, 'tag_extend_parse' => '', 'token_on' => true, 'token_name' => '__hash__', 'token_type' => 'md5', 'url_case_insensitive' => false, 'url_router_on' => false, 'url_dispatch_on' => true, 'url_model' => 1, 'url_pathinfo_model' => 2, 'url_pathinfo_depr' => '/', 'url_html_suffix' => '', 'var_group' => 'g', 'var_module' => 'm', 'var_action' => 'a', 'var_router' => 'r', 'var_page' => 'p', 'var_template' => 't', 'var_language' => 'l', 'var_ajax_submit' => 'ajax', 'var_pathinfo' => 's', 'file_max_size' => 5000000, 'file_save_path' => './Public/File/', 'file_allow_type' => 'zip,rar', 'pic_max_size' => 5000000, 'pic_save_path' => './Public/Pic/', 'pic_allow_type' => 'jpg,png,bmp,jpeg,gif', 'thumb_pre1' => 'm_', 'thumb1_h' => 120, 'thumb1_w' => 140, 'thumb_pre2' => 's_', 'thumb2_h' => 60, 'thumb2_w' => 60, 'menu_one_length' => 15, 'menu_two_length' => 15, 'advert_pic_save_path' => './Public/Pic/Advert/', ); ?>