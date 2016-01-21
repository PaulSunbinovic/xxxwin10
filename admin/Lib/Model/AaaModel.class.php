<?php
class AaaModel extends Action{
	//test
	//
	//############test
	public function test($para1,$para2){
		$info=collectinfo(__METHOD__,'$para1,$para2',array($para1,$para2));
		if(isset($usrnm)===false){return createarrerr('error_code','usrnm 不能为空',$info);}//防止NULL
		if($usrnm==''){return createarrerr('error_code','usrnm 不能为空',$info);}//防止NULL或者0或者''★
		return createarrerr('error_code','',$info);
		return createarrok('ok',$data,'',$info);
	}
	########MODEL########################
	public function testjava($id){
		$id=urlencode($id);//防止传递了一些不知道啥的字符
		$url=C('javaback').'';
		$json='';
		$arr=url2arr($url,$json);
		return $arr;
	}

} 
?>