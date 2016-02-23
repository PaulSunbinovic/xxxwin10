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
	
	
	

} 
?>