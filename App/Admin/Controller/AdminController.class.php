<?php 
namespace Admin\Controller;

use Think\Controller;

class AdminController extends Controller
{
	public function add()
	{
		if(IS_POST){
			$adminmodel=D('Admin');
			if($adminmodel->create()){
				$salt=substr(uniqid(),-6);
				$pwd=I('post.password');
				$adminmodel->password=md5(md5($pwd).$salt);
				$adminmodel->salt=$salt;
				if($adminmodel->add()){
					$this->success('添加成功',U('lst'));exit;
				}else{
				$this->error('添加失败');
				}
				
			}
		}
		$rolemodel=D('Role');
		$roledata=$rolemodel->select();
		$this->assign('roledata',$roledata);
		$this->display();
	}
	public function lst()
	{
		$adminmodel=D('Admin');
		$admindata=$adminmodel->field("a.*,c.role_name")->join("a left join it_admin_role b on a.id=b.admin_id left join it_role c on b.role_id=c.id")->where("a.id!=1")->select();
		$this->assign('admindata',$admindata);
		$this->display();
	}
	public function update()
	{
		$id=$_GET['id']+0;
		//判断提交的id的合法性
		if($id==1){
			$this->error('参数错误!');
		}
		$adminmodel->D('Admin');
		$info = $adminmodel->find($id);
		//查找不到管理员
		if(!$info){
			$this->error('参数错误');
		}
		$this->assign('info',$info);
		$this->display();
	}
}



 ?>