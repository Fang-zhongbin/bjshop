<?php 
namespace Admin\Controller;

use Think\Controller;

class GoodsController extends Controller
{
	public function add()
	{
		if(IS_POST){
			$goodsmodel=D('Goods');
			if($goodsmodel->create()){
				if($goodsmodel->add()){
					$this->success('添加成功!',U('lst'));exit;
				}else{
					$this->error('添加失败!');
				}
			}else{
				$this->error($goodsmodel->getError());
			}
		}
		$catemodel=D('Category');
		$catedata=$catemodel->getTree();
		$this->assign('catedata',$catedata);
		$this->display();
	}
	public function lst()
	{
		$goodsmodel=D('Goods');
		$goodsdata=$goodsmodel->field()->select();
		$this->assign('goodsdata',$goodsdata);
		$this->display();
	}
	//货品管理
	public function product()
	{
		//接受传过来的id
		$goods_id=$_GET['id'];
		$sql="";
		$data=M()->query($sql);
		$this->display();
	}
}



 ?>