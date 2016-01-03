<?php
class UsrModel{
	//###################
	//getusrobyusrid()
	//getusrobyusrnm()
	//login
	
	
	//############test
	public function getusrobyusrid($usrid,$usrps){
		
		$info=collectinfo(__METHOD__,'$usrid,$usrps',array($usrid,$usrps));

		if(isset($usrid)==false){return createarrerr('error_code','usrid不能为空',$info);}
		
		$usr=M('usr');
		$str='usrid='.$usrid;
		isset($usrps)?$str=$str.'&usrps='.$usrps:$str=$str;
		$usro=$usr->where($str)->find();
		
		return createarrok('ok',$usro,'',$info);
		
	}
	//############test
	public function getusrobyusrnm($usrnm,$usrps){
		
		$info=collectinfo(__METHOD__,'$usrnm,$usrps',array($usrnm,$usrps));

		if(isset($usrnm)==false){return createarrerr('error_code','usrnm不能为空',$info);}

		$usr=M('usr');
		$str="usrnm='".$usrnm."'";
		isset($usrps)?$str=$str.'&usrps='.$usrps:$str=$str;
		$usro=$usr->where($str)->find();

		return createarrok('ok',$usro,'',$info);
	}
	//############test
	public function login($usrnm,$usrpw,$rmb){
		$info=collectinfo(__METHOD__,'$usrnm,$usrpw',array($usrnm,$usrpw));

		if(isset($usrnm)==false){return createarrerr('error_code','usrnm不能为空',$info);}
		if(isset($usrpw)==false){return createarrerr('error_code','usrpw不能为空',$info);}

		$usr=D('Usr');
		$arr_usro=$usr->getusrobyusrnm($usrnm,1);
		$usro=$arr_usro['data'];

		if($usro){
			if($usro['usrpw']==md5($usrpw)){
				$rslt=1;
				session('usridss',$usro['usrid']);
				if($rmb=='y'){cookie('usridck',$usro['usrid']);}
				$msg='登录成功';
			}else{
				$rslt=0;
				$msg='密码不正确';
			}
		}else{
			$rslt=0;
			$msg='用户名不正确';
		}
		$arr['rslt']=$rslt;
		return createarrok('ok',$arr,$msg,$info);
	
	}


} 
?>