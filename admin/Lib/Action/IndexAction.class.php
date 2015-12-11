<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
	//#############test
	public function test(){
		
	}
	//#########index
    public function index(){
    	$usr=D('Usr');$ss=D('SS');$ath=D('ath');

		//###########上面的用户基本信息
		$usross=$ss->setss();
		//经过上一步，就算没有usridss也要有了，这样都没有，哪就是真的没有
		$usridss=session('usridss');
		
		//########上面的权限信息
		if($usridss){
			//根据用户id 和模块id 获取他的权限
			
		}
		

		//###########模块
		

		//###########
    }
}