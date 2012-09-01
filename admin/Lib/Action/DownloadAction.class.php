<?php
class downloadAction extends BaseAction {

    function add() {

        $dc = D ( "Downloadcls" );
        $list = $dc->findAll ();
        $this->assign ( "list", $list );
        $this->assign ( "now_time", date ( "Y-m-d H:i:s" ) );
        $this->display ();
    }
    function op() {

        $dc = D ( 'Downloadcls' );
        $classes_list = $dc->findAll ();
        $this->assign ( "classes_list", $classes_list );

        //分页
        $download = D ( 'Download' );
        import ( "ORG.Util.Page" ); //导入分页类
        $condition->classes = $_GET ['ID'];
        //区分是否选择了类别
        if (empty ( $_GET ['ID'] )) {
            $count = $download->count (); //计算总数
        } else {
            $count = $download->where ( $condition )->count (); //计算总数
            $this->assign ( "classes", $_GET ['ID'] );
        }
        $p = new Page ( $count, 15 );
        if (empty ( $_GET ['ID'] )) {
            $list = $download->limit ( $p->firstRow . ',' . $p->listRows )->order ( 'id desc' )->findAll ();
        } else {
            $list = $download->where ( $condition )->limit ( $p->firstRow . ',' . $p->listRows )->order ( 'id desc' )->findAll ();
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
    function classes() {

        $dc = D ( "Downloadcls" );
        $list = $dc->findAll ();
        $this->assign ( "list", $list );
        $this->display ();
    }
    function update() {

        if ($_GET ["ID"] != null) {
            $dc = D ( "Downloadcls" );
            $list = $dc->findAll ();
            $this->assign ( "list", $list );

            $download = D ( 'Download' );
            $download->find ( $_GET ['ID'] );
            $this->assign ( "name", $download->name );
            $this->assign ( "author", $download->author );
            $this->assign ( "cls_id", $download->classes );
            $this->assign ( "intro", $download->content );
            $this->assign ( "time_now", date ( "Y-m-d H:i:s" ) );
            $this->assign ( 'intro', $download->intro );
            $this->assign ( "id", $_GET ['ID'] );
            $this->display ();

        } else {
            $this->error ( "非法调用！" );
        }
    }
    //------------------------操作函数------------------------------------------------------------------
    //classes add
    function classes_add() {

        $this->assign ( "url", "__APP__/Download/classes" );
        if (empty ( $_POST ['name'] ) || empty ( $_POST ['is_lock'] )) {
            $this->error ( "请完善类别名称！" );
        } else {
            $dc = D ( "Downloadcls" );
            //判断是否重复。。。。。
            $condition ['name'] = $_POST ['name'];
            if ($dc->where ( $condition )->select () == FALSE) {

                $dc->name = $_POST ['name'];
                $dc->is_lock = $_POST ['is_lock'];
                if ($dc->add ()) {
                    $this->success ( "成功添加类别" );
                } else {
                    $this->error ( "系统错误！添加类别失败" );
                }
            } else {
                $this->error ( "已存在此类别" );
            }
        }
    }

    //classes   update
    function classes_update() {

        $this->assign ( "url", "__URL__/classes" );
        if (empty ( $_POST ['hidden_update'] ) || empty ( $_POST ['name_update'] )) {
            $this->error ( "非法调用！" );
        } else {
            $dc = D ( 'Downloadcls' );
            $dc->find ( $_POST ['hidden_update'] );
            $dc->name = $_POST ['name_update'];
            $dc->is_lock = $_POST ["is_lock_update"];
            if ($dc->save ()) {
                $this->success ( "更新成功" );
            } else {
                $this->error ( "更新失败 或 没有更新" );
            }
        }
    }

    //classes    delete
    function classes_delete() {
        //判断是否有ID传过来
        $this->assign ( "url", "__URL__/classes" );
        if (empty ( $_GET ['ID'] )) {
            $this->error ( "非法调用！" );
        } else {
            $dc = M ( 'downloadcls' );
            if ($dc->delete ( $_GET ['ID'] )) {
                $this->success ( "删除成功" );
            } else {
                $this->error ( "删除失败,有文件关联此类型" );
            }
        }
    }

    //download add
    function download_add() {
        $this->assign ( 'url', '__URL__/add' );
        if (empty ( $_FILES ) || empty ( $_POST ['name'] ) || empty ( $_POST ['select'] ) ) {
            $this->error ( '请填写完整！' );
        } else {
            $this->_upload ();
        }

    }

    //download update
    function download_update() {
        $this->assign ( "url", "__URL__/op" );
        if (empty ( $_POST ['ID'] )) {
            $this->error ( '非法调用！' );
        }
        if (empty ( $_POST ['name'] ) || empty ( $_POST ['select'] ) ) {
            $this->error ( '请填写完整！' );
        } else {
            $download = D ( 'Download' );
            $download->find ( $_POST ['ID'] );
            $download->classes = $_POST ['select'];
            $download->name = $_POST ['name'];
            $download->author = $_POST ['author'];
            $download->last_update = date ( "Y-m-d H:i:s" );
            $download->intro = $_POST ['intro'];
            if ($download->save ()) {
                $this->success ( "更新成功！".$download->last_update );
            } else {
                $this->success ( '更新失败！'.date ( "Y-m-d H:i:s" ) );
            }
        }

    }

    //download delete
    function download_delete() {
        $this->assign ( "url", "__URL__/op" );
        if (empty ( $_GET ['ID'] )) {
            $this->error ( '非法调用！' );
        } else {

            $download = D ( 'Download' );
            $download->find ( $_GET ['ID'] );
            $file_name = $download->file_name;
            $cls_id = $download->class;
            $dc = D ( 'Downloadcls' );
            $dc->find ( $cls_id );
            if ($dc->is_lock=='n'&&$download->delete ( $_GET ['ID'] )) {
                if (file_exists ( C ( 'FILE_SAVE_PATH' ) . $file_name )) {
                    unlink ( C ( 'FILE_SAVE_PATH' ) . $file_name );
                }
                $this->success ( '删除成功' );
            } else {
                $this->error ( '删除失败,所属类别可能被锁定' );
            }
        }
    }

    //-------------------------------操作子函数-----------------------------------------
    // 文件上传
    protected function _upload() {
        $this->assign ( 'url', '__URL__/add' );
        import ( "ORG.Net.UploadFile" );
        $upload = new UploadFile ( );
        //设置上传文件大小
        $upload->maxSize = C ( 'FILE_MAX_SIZE' );
        //设置上传文件类型
        $upload->allowExts = explode ( ',', C ( 'FILE_ALLOW_TYPE' ) );
        //设置附件上传目录
        $upload->savePath = C ( 'FILE_SAVE_PATH' );
        //设置上传文件规则
        $upload->saveRule = uniqid;
        if (! $upload->upload ()) {
            //捕获上传异常
            $this->error ( $upload->getErrorMsg () );
        } else {
            //取得成功上传的文件信息
            $uploadList = $upload->getUploadFileInfo ();
            $_POST ['my_file'] = $uploadList [0] ['savename'];
        }
        $model = D ( 'Download' );
        //保存当前数据对象
        $data ['file_name'] = $_POST ['my_file'];
        $data ['c_time'] = date ( "Y-m-d H:i:s" );
        $data ['last_update'] = date ( "Y-m-d H:i:s" );
        $data ['name'] = $_POST ['name'];
        $data ['intro'] = $_POST ['intro'];
        $data ['author'] = $_POST ['author'];
        $data ['classes'] = $_POST ['select'];
        $data ['clk_times'] = 1;
        $list = $model->add ( $data );
        if ($list !== false) {
            $this->success ( '上传文件成功！' . $_FILES ['my_file'] ['filename'] );
        } else {
            $this->error ( '上传文件失败!' );
        }
    }

}

?>