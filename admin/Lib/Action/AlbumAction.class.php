<?php
class albumAction extends BaseAction {

	function add() {

		$pc = M ( 'Picturecls' );
		$ac = M ( 'Articlecls' );
		$ac_list = $ac->findAll ();
		$list = $pc->findAll ();
		if (empty ( $list )) {
			$this->assign ( "url", '__URL__/classes' );
			$this->error ( '请先添加相册' );
		} else {
			$this->assign ( 'list', $list );
			$this->assign ( 'ac_list', $ac_list );
			$this->display ();
		}

	}
	function op() {

		$pc = M ( 'Picturecls' );
		$classes_list = $pc->findAll ();
		$this->assign ( "ac_list", $classes_list );

		//分页
		$picture = D ( 'Picture' );
		import ( "ORG.Util.Page" ); //导入分页类
		$condition->classes = $_GET ['ID'];
		//区分是否选择了类别
		if (empty ( $_GET ['ID'] )) {
			$count = $picture->count (); //计算总数
		} else {
			$count = $picture->where ( $condition )->count (); //计算总数
			$this->assign ( "classes", $_GET ['ID'] );
		}
		$p = new Page ( $count, 15 );
		if (empty ( $_GET ['ID'] )) {
			$list = $picture->limit ( $p->firstRow . ',' . $p->listRows )->order ( 'id desc' )->findAll ();
		} else {
			$list = $picture->where ( $condition )->limit ( $p->firstRow . ',' . $p->listRows )->order ( 'id desc' )->findAll ();
		}

		$p->setConfig ( 'header', '个文件' );
		$p->setConfig ( 'prev', "<" );
		$p->setConfig ( 'next', '>' );
		$p->setConfig ( 'first', '<<' );
		$p->setConfig ( 'last', '>>' );
		$page = $p->show ();
		$this->assign ( "page", $page );
		$this->assign ( "list", $list );
		$this->display ();
	}
	function update() {

		$this->assign ( 'url', '____/op' );
		if (empty ( $_GET ['ID'] ))
		$this->error ( '非法调用' );
		$this->assign ( 'pic_id', $_GET ['ID'] );

		$picture = D ( 'Picture' );
		$picture->find ( $_GET ['ID'] );
		$this->assign ( 'classes', $picture->classes );
		$this->assign ( 'name', $picture->name );
		$this->assign ( 'author', $picture->author );
		$this->assign ( 'intro', $picture->intro );

		if (! empty ( $picture->conn_ar )) {
			$article = D ( 'Article' );
			$article->find ( $picture->conn_ar );
			$this->assign ( 'ac_classes', $article->classes );
			$condition->classes = $article->classes;
			$this->assign ( 'ar_list', $article->where ( $condition )->findAll () );
		}
		$this->assign ( 'ar', $picture->conn_ar );

		$pc = M ( 'Picturecls' );
		$ac = M ( 'Articlecls' );
		$ac_list = $ac->findAll (); //文章类别
		$list = $pc->findAll (); //相册类别


		$this->assign ( 'list', $list );
		$this->assign ( 'ac_list', $ac_list );
		$this->display ();

	}
	function classes() {
		$dc = M ( "Picturecls" );
		$list = $dc->findAll ();
		$this->assign ( "list", $list );
		$this->display ();
	}

	//--------------------------控制---------------------------------------------------------------------------


	//classes add
	function classes_add() {

		$this->assign("url", "__URL__/classes");
		if (empty($_POST ['name']) || empty($_POST ['is_lock'])) {
			$this->error("请完善类别名称！");
		} else {
			$pc = M("Picturecls");
			//判断是否重复。。。。。
			$condition ['name'] = $_POST ['name'];
			if ($pc->where($condition)->select() == FALSE) {

				$pc->name = $_POST ['name'];
				$pc->is_lock = $_POST ['is_lock'];
				$pc->describe = $this->tran_tag($_POST['describe']);
				$pc->keywords = $_POST['kw'];
				//上传封面图
				if(!empty($_FILES['my_file']['name'])){
					$result = $this->pic_upload();
					if($result!='false'){
						$pc->cover_pic = $result;
						if ($pc->add()) {
							$this->success("成功添加相册");
						} else {
							$this->error("系统错误！添加相册失败");
						}
					}
					else{
						$this->error("上传失败！");
					}
				}
				else{
					if ($pc->add()) {
						$this->success("成功添加相册");
					} else {
						$this->error("系统错误！添加相册失败");
					}
				}

			} else {
				$this->error("已存在此相册");
			}
		}
	}

	//classes   update
	function classes_update() {

		$this->assign("url", "__URL__/classes");
		if (empty($_POST ['hidden_update']) || empty($_POST ['name_update'])) {
			$this->error("非法调用！");
		} else {
			$pc = M('picturecls');
			$pc->find($_POST ['hidden_update']);
			$pc->name = $_POST ['name_update'];
			$pc->is_lock = $_POST ["is_lock_update"];
			$pc->describe = $this->tran_tag($_POST['describe']);
			$pc->keywords = $_POST['kw'];
			//echo "<script>alert('".$_FILES['my_file']."');</script>";
			if (!empty($_FILES['my_file']['name'])) {
				$result = $this->pic_upload();
				if ($result!='false') {
					$pc->cover_pic = $result;
					if ($pc->save()) {
						$this->success("成功更新相册");
					}
					else {
						$this->error("系统错误！更新相册失败");
					}
				}
				else {
					$this->error("上传图片失败！");
				}
			}
			else{
				if ($pc->save()) {
					$this->success("更新成功");
				} else {
					$this->error("更新失败");
				}
			}

		}
	}

	//classes    delete
	function classes_delete() {
		//判断是否有ID传过来
		$this->assign ( "url", "__URL__/classes" );
		if (is_null ( $_GET ['ID'] )) {
			$this->error ( "非法调用！" );
		} else {
			$pc = M ( 'Picturecls' );
			//删除所有此相册中的图片（包括物理图片）
			$pc->find ( $_GET ['ID'] );
				
			$picture = D ( 'Picture' );
				
			$condition->classes = $pc->id;
			$pictures = $picture->where ( $condition )->select ();
			foreach ( $pictures as $one ) {
				//print_r($one) ;
				//$this->success ( $pictures.'----'.$one );
				if (file_exists ( C ( 'PIC_SAVE_PATH' ) . $one ['file_name'] )) {
					unlink ( C ( 'PIC_SAVE_PATH' ) . $one ['file_name'] );
				}
				//删除两张缩略图（如果有的话）
				if (file_exists ( C ( 'PIC_SAVE_PATH' ) . C ( 'THUMB_PRE1' ) . $one ['file_name'] )) {
					unlink ( C ( 'PIC_SAVE_PATH' ) . C ( 'THUMB_PRE1' ) . $one ['file_name'] );
				}
				if (file_exists ( C ( 'PIC_SAVE_PATH' ) . C ( 'THUMB_PRE2' ) . $one ['file_name'] )) {
					unlink ( C ( 'PIC_SAVE_PATH' ) . C ( 'THUMB_PRE2' ) . $one ['file_name'] );
				}
				$picture->delete ( $one ['id'] );
			}
			if ($pc->delete ( $_GET ['ID'] )) {
				$this->success ( "删除成功" );
			} else {
				$this->error ( "删除失败" );
			}
		}
	}

	//picture add;;;;;;;;;;;;;;;;
	function pic_add() {
		$this->assign ( "url", "__URL__/add" );
		if (empty ( $_FILES ) || empty ( $_POST ['name'] ) || empty ( $_POST ['select'] )) {
			$this->error ( '请填写完整' );
		} else {
			$this->_upload ();
		}
	}

	//picture update
	function pic_update() {
		$this->assign ( "url", "__URL__/op" );
		if (empty ( $_POST ['name'] ) || empty ( $_POST ['select'] )) {
			$this->error ( '请填写完整' );
		} else {
			$pic = D ( 'Picture' );
			//保存当前数据对象
			$data ['id'] = $_POST ['ID'];
			$data ['name'] = $_POST ['name'];
			$data ['intro'] = $_POST ['intro'];
			$data ['author'] = $_POST ['author'];
			$data ['classes'] = $_POST ['select'];
			if (! empty ( $_POST ['ar'] )) {
				$data ['conn_ar'] = $_POST ['ar'];
			} else {
				$data ['conn_ar'] = NULL;
			}
				
			$list = $pic->save ( $data );
			if ($list !== false) {
				$this->success ( '更新图片信息成功！' );
			} else {
				$this->error ( '更新图片信息失败!' );
			}
		}
	}

	//picture delete
	function pic_delete() {
		$this->assign ( "url", "__URL__/op" );
		if (empty ( $_GET ['ID'] ))
		$this->error ( '非法调用' );
		$pic = D ( 'Picture' );
		//检查是否被锁定，锁定就不能删
		$pic_cls = D ( 'Picturecls' );
		$file_obj = $pic->find ( $_GET ['ID'] );
		$cls_id = $file_obj ['classes'];
		$cls_obj = $pic_cls->find ( $cls_id );
		if ($cls_obj ['is_lock'] == 'y') {
			$this->error ( '图片被锁，请先解锁此类图片' );
		} else {
			$file_name = $file_obj ['file_name'];
			if ($pic->delete ( $_GET ['ID'] )) {
				if (file_exists ( C ( 'PIC_SAVE_PATH' ) . $file_name )) {
					unlink ( C ( 'PIC_SAVE_PATH' ) . $file_name );
				}
				//删除两张缩略图（如果有的话）
				if (file_exists ( C ( 'PIC_SAVE_PATH' ) . C ( 'THUMB_PRE1' ) . $file_name )) {
					unlink ( C ( 'PIC_SAVE_PATH' ) . C ( 'THUMB_PRE1' ) . $file_name );
				}
				if (file_exists ( C ( 'PIC_SAVE_PATH' ) . C ( 'THUMB_PRE2' ) . $file_name )) {
					unlink ( C ( 'PIC_SAVE_PATH' ) . C ( 'THUMB_PRE2' ) . $file_name );
				}
				$this->success ( '删除成功' );
			} else {
				$this->error ( '删除失败' );
			}
		}
	}

	//----------------------------------功能------------------------------------------------------
	// 文件上传
	function _upload() {
		import ( "ORG.Net.UploadFile" );

		$upload = new UploadFile ( );
		//设置上传文件大小
		$upload->maxSize = C ( 'PIC_MAX_SIZE' );
		//设置上传文件类型
		$upload->allowExts = explode ( ',', C ( 'PIC_ALLOW_TYPE' ) );
		//设置附件上传目录
		$upload->savePath = C ( 'PIC_SAVE_PATH' );
		//设置需要生成缩略图，仅对图像文件有效
		$upload->thumb = true;
		//设置需要生成缩略图的文件后缀
		$upload->thumbPrefix = C ( 'THUMB_PRE1' ) . ',' . C ( 'THUMB_PRE2' ); //生产2张缩略图
		//设置缩略图最大宽度
		$upload->thumbMaxWidth = C ( 'THUMB1_W' ) . ',' . C ( 'THUMB2_W' );
		//设置缩略图最大高度
		$upload->thumbMaxHeight = C ( 'THUMB1_H' ) . ',' . C ( 'THUMB2_H' );
		//设置上传文件规则
		$upload->saveRule = uniqid;
		//删除原图
		$upload->thumbRemoveOrigin = FALSE;
		if (! $upload->upload ()) {
			//捕获上传异常
			$this->error ( $upload->getErrorMsg () );
		} else {
			//取得成功上传的文件信息
			$uploadList = $upload->getUploadFileInfo ();
			$_POST ['my_file'] = $uploadList [0] ['savename'];
		}
		$pic = D ( 'Picture' );
		//保存当前数据对象
		$data ['file_name'] = $_POST ['my_file'];
		$data ['name'] = $_POST ['name'];
		$data ['intro'] = $_POST ['intro'];
		$data ['is_index'] = 'n';
		$data ['author'] = $_POST ['author'];
		$data ['classes'] = $_POST ['select'];
		$data ['ctime'] = date ( "Y-m-d H:i:s" );
		if (! empty ( $_POST ['ar'] ))
		$data ['conn_ar'] = $_POST ['ar'];
		$list = $pic->add ( $data );
		if ($list !== false) {
			$this->success ( '上传图片成功！' );
		} else {
			$this->error ( '上传图片失败!' );
		}
	}

	//相册封面图上传
	function pic_upload(){
		import("ORG.Net.UploadFile");

		$upload = new UploadFile ( );
		//设置上传文件大小
		$upload->maxSize = C('PIC_MAX_SIZE');
		//设置上传文件类型
		$upload->allowExts = explode(',', C('PIC_ALLOW_TYPE'));
		//设置附件上传目录
		$upload->savePath = C('PIC_SAVE_PATH');
		//设置需要生成缩略图，仅对图像文件有效
		$upload->thumb = true;
		//设置需要生成缩略图的文件后缀
		$upload->thumbPrefix = C('THUMB_PRE1') . ',' . C('THUMB_PRE2'); //生产2张缩略图
		//设置缩略图最大宽度
		$upload->thumbMaxWidth = C('THUMB1_W') . ',' . C('THUMB2_W');
		//设置缩略图最大高度
		$upload->thumbMaxHeight = C('THUMB1_H') . ',' . C('THUMB2_H');
		//设置上传文件规则
		$upload->saveRule = uniqid;
		//删除原图
		$upload->thumbRemoveOrigin = FALSE;
		if (!$upload->upload()) {
			//捕获上传异常
			$this->error ( $upload->getErrorMsg () );
			//return $upload->getErrorMsg ();
			return 'false';
		} else {
			//取得成功上传的文件信息
			$uploadList = $upload->getUploadFileInfo();
			//$_POST ['my_file'] = $uploadList [0] ['savename'];
			return $uploadList [0] ['savename'];
		}

	}

	//根据articlecls 得到 article列表
	function getList() {

		$cls_id = $_GET ['cls_id'];
		$article = D ( 'Article' );
		$condition->classes = $cls_id;
		$list = $article->where ( $condition )->findAll ();
		if (empty ( $list )) {
			echo '';
		} else {
			echo json_encode ( $list );
		}

	}

	//获取相册信息
	function get_picturecls(){
		$cls_id = $_GET['cls_id'];
		$picturecls = D('Picturecls');
		$condition->id = $cls_id;
		$album = $picturecls->where($condition)->find();
		if(empty($album)){
			echo '';
		}
		else{
			echo json_encode($album);
		}
	}
	function tran_tag($source){
		return nl2br($source);

	}
}
?>