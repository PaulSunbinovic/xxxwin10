<?php
// 本类由系统自动生成，仅供测试用途
class UsrAction extends Action {
	//dologin
	
	//#########index
    public function dologin(){
    	header("Content-Type:text/html; charset=utf-8");
		    
    	$usr=D('Usr');
		
    	$usrnm=$_GET['usrnm'];
    	$usrpw=$_GET['usrpw'];
    	$rmb=$_GET['rmb'];

    	$arr=$usr->login($usrnm,$usrpw,$rmb);
    	$rslt=$arr['data']['rslt'];
    	$msg=$arr['msg'];

    	$data['rslt']=$rslt;$data['msg']=$msg;
		$this->ajaxReturn($data,'json');
	}
}