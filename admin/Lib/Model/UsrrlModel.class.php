<?php
class UsrrlModel extends Action{
	
	//############test
	public function getmlsbyrlid($rlid){
		$info=collectinfo(__METHOD__,'$rlid',array($rlid));
		if(isset($rlid)===false){return createarrerr('error_code','rlid 不能为空',$info);}//防止NULL

		$usrrl=M('usrrl');
		$usrrlls=$usrrl->where('f_usrrl_rlid='.$rlid)->select();

		return createarrok('ok',$usrrlls,'',$info);
	}

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
		
		$arr_usrrlls=$this->getmlsbyrlid($rlid);$usrrlls=$arr_usrrlls['data'];
		foreach($usrrlls as $usrrlv){
			$this->delete($usrrlv['usrrlid']);
		}

		return createarrok('ok',$data,'',$info);
	}

	####
	public function delete($usrrlid){
		$info=collectinfo(__METHOD__,'$usrrlid',array($usrrlid));
		if(isset($usrrlid)===false){return createarrerr('error_code','usrrlid 不能为空',$info);}//防止NULL
		
		$usrrl=M('usrrl');
		$usrrl->where('usrrlid='.$usrrlid)->delete();
		      	
		return createarrok('ok',$data,'',$info);
	}
	

} 
?>