<?php
class IndexAction extends BaseAction {
    public function index() {

        $this->assign('USER',$_SESSION['USER']);
        $this->display();
    }

    function menu() {
        $this->display();
    }
	
    
    function welcome() {

        if($_SESSION['LEVEL']=='1') {
            $l='超级管理员';
        }else {
            $l='普通管理员';
        }
        $info = array(
            '操作系统'=>PHP_OS,
            '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式'=>php_sapi_name(),
            '上传附件限制'=>ini_get('upload_max_filesize'),
            '执行时间限制'=>ini_get('max_execution_time').'秒',
            '服务器时间'=>date("Y年n月j日 H:i:s"),
            '服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
            '剩余空间'=>round((@disk_free_space(".")/(1024*1024)),2).'M',
            '管理员账户'=>$_SESSION['USER'],
            '管理员级别'=>$l,
        );
        $this->assign('info',$info);
        $this->display();
    }

    //------------------控制--------------------

    //清除缓存
    function clearcache(){
        import("ORG.Io.Dir");
        $path = './home/Runtime';
        Dir::del($path);
        $path = './home/Runtime/Cache';
        Dir::del($path);
        $path = './admin/Runtime';
        Dir::del($path);
        clearCache(0);//清除模板缓存
        $this->assign("url", "__APP__/Index/welcome");
        $this->success("清空缓存成功！");
    }
}
?>