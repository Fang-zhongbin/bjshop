<?php 
namespace Admin\Controller;

use Think\Controller;

/**
*
* 
*/
class RoleController extends Controller
{
	
	public function add()
	{
		$this->display();
	}
	public function lst()
	{
		$rolrmodel=D('Role');
		$roledata=$rolemodel->field()->join()->group()->select();
		$this->assign('roledata',$roledata);
		$this->display();
	}
	public function del()
	{
		//接受穿过来的角色id
		$id=$_GET['id']+0;
		//判断该角色下有没有管理员
		//查询it_admin_role表，条件是role_id
		$info=M('AdminRole')->where('role_id=$role_id')-find();
		if($info){
			$this->error('该角色有管理员不能被删除!');
		}
		$rolemodel=D('Role');
		if($rolemodel->delete($role_id)!==false){
			$this->success('角色删除成功!',U('lst'));exit;
		}else{
			$this->error('删除角色失败');
		}
	}
}


 ?>