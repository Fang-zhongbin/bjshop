<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }
    public function top(){
        $this->display();
    }
    public function left(){
        $adminmodel=D('');
        $admindata=$adminmodel->select();
        $this->assign('admindata',$admindata);
        $this->display();
    }
    public function drag(){
        $this->display();
    }
    public function main(){
        $this->display();
    }
}