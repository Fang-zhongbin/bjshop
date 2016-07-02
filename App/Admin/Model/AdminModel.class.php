<?php 
namespace Admin\Model;

use Think\Model;

class AdminModel extends Model
{
	//使用动态方式完成自定义规则
	public $_login_validate = array(
		array('admin_name','require','管理员名称不能为空'),
		array('password','require','密码不能为空'),
		array('checkcode','check_verify','验证码输入错误',1,'callback',),
		);
	//验证码验证方式
	public function chech_verify($code,$id='')
	{
		$verify=new \Think\Verify();
		return $verify->check($code,$id);
	}
	//使用静态方法完成管理员添加的验证
	protected $_validate=array(
		array('admin_name','require','管理员名称不能为空'),
		array('admin_name','','管理员已经存在',1,'unique'),
		array('password','6,12','密码长度要在6-12位之间',1,'length'),
		array('repassword','password','两次输入密码要一至',1,'confirm'),
		array('role_id','number','要选择角色'),
		);
	//管理员登陆的验证方法
	public function login()
	{
		//接受传递的用户名及密码
		$admin_name=I('post.admin_name');
		$password=I('post.password');
		//根据用户名查出用户名及密码，与输入的对比查看是否正确
		$info=$this->where("'admin_name='$admin_name'")->find();
		if(!empty($info)){
			if($info[password]==md5(md5($password).$info['salt'])){
				$_SESSION['admin_name']=$admin_name;
				$_SESSION['password']=$password;
			}
		}
	}
	protected function _after_insert($data,$options)
	{
		//完成it_admin_role数据入库，
		//接受传递过来的role_id
		p($data);
		P($options);exit;
		$admin_id=$data['id'];
		$role_id=I('post.role_id');

	}
	//根据登陆的管理员获取管理员权限数据显示不同的权限列表，超级管理员显示全部权限
	public function getButton()
	{
		//获取登陆人员的id
		$admin_id=$_SESSION['admin_id'];
		//判断登陆人员身份
		if($admin_id==1){
			//超级管理员
			//取出顶级权限
			$sql="select *from it_privilege where parent_id=0";
			$data=M()->query($sql);//返回一个二维数组
			foreach($data as $v){
				$v['child']=M()->query("select *from it_privilege where parent_id=".$v['id']);
				$list[]=$v;
			}
		}else{
			//普通管理员
			$sql="select * from it_admin_role a left join it_role_privilege b on a.role_id=b.role_id left join it_privilege c on b.priv_id=c.id where a.admin_id=$admin_id";
			$data=M()->query($sql);
			$list[]=array();
		}
		return $list;
	}
}


 ?>