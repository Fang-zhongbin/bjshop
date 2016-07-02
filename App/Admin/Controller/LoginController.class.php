<?php 
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{
	public function login()
	{
		if(IS_POST){
			$adminmidel=D('Admin');
			if($adminmodel->_validate($adminmodel->_login_validate)->create()){
				echo 'ok';
			}else{
				$this->error($adminmodel->getError());
			}
		}
		$this->display();
	}
	public function authcode()
	{
		$config=array(
			'fontsize' =>20,//验证码字体大小
			'length'  => 4,//验证码位数
			'useNoise' => false,//关闭验证码杂点
			'imageW'  =>  170,//验证码图片宽度
			'imageH'  =>  50,  //验证码图片高度
		);
		$verify = new \Think\Verify($config);//new生成验证码的对象
		$verify->entry();//调用这个方法
	}
	
}


 ?>