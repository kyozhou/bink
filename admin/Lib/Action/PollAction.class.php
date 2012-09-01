<?php

class pollAction extends BaseAction {

    function op() {

        $poll = D('Poll');
        $result = $poll->query("select * from bink_poll where is_head=1 order by id desc");
        $this->assign("poll_list", $result);
        $this->display();
    }

    function poll_add() {
        $this->assign("url", "__URL__/op");
        if (!empty($_POST['name']) && !empty($_POST['is_show'])) {
            $poll = D('Poll');
            $f_name = $_POST['name'];
            $poll->name = $f_name;

            $poll->is_show = $_POST['is_show'] == 'y' ? 1 : 0;
            $poll->is_head = 1;
            $new_id = $poll->add();
            if ($new_id >= 0) {
                $poll_as = D('Poll');
                for ($i = 1; $i <= 5; $i++) {
                    if (!empty($_POST['as' . $i])) {
                        $as_name = $_POST['as' . $i];
                        $as_is_show = $_POST['is_show'] == 'y' ? 1 : 0;
                        $as_is_head = 0;
                        $as_f_name = $f_name;
                        $as_f_id = (int) $new_id;
                        //echo "<script>alert('".$new_id."');</script>";
                        $poll_as->execute("insert into bink_poll(name,is_show,is_head,f_name,f_id)values('$as_name',$as_is_show,$as_is_head,'$as_f_name',$as_f_id)");
                    }
                }
                $this->success("新增成功");
            } else {
                $this->error("新增失败");
            }
        } else {
            $this->error("请完善类别名称！");
        }
    }

    function poll_delete() {
        if (!empty($_GET['ID'])) {
            $this->assign("url", "__URL__/op");
            $poll = D('Poll');
            $rs_temp = $poll->query("select name from bink_poll where id=" . $_GET['ID']);
            if (sizeof($rs_temp) <= 0) {
                $this->error("投票内容不存在");
            } else {
                $f_name = $rs_temp[0]['name'];
                //echo "<script>alert('".$f_name."');</script>";
                if ($poll->where("id=" . $_GET['ID'])->delete() > 0 && $poll->where("f_id=" . $_GET['ID'])->delete() > 0) {
                    $this->success("删除成功");
                } else {
                    $this->error("删除失败");
                }
            }
        } else {
            $this->error("非法调用");
        }
    }

    function poll_update() {
        if (!empty($_POST['hidden_update'])) {
            $this->assign("url", "__URL__/op");
            if (empty($_POST['name']) || empty($_POST['is_show_update']) || (empty($_POST['as1']) && empty($_POST['as2']) && empty($_POST['as3']) && empty($_POST['as4']) && empty($_POST['as5'])) || (empty($_POST['as1_id']) && empty($_POST['as2_id']) && empty($_POST['as3_id']) && empty($_POST['as4_id']) && empty($_POST['as5_id']))) {
                $this->error('请完善表单');
            } else {
                $poll = D('Poll');
                $is_show = $_POST['is_show_update'] == 'y' ? 1 : 0;
                $poll->execute("update bink_poll set name='" . $_POST['name'] . "', is_show=$is_show  where id=" . $_POST['hidden_update']);
                for ($i = 1; $i <= 5; $i++) {
                    if (!empty($_POST['as' . $i])) {
                        $as_name = $_POST['as' . $i];
                        $as_is_head = 0;
                        $as_is_show = $_POST['is_show_update'] == 'y' ? 1 : 0;
                        $as_f_name = $_POST['name'];
                        $as_id = $_POST['as' . $i . '_id'];
                        if (!empty($as_id)) {
                            $poll->execute("update bink_poll set name='$as_name',is_show=$as_is_show,f_name='$as_f_name' where id=$as_id");
                        } else {
                            $poll->execute("insert into bink_poll(name,is_show,is_head,f_name,f_id)values('$as_name',$as_is_show,$as_is_head,'$as_f_name',".$_POST['hidden_update'].")");
                        }
                    }
                    else{
                        if(!empty($_POST['as' . $i . '_id'])){
                            $poll->execute("delete from bink_poll where id=".$_POST['as' . $i . '_id']);
                        }
                    }
                }

                $this->success("更新成功");
            }
        } else {
            $this->error("非法调用");
        }
    }

    function get_poll_info() {
        if (!empty($_GET['head_id'])) {
            $poll = D('Poll');

            $result = $poll->where('id=' . $_GET['head_id'])->select();
            if (count($result) == 1) {
                $list = $result[0];
                $result = $poll->query("select * from bink_poll where f_id=" . $_GET['head_id']);
                $list['a'] = $result;
                echo json_encode($list);
            } else {
                echo json_encode('');
            }
        } else {
            echo json_encode('');
        }
    }

}
?>
