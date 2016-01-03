<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
	
	//#########index
    public function index(){
    	header("Content-Type:text/html; charset=utf-8");
    	$usr=D('Usr');$ss=D('SS');$lbmd=D('Lbmd');

    	//###########上面的用户基本信息
		$arr_usross=$ss->setss();

		//经过上一步，就算没有usridss也要有了，这样都没有，哪就是真的没有
		$usross=$arr_usross['data'];
		
		//########上面的权限信息
		if($usross){
			
			if($usross['usrps']==='1'){
				//处理左边列表
				$lbmd->setleft($usross['usrid']);
				//处理右边
				$this->display('manager');
			}else{
				$this->display('notpass');
			}
			
			
			
		}else{
			//如果没有usrid么肯定是没登录过
			$this->display('login');
		}
		

	}
}