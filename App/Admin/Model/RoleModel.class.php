<?php 
namespace Admin\Model;

use Think\Model;

class RoleModel EXTENDS Model
{
	public function _after_insert()
	{

	}
	protected function _after_del($data,$options)
	{
		$role_id=$options['where']['id'];
		M('RolePrivilege')->where()->delete();
	}
}

 ?>