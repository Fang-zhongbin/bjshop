<?php 
namespace Admin\Model;

use Think\Model;

class TypeModel extends Model
{
	//添加数据验证，入库之前的验证，验证数据合法性
	protected $_validate=array(
		//定义表单里的选项
		array('type_name','require','商品类型不能为空'),
		);
	protected $insertFields=array('type_name');
}



 ?>