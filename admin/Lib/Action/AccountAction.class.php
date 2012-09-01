<?php
class AccountAction extends SuperAction {

	function op() {
		
		$account = D( "Account" );
		$list = $account->order ( 'id desc' )->findAll ();
		$this->assign ( "list", $list );
		$this->display ();
	}
	
	//add
	function add() {
		import ( 'ORG.Util.KyoClass' );
		if (empty ( $_POST ['user'] ) || empty ( $_POST ['password'] ) || empty ( $_POST ['level'] )) {
			$this->assign ( "url", "__APP__/Account/op" );
			$this->error ( "请完善用户名与密码！" );
		} else {
			$account = D( "Account" );
			//判断用户名密码是否重复。。。。。
			$condition['user'] = $_POST['user'];
			if ($account->where($condition)->select() == false){
				$account->user = $_POST ['user'];
				$account->password = md5($_POST ['password']);
				$account->level = $_POST ['level'];
				$account->c_time = date ( "Y-m-d H:i:s" );
				$account->login_times = 0;
				if ($account->add ()) {
					$this->assign ( "url", "__APP__/Account/op" );
					$this->success ( "成功增加账户" );
				} else {
					$this->assign ( "url", "__APP__/Account/op" );
					$this->error ( "增加账户失败！请联系作者kyozhou@sina.com" );
				}
			}
			else
			{
				$this->assign ( "url", "__APP__/Account/op" );
				$this->error ( "错误!!已存在此账户!!" );
			}
		}
	}
	
	//update
	function update() {
		if (empty ( $_POST ['user_update'] ) || empty ( $_POST ['password_update'] ) || empty ( $_POST ['level_update'] )) {
			$this->assign ( "url", "__APP__/Account/op" );
			$this->error ( "请完善账户与密码！" );
		} else {
			$account = D ( "Account" );
			$account->find ( $_POST ['hidden_update'] );
			$account->user = $_POST ['user_update'];
			$account->password = md5($_POST ['password_update']);
			$account->level = $_POST ['level_update'];
			$account->login_times = 0;
			if ($account->save ()) {
				$this->assign ( "url", "__APP__/Account/op" );
				$this->success ( "成功更新账户" );
			} else {
				$this->assign ( "url", "__APP__/Account/op" );
				$this->error ( "增加账户失败！" );
			}
		
		}
	}
	
	//delete
	function delete() {
		$account = D ( "Account" );
		$id = $_GET["ID"];
		if ($account->delete($id)) {
			$this->assign ( "url", "__APP__/Account/op" );
			$this->success ( "成功删除账户" );
		} else {
			$this->assign ( "url", "__APP__/Account/op" );
			$this->error ("删除失败！！");
		}
	}

}