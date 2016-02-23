<?php
class GrpModel extends Action{
	//test
	//
	//############test
	public function getmlsbyodr($odr){
		$info=collectinfo(__METHOD__,'$odr',array($odr));
		if(isset($odr)===false){return createarrerr('error_code','odr 不能为空',$info);}//防止NULL
		
		$grp=M('grp');

		$grpls=$grp->order($odr)->select();

		return createarrok('ok',$grpls,'',$info);
	}
	
	//############test
	public function delete($grpid){
		$info=collectinfo(__METHOD__,'$grpid',array($grpid));
		if(isset($grpid)===false){return createarrerr('error_code','grpid 不能为空',$info);}//防止NULL
		
		$grp=M('grp');$rl=D('Rl');$ath=D('Ath');$usrrl=D('Usrrl');

		$grp->where('grpid='.$grpid)->delete();

		//删除角色会导致usrrl相应的数据删除
      	$rl->deletebygrpid($grpid);

      	//删除角色会导致usrrl相应的数据删除
      	$usrrl->deletebyrlid($rlid);
      	//删除rl势必造成ath中的相应权限删除
      	$ath->deletebyrlid($rlid);

		return createarrok('ok',$data,'',$info);
	}

	//############test
	public function getmo($grpid){
		$info=collectinfo(__METHOD__,'$grpid',array($grpid));
		if(isset($grpid)===false){return createarrerr('error_code','grpid 不能为空',$info);}//防止NULL
		
		$grp=M('grp');
		$grpo=$grp->where('grpid='.$grpid)->find();

		
		return createarrok('ok',$grpo,'',$info);
	}
	

} 
?>