<?php 
namespace Admin\Controller;

use Think\Controller;

class MyController extends Controller
{
	public function _initialize()
	{
		$admin_id=$_SESSION['admin_id'];
		if($admin_id>0){
			return true;
		}else{
			$this->success('必须要登陆',U('Login/login'));
			exit;
		}
	}
}


 ?>