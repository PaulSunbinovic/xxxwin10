<?php
class EnvironmentModel extends Action{
	//test
	//
	//############test
	public function setenvironment($mdmk){
		$info=collectinfo(__METHOD__,'$mdmk',array($mdmk));
		$usr=D('Usr');$ss=D('SS');$left=D('Left');$rbac=D('RBAC');$md=D('Md');
		//###########上面的用户基本信息
		$arr_usross=$ss->setss();

		//经过上一步，就算没有usridss也要有了，这样都没有，哪就是真的没有
		$usross=$arr_usross['data'];
		
		
		//设置权限
		$arr_md=$md->getmdobymdmk($mdmk);
		$arr_atho=$rbac->getatho($usross['usrid'],$arr_md['data']['mdid']);
		$this->assign('atho',$arr_atho['data']);
		//处理左边列表
		$left->setleft($usross['usrid'],$mdmk);



		return createarrok('ok',$usross,'',$info);
	}
	
} 
?>