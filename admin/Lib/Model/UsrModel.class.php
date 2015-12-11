<?php
class UsrModel{
	//###################
	//getusro()
	//############test
	public function test(){
		return $test;
	}
	//############test
	public function getusro($usrid){
		$usr=M('usr');
		$usro=$usr->where('usrid='.$usrid)->find();
		
		return $test;
	}


} 
?>