<?php
class SysModel extends Action{
	//test
	//
	//############test
	public function get($id){
		$info=collectinfo(__METHOD__,'$id',array($id));
		if(isset($id)===false){return createarrerr('error_code','id 不能为空',$info);}//防止NULL
		
		$sys=M('sys');
		$syso=$sys->where('sysid='.$id)->find();

		return createarrok('ok',$syso,'',$info);
	}
	
} 
?>