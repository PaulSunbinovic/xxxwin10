<?php
class RlModel extends Action{
	//test
	//
	//############test
	public function getmlsbygrpid($grpid){
		$info=collectinfo(__METHOD__,'$grpid',array($grpid));
		if(isset($grpid)===false){return createarrerr('error_code','grpid 不能为空',$info);}//防止NULL

		$rl=M('rl');
		$rlls=$rl->join('tb_grp ON f_rl_grpid=grpid')->where('f_rl_grpid='.$grpid)->select();

		return createarrok('ok',$rlls,'',$info);
	}
	
	//############test
	public function deletebygrpid($grpid){
		$info=collectinfo(__METHOD__,'$grpid',array($grpid));
		if(isset($grpid)===false){return createarrerr('error_code','grpid 不能为空',$info);}//防止NULL
		
		$arr_rlls=$this->getmlsbygrpid($grpid);$rlls=$arr_rlls['data'];
		foreach($rlls as $rlv){
			$this->delete($rlv['rlid']);
		}

		return createarrok('ok',$data,'',$info);
	}

	####
	public function delete($rlid){
		$info=collectinfo(__METHOD__,'$rlid',array($rlid));
		if(isset($rlid)===false){return createarrerr('error_code','rlid 不能为空',$info);}//防止NULL
		
		$rl=M('rl');$usrrl=D('Usrrl');$ath=D('Ath');
		$rl->where('rlid='.$rlid)->delete();
		//删除角色会导致usrrl相应的数据删除
      	$usrrl->deletebyrlid($rlid);
      	//删除rl势必造成ath中的相应权限删除
      	$ath->deletebyrlid($rlid);

		return createarrok('ok',$data,'',$info);
	}

} 
?>