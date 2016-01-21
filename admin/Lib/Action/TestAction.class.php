<?php
// 本类由系统自动生成，仅供测试用途
class TestAction extends Action {
    public function test(){
    	header("Content-Type:text/html; charset=utf-8");
		$str='aaa bbb';
		$str=urlencode($str);
		$url='localhost/xxx/admin.php/Test/monihoutai/str/'.$str;
		url2arr($url,'');
    }
    public function monihoutai(){
    	$str=$_GET['str'];echo $str.'111';
    }

}