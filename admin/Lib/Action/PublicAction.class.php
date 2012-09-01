<?php
class PublicAction extends BaseAction {
	//动态取得列表
	function getList() {
		
		$cls_id = $_GET ['cls_id'];
		switch ($_GET['classes']){
			case 'ar':
				$article = D ( 'Article' );
				break;
			case 'dl':
				$article = D ( 'Download' );
				break;
			case 'ab':
				$article = D ( 'Picture' );
				break;
				
		}
		
		$condition->classes = $cls_id;
		$list = $article->where ( $condition )->findAll ();
		if (empty ( $list )) {
			echo '';
		} else {
			echo json_encode ( $list );
		}
	
	}
	
}

?>