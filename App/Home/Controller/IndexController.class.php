<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }
    public function Category(){
        $this->display();
    }
    public function Detail(){
        $this->display();
    }
}