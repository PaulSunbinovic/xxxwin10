<?php
// 本类由系统自动生成，仅供测试用途
class AaaAction extends Action {

	private  $para=1;

	// public function __construct(){
	// 	$this->aaa = 222;

	// }

    public function display(){
    	header("Content-Type:text/html; charset=utf-8");
    	$para=$this->para;
		$this->display('test');
    }
    public function ajax(){
    	header("Content-Type:text/html; charset=utf-8");
    	$data['arr']=$arr;$data['rslt']=$rslt;$data['msg']=$msg;
		$this->ajaxReturn($data,'json');
    }
   

}