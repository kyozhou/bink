<?php

class bulletinAction extends BaseAction {

    function op() {

        $blt = D('Bulletin');
        $list = $blt->order('id desc')->select();
        $this->assign("list", $list);
        $this->assign("time_now", date("Y-m-d H:i:s"));
        $this->display();
    }

    function advert() {

        $advert = D('Advert');
        $list = $advert->order('id desc')->select();
        $this->assign("list", $list);
        $this->display();
    }

    //公告管理
    function add() {

        $this->assign("url", "__URL__/op");

        if (empty($_POST ['content'])) {
            $this->error("请填写完整！");
        } else {
            $blt = D('Bulletin');
            $data ['content'] = $_POST ['content'];
            if ($blt->add($data)) {
                $this->success("添加成功");
            } else {
                $this->error("添加失败");
            }
        }
    }

    function update() {
        $this->assign("url", "__URL__/op");

        if (empty($_POST ['hidden_update'])) {
            $this->error("非法调用！");
        }
        if (empty($_POST ['content_update'])) {
            $this->success("请填写完整！");
        } else {
            $blt = D('Bulletin');
            $blt->find($_POST ['hidden_update']);
            $blt->content = $_POST ['content_update'];

            if ($blt->save()) {
                $this->success("更新成功");
            } else {
                $this->error("更新失败或没有更新");
            }
        }
    }

    function delete() {
        $this->assign("url", "__URL__/op");
        if (empty($_GET ['ID'])) {
            $this->error("非法调用！");
        }
        $blt = D('Bulletin');
        if ($blt->delete($_GET ['ID'])) {
            $this->success("刪除成功");
        } else {
            $this->error("刪除失败");
        }
    }

    //广告管理
    function ad_add() {

        $this->assign("url", "__URL__/advert");
        if (empty($_POST ['name']) || empty($_POST ['is_show'])) {
            $this->error("请完善表单！");
        } else {
            $advert = D("Advert");
            //判断是否重复。。。。。
            $condition ['name'] = $_POST ['name'];
            if ($advert->where($condition)->select() == FALSE) {

                $advert->name = $_POST ['name'];
                $advert->is_show = $_POST ['is_show'] == "y" ? 1 : 0;
                $advert->href = $_POST['href'];
                //echo "<script>alert('".$advert->name."');</script>";
                if (!empty($_FILES['my_file']['name'])) {
                    $result = $this->pic_upload();
                    if ($result != 'false') {
                        $advert->file_name = $result;
                        if ($advert->add()) {
                            $this->success("成功添加广告");
                        } else {
                            $this->error("系统错误！添加广告失败");
                        }
                    } else {
                        $this->error("上传图片失败！");
                    }
                } else {
                    $this->error("错误！文件为空！");
                }
            } else {
                $this->error("广告名已存在");
            }
        }
    }

    function ad_update() {
        $this->assign("url", "__URL__/advert");
        if (empty($_POST ['name']) || empty($_POST['ad_id'])) {
            $this->error("请完善表单");
        } else {

            $advert = D('Advert');
            //判断是否重复。。。。。
            $condition ['name'] = $_POST ['name'];

            if (count($advert->where($condition)->select()) <= 1) {
                $data['id'] = $_POST['ad_id'];
                $data['name'] = $_POST['name'];
                $data['is_show'] = $_POST['is_show'] == 'y' ? 1 : 0;
                $data['href'] = $_POST['href'];
                //上传
                if (!empty($_FILES['my_file']['name'])) {
                    unlink(C('ADVERT_PIC_SAVE_PATH') . $_POST['file_name']);

                    $result = $this->pic_upload();
                    if ($result != 'false') {
                        $data['file_name'] = $result;
                        if ($advert->execute("update bink_advert set name='" . $data['name'] . "' , is_show=" . $data['is_show'] . " ,file_name='" . $result . "' , href='".$data['href']."' where id=" . $data['id'])) {
                            $this->success("成功更新广告");
                        } else {
                            $this->error("更新广告失败".$data['id']);
                        }
                    } else {
                        $this->error("上传图片失败！");
                    }
                } else {
                    if ($advert->execute("update bink_advert set name='" . $data['name'] . "' , is_show=" . $data['is_show'] . " , href='".$data['href']."' where id=" . $data['id'])) {
                        $this->success("成功更新广告");
                    } else {
                        //echo "<script>alert('".$_POST ['name']."');</script>";
                        $this->error("更新失败或没有更新");
                    }
                }
            } else {
                $this->error("广告名已存在");
            }
        }
    }

    function ad_delete() {
        $this->assign("url", "__URL__/advert");
        if (empty($_GET['ID'])) {
            $this->error("错误的提交！");
        } else {
            $advert = D("Advert");
            $result = $advert->where('id=' . $_GET['ID'])->select();
            if (count($result) > 0) {
                $pic_to_del = $result[0]['file_name'];
                unlink(C('ADVERT_PIC_SAVE_PATH') . $pic_to_del);
                echo "<script>alert('" . C('ADVERT_PIC_SAVE_PATH') . $pic_to_del . "');</script>";
                if ($advert->where('id=' . $_GET['ID'])->delete()) {
                    $this->success("删除成功！");
                } else {
                    $this->error('删除失败');
                }
            } else {
                $this->error('删除失败，广告不存在');
            }
        }
    }

    function advert_delete_batch() {
        $this->assign("url", "__URL__/advert");
        if (empty($_POST ['cb'])) {
            $this->error('没有选择项!');
        } else {
            $advert = D('Advert');
            $arr_id = $_POST ['cb'];
            $all_test = true;
            foreach ($arr_id as $id) {
                $result = $advert->where('id=' . $id)->select();
                if (count($result) > 0) {
                    $pic_to_del = $result[0]['file_name'];
                    unlink(C('ADVERT_PIC_SAVE_PATH') . $pic_to_del);
                }
                if ($advert->delete($id)) {

                } else {
                    $all_test = false;
                }
            }
            if ($all_test) {
                $this->success('删除成功');
            } else {
                $this->error('删除失败或部分删除失败！');
            }
        }
    }

    function get_advert() {
        if (is_numeric($_GET['ID'])) {
            $advert = D('Advert');
            $condition->id = $_GET['ID'];
            $result = $advert->where($condition)->find();
            if (count($result) <= 0) {
                echo '';
            } else {
                echo json_encode($result);
            }
        } else {
            echo '';
        }
    }

    //-------------------------------------函数--------------------------------------
    function pic_upload() {
        import("ORG.Net.UploadFile");

        $upload = new UploadFile ( );
        //设置上传文件大小
        $upload->maxSize = C('PIC_MAX_SIZE');
        //设置上传文件类型
        $upload->allowExts = explode(',', C('PIC_ALLOW_TYPE'));
        //设置附件上传目录
        $upload->savePath = C('ADVERT_PIC_SAVE_PATH');

        //设置上传文件规则
        $upload->saveRule = uniqid;
        //删除原图
        $upload->thumbRemoveOrigin = FALSE;

        if (!$upload->upload()) {
            //捕获上传异常
            $this->error($upload->getErrorMsg());
            //return $upload->getErrorMsg ();
            //return 'false';
        } else {
            //取得成功上传的文件信息
            $uploadList = $upload->getUploadFileInfo();
            //$_POST ['my_file'] = $uploadList [0] ['savename'];
            return $uploadList [0] ['savename'];
        }
    }

}
?>