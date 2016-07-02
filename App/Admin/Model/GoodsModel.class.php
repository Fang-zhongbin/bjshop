<?php 
namespace Admin\Model;

use Think\Model;

class GoodsModel extends Model
{
	public function _before_insert(&$data,$options)
	{
		//添加时间
		$data['add_time']=time();
		//接受商品货号
		$goods_sn=I('post.goods_sn');
		//如果没有则随机生成
		if(empty($goods_sn)){
			$goods_sn='sn_'.uniqid();
			$data['goods_sn']=$goods_sn;
		}
		//dump($data);die;
		//文件上传
		//读取配置文件的定义的参数
		$root_path=C('UPLOAD_ROOT_PATH');
		$maxfilesize = (int)C('UPLOAD_MAX_FILESIZE');
		$allow_ext=C('UPLOAD_ALLOW_EXT');
		//取出php.ini中的允许上传文件大小设置值
		$maxfile=(int)ini_get('upload_max_filesize');
		$allow_max_filesize=min($maxfilesize,$maxfile);
		$upload = new \Think\Upload();//实例化上传类
		$upload->maxSize =  $allow_max_filesize*1024*1024;//设置上传附件的大小
		$upload->exts = $allow_ext;//设置允许上传附件类型
		$upload->savePath = 'Goods/';//设置附件上传目录
		$upload->rootPath = $root_path;
		$info=$upload->upload();

		if($info){
			//上传成功
			$goods_ori=$info['goods_img']['savepath'].$info['goods_img']['savename'];
			//还要生成多张缩略图
			$image=new \Think\Image();
			$image->open($root_path.$goods_ori);
			$goods_img=$info['goods_img']['savepath'].'img'.$info['goods_img']['savename'];
			$goods_thumb=$info['goods_img']['savepath'].'thumb'.$info['goods_img']['savename'];
			//在生成多张缩略图时，要先生成大图!!!!!!
			$image->thumb(230,230)->save($root_path.$goods_img);
			$image->thumb(100,100)->save($root_path.$goods_thumb);
			$data['goods_ori']=$goods_ori;
			$data['goods_thumb']=$goods_thumb;
			$data['goods_img']=$goods_img;
            dump($data);die;
		}else{
			$this->error=$upload->getError();
			return false;
		}
		
		
	}
}


 ?>