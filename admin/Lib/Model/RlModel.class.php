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
	

} 
?>