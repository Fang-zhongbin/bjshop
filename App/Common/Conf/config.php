<?php
return array(
	//'配置项'=>'配置值'
	 /* 数据库设置 */
    'DB_TYPE'               =>  'Mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  '0624shop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '100510',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'it_',    // 数据库表前缀
     /* URL设置 */
    'URL_MODEL'             =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    'URL_PATHINFO_DEPR'     =>  '/',	// PATHINFO模式下，各参数之间的分割符号
    'UPLOAD_ROOT_PATH'=>'./Public/Uploads/',   //上传文件保存根路径
    'UPLOAD_MAX_FILESIZE' => '10M',  //允许上传文件大小
    'UPLOAD_ALLOW_EXT' => array('jpeg','jpg','png','gif','bmp'), //允许上传文件类型
);