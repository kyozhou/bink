<?php

class BaseAction extends Action {
	function _initialize() {
		//判断是否有登录,没有登录跳转到登录窗口
		if (! isset ( $_SESSION [C ( 'USER_AUTH_KEY' )] )) {
			$this->redirect('Login/index', '');
		}
	}
}

?>