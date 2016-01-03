<?php
class AaaModel extends Action{
	//test
	//
	//############test
	public function test($para1,$para2){
		$info=collectinfo(__METHOD__,'$para1,$para2',array($para1,$para2));
		if(isset($usrnm)===false){return createarrerr('error_code','usrnm不能为空',$info);}
		if($usrnm===''){return createarrerr('error_code','usrnm不能为空',$info);}
		return createarrerr('error_code','',$info);
		return createarrok('ok',$data,'',$info);
	}
	

} 
?>