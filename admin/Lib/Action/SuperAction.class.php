<?php
class SuperAction extends Action {
	//账号管理为特殊保护
	function _initialize() {
		//判断是否有登录,没有登录跳转到登录窗口
		if ($_SESSION ['LEVEL'] != '1') {
			$this->assign('url','__APP__/Index/welcome');
			$this->error('权限不足');
		}
	}
}

?>