<?php 
namespace Admin\Controller;

use Think\Controller;

class AttributeController extends Controller
{
	public function add()
	{
		if(IS_POST){
			$attrmodel=D('Attribute');
			if($attrmodel->create()){
				$type_id=(int)I('post.type_id');
				if($attrmodel->add()){
					$this->success('添加成功!',U('lst','array(type_id)'));
					exit;
				}else{
					$this->error('添加失败!',U('add'));
				}
			}else{
				$this->error($attrmodel->getError());
			}
		}
		$typemodel=D('Type');
		//$attrmodel=D('Attribute');
		$typedata=$typemodel->select();
		$this->assign('typedata',$typedata);
		$this->display();
	} 
	public function lst()
	{
		//echo 'ok';
		// $attrmodel=D('Attribute');
		// $attrdata=$attrmodel->select();
		// $this->assign('attrdata',$attrdata);
		//$this->typedata=$typedata;
		$type_id=$_GET['type_id']+0;
		 //判断商品类型的 id如果是0则是显示出所有的属性
                if($type_id==0){
                        $where=1;
                }else{
                        $where="a.type_id=$type_id";
                }
		 //显示出商品类型
                $typemodel = D('Type');
                $typedata = $typemodel->select();
                $this->assign('type_id',$type_id);
                $this->assign('typedata',$typedata);
                $attrmodel = D('Attribute');
                $count      =  $attrmodel->join("a  left join it_type b on a.type_id=b.id")->where($where)->count();// 查询满足要求的总记录数
                $Page       = new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数(25)
                $Page->setConfig('prev','上一页');
                $Page->setConfig('next','下一页');
                $show       = $Page->show();// 分页显示输出
                //取出商品属性数据
                $attrdata = $attrmodel->field("a.*,b.type_name")->join("a  left join it_type b on a.type_id=b.id")->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
                $this->assign('attrdata',$attrdata);
                $this->assign('show',$show);
                $this->display();
	}
}



 ?>