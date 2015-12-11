<?php
class SSModel{
	//###################处理Session
	//setss
	//
	//############test
	public function test(){
		return $test;
	}
	//############test
	public function setss(){
		$usr=M('usr');
		//######酱紫，session设置只有两个入口，一个是这里把合法的usridck转化成usridss，另外一种就是登入的时候转换，其他情况不允许
		if(cookie('usridck')){
			if($usr->where('usrid='.cookie('usridck').' AND usrps=1')->find()){
				session('usridss',cookie('usridck'));
			}
		}
		$usrid=session('usridss');
		$usross=$usr->where('usrid='.$usrid)->find();
		//#########如果有就是返回实体，没有返回空了
		$this->assign('usross',$usross);
		return $usross;
	}


} 
?>