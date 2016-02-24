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
		
		$grp=M('grp');$rl=D('Rl');

		$grp->where('grpid='.$grpid)->delete();

		//删除grp会导致rl相应的数据删除
      	$rl->deletebygrpid($grpid);

      	

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