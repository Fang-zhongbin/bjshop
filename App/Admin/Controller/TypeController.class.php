<?php 
namespace Admin\Controller;

use Think\Controller;

class TypeController extends Controller
{
	public function add()
	{
		if(IS_POST){
			$typemodel=D('type');
			//创建数据是自动验证
			$typemodel->create();
			if($typemodel->create(I('post.'),1)){
				//判断有无id字段提交，有则销毁
				//if(isset($typemodel->id)){
					//unset($typemodel->id);
				//}
				
				//echo 'ok';
				//验证成功后入库
				if($typemodel->add()){
					$this->success('添加成功!',U('lst'));
					exit;
				}else{
					$this->error('添加失败!');
				}
				
			}else{
				//输出验证失败后的错误信息
				$this->error($typemodel->getError());
			}
		}
		$this->display();
	}
	//商品类型列表页面
	public function lst()
	{
		//echo 'ok';
		$typemodel=D('Type');
		$typedata=$typemodel->select();
		$this->assign('typedata',$typedata);
		//$this->typedata=$typedata;
		$this->display();
	}
}


 ?>