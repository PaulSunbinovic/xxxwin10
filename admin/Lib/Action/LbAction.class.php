<?php
// 本类由系统自动生成，仅供测试用途
class LbAction extends Action {

	

	
    public function query(){
    	header("Content-Type:text/html; charset=utf-8");
    	$usr=D('Usr');$ss=D('SS');$left=D('Left');$lb=D('Lb');

    	//###########上面的用户基本信息
		$arr_usross=$ss->setss();

		//经过上一步，就算没有usridss也要有了，这样都没有，哪就是真的没有
		$usross=$arr_usross['data'];
		
		$mdmk='Lb';
		//处理左边列表
		$left->setleft($usross['usrid'],$mdmk);
		$arr=$lb->nb($mdmk);
		$this->assign('mls',$arr['data']);

		$this->display('query');
    }
    public function dosearch(){
    	header("Content-Type:text/html; charset=utf-8");
    	p($_GET);die;
    	$data['arr']=$arr;$data['rslt']=$rslt;$data['msg']=$msg;
		$this->ajaxReturn($data,'json');
    }
   

}