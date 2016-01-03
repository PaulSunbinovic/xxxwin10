'<?php
class SSModel extends Action{
	//setss 
	//session('usridss',null);cookie('usridck',null);
	############test
	public function setss(){
		
		$info=collectinfo(__METHOD__,'',array());
		######
		$usr=D('Usr');$rbac=D('RBAC');
		//######酱紫，session设置只有两个入口，一个是这里把合法的usridck转化成usridss，另外一种就是登入的时候转换，其他情况不允许
		$usrid=session('usridss');
		if($usrid){
			if(cookie('usridck')&&cookie('usridck')!==$usrid){cookie('usridck',null);}
		}else{
			if(cookie('usridck')){$usrid=cookie('usridck');session('usridss',$usrid);}
		}
		if($usrid){
			$arr=$usr->getusrobyusrid($usrid);
			$usross=$arr['data'];
			if($usross&&$usross['usrps']==='1'){
				//获取用户的角色
				$arr_rlnms=$rbac->getusrrlnms($usrid);
				$rlnms=$arr_rlnms['data'];
				$usross['rlnms']=$rlnms;
				$this->assign('usross',$usross);
			}else if($usross&&$usross['usrps']==='0'){
				cookie('usridck',null);session('usridss',null);
			}
		}
		
		return createarrok('ok',$usross,'',$info);
		
	}


} 
?>