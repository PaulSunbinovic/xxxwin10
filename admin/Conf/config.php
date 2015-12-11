<?php
C('zidingyi','在此定义的C方法变量，全局都能用');
//#######################配置PUBLIC路径和项目路径
$host=$_SERVER['HTTP_HOST'];//e.g.:localhost
$php_self=$_SERVER['PHP_SELF'];//e.g.: /evc/index.php/
$tmp=explode('/',$php_self);
$prjct=$tmp[1];//e.g.:evc
$urlprx='http://'.$host.'/'.$prjct;
//####
C('PUBLIC','/'.$prjct.'/Public');
C('HOST',$urlprx);

//####################配置参数（包括数据库）
$arr1=array(
	//'配置项'=>'配置值'
	'URL_MODEL'	=>1,//path-info 模式
	//'SHOW_PAGE_TRACE' =>true,   
	//'SHOW_RUN_TIME' =>true,   //显示运行时间
	//'SHOW_ADV_TIME' =>true,   //显示详细的运行时间
	//'SHOW_DB_TIMES'=>true,//显示数据库操作次数
	//'SHOW_CACHE_TIMES'=>true,//显示缓存操作次数
	//'SHOW_USE_MEM'=>true,//显示内存开销
);

$arr2=include './config.inc.php';
return array_merge($arr1,$arr2);
?>