<?php
class UsrrlModel extends Action{
	//test
	//
	//############test
	public function deletebyusrid($usrid){
		$info=collectinfo(__METHOD__,'$usrid',array($usrid));
		if(isset($usrid)===false){return createarrerr('error_code','usrid 不能为空',$info);}//防止NULL
		
		$usrrl=M('usrrl');
		$usrrl->where('f_usrrl_usrid='.$usrid)->delete();

		return createarrok('ok',$data,'',$info);
	}

	//############test
	public function deletebyrlid($rlid){
		$info=collectinfo(__METHOD__,'$rlid',array($rlid));
		if(isset($rlid)===false){return createarrerr('error_code','rlid 不能为空',$info);}//防止NULL
		
		$usrrl=M('usrrl');
		$usrrl->where('f_usrrl_rlid='.$rlid)->delete();

		return createarrok('ok',$data,'',$info);
	}
	

} 
?>