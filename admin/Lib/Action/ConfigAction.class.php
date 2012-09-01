<?php

class ConfigAction extends BaseAction {

    function op() {
        $sql = "select * from ".C('DB_PREFIX')."config";
        $data = get_pager($sql);
        $this->assign('pager', $data['pager']);
        $this->assign('config',$data['list']);
        $this->display();
    }
    function config_add(){
        $this->assign("url", "__URL__/op");

        if (check_get('name,words')) {
            $this->error("请填写完整！");
        } else {
            $data = $_POST;
            if (D("Config")->add($data)) {
                $this->success("添加成功");
            } else {
                $this->error("添加失败");
            }
        }
    }
    function config_update(){
        $this->assign("url", "__URL__/op");

        if (check_get('name,words')) {
            $this->error("请填写完整！");
        } else {
            $data = $_POST;
            
            if (D("Config")->save($data)) {
                $this->success("更新成功");
            } else {
                $this->error("更新失败");
            }
        }
    }
    function config_delete(){
        $this->assign("url", "__URL__/op");
        if (check_get("name")) {
            $this->error("非法调用！");
        }
        if (D('Config')->delete(urldecode($_GET['name']))) {
            $this->success("刪除成功");
        } else {
            $this->error("刪除失败");
        }
    }
    


    //----------------------------功能--------------------------------------------
    function get_config() {
        $name = strval($_GET['name']);
        if ($name) {
            $data['name']=$name;
            $data['words'] = get_config($name);
            if ($data['words']) {
                die(json_encode(array('error' => FALSE, 'data' => $data)));
            } else {
                die(json_encode(array('error' => TRUE,'msg' => '读取配置错误')));
            }
        } else {
            die(json_encode(array('error' => TRUE,'msg' => '调用错误')));
        }
    }

}
?>