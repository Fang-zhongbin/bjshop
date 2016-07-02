<?php 
namespace Admin\Controller;

use Think\Controller;

class CategoryController extends Controller
{
	//增加栏目
	public function add()
	{
		$catemodel=D('Category');
		if(IS_POST){
			if($catemodel->create()){
				if($catemodel->add()){
					$this->success('添加成功!',U('lst'));
					exit;
				}else{
					$this->error('添加失败!');
				}
			}else{
					$this->error($catemodel->getError());
				}
			
		}
		$catedata=$catemodel->getTree();
		//dump($catedata);die;
		$this->assign('catedata',$catedata);
		$this->display();
	}
	//显示栏目列表
	public function lst()
	{
		$catemodel=D('category');
		$catedata=$catemodel->getTree();
		$this->assign('catedata',$catedata);
		$this->display();
	}
	//删除栏目
	public function del()
	{
		$cat_id=$_GET['cat_id']+0;
		//判断当前栏目下有没有子栏目，有则不能删除
		$catemodel=D('Category');
		$info=$catemodel->where("parent_id=$cat_id")->select();
		if($info){
			$this->error('该栏目下面有子栏目，不能被删除');
		}
		//删除栏目
		if($catemodel->delete($cat_id)!==false){
			$this->success('删除成功!',U('lst'));
		}else{
			$this->error('删除失败!');
		}
	}
	//修改栏目
	public function update()
	{
		$catemodel=D('Category');
		if(IS_POST){
			if($catemodel->create()){
				//注意此处提交要判断父栏目中的id是否是自己或者在自己的子孙栏目里面
				$parent_id=I('post.parent_id');
				$id = I('post.id');
				//查找自己子孙栏目的id
				$ids=$catemodel->getChildId($id);
				$ids[]=$id;
				if(in_array($parent_id,$ids)){
					$this->error('不能把自己的子孙栏目当作自己的父栏目!');
				}
				if($catemodel->save()!==false){
					$this->success('修改成功!',U('lst'));exit;
				}else{
					$this->error('修改失败!');
				}
			}else{
				$this->error($catemodel->getError());
			}
		}
		//接受栏目id
		$cat_id=$_GET['cat_id']+0;
		$info = $catemodel->find($cat_id);
		$this->assign('info',$info);
		//取出当前栏目的子孙栏目
		$ids=$catemodel->getChildId($cat_id);
		$ids[]=$cat_id;
		$this->assign('ids',$ids);
		//取出所有栏目的数据
		$catemodel=D('Category');
		$catedata=$catemodel->getTree();
		$this->assign('catedata',$catedata);
		$this->display();
	}
}



 ?>