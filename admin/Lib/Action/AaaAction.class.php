<?php
// 本类由系统自动生成，仅供测试用途
class AaaAction extends Action {
    public function display(){
    	header("Content-Type:text/html; charset=utf-8");
		$this->display('test');
    }
    public function ajax(){
    	header("Content-Type:text/html; charset=utf-8");
    	$data['arr']=$arr;$data['rslt']=$rslt;$data['msg']=$msg;
		$this->ajaxReturn($data,'json');
    }
   

}