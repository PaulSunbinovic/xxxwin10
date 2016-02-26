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
		$info=collectinfo(__METHOD__,'$usrnm,$usrpw,$rmb',array($usrnm,$usrpw,$rmb));

		if(isset($usrnm)==false){return createarrerr('error_code','usrnm 不能为空',$info);}
		if(isset($usrpw)==false){return createarrerr('error_code','usrpw 不能为空',$info);}
		if(isset($rmb)==false){return createarrerr('error_code','rmb 不能为空',$info);}

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

	//############test
	public function add($get){
		$info=collectinfo(__METHOD__,'$get',array($get));
		if(isset($get)===false){return createarrerr('error_code','get 不能为空',$info);}//防止NULL
		
		$usr=M('usr');
		$usr->data($get)->add();

		return createarrok('ok',$data,'',$info);
	}

	//############test
	public function mdf($get,$id){
		$info=collectinfo(__METHOD__,'$get,$id',array($get,$id));
		if(isset($get)===false){return createarrerr('error_code','get 不能为空',$info);}//防止NULL
		if(isset($id)===false){return createarrerr('error_code','id 不能为空',$info);}//防止NULL

		$usr=M('usr');
		$usr->where('usrid='.$id)->setField($get);

		return createarrok('ok',$data,'',$info);
	}

	//############test
	public function resetusrpw($id){
		$info=collectinfo(__METHOD__,'',array());
		
		$usr=M('usr');

		$data=array('usrpw'=>md5('11111111'));
		$usr->where('usrid='.$id)->setField($data);

		$msg='重置成功';

		return createarrok('ok',$data,$msg,$info);
	}
	//############test
	public function getmlsbyodr($odr){
		
		$info=collectinfo(__METHOD__,'$odr',array($odr));

		if(isset($odr)==false){return createarrerr('error_code','odr 不能为空',$info);}
		
		$usr=M('usr');
		$usrls=$usr->order('usrodr '.$odr)->select();
		
		return createarrok('ok',$usrls,'',$info);
		
	}

	//############test
	public function delete($usrid){
		$info=collectinfo(__METHOD__,'$usrid',array($usrid));
		if(isset($usrid)===false){return createarrerr('error_code','usrid 不能为空',$info);}//防止NULL
		
		$usr=M('usr');$usrrl=D('Usrrl');

		$usr->where('usrid='.$usrid)->delete();

		//删除usr会导致usrrl相应的数据删除
      	$usrrl->deletebyusrid($usrid);

      	

		return createarrok('ok',$data,'',$info);
	}

	//############test
	public function checkusrpw($usrid,$usrpw){
		$info=collectinfo(__METHOD__,'$usrid,$usrpw',array($usrid,$usrpw));
		if(isset($usrid)===false){return createarrerr('error_code','usrid 不能为空',$info);}//防止NULL
		if(isset($usrpw)===false){return createarrerr('error_code','usrpw 不能为空',$info);}//防止NULL
		
		$usr=M('usr');
		$arr_usro=$this->getusrobyusrid($usrid);$usro=$arr_usro['data'];

		if($usro['usrpw']==md5($usrpw)){
			$rslt=1;
		}else{
			$rslt=0;$msg='原始密码不正确！';
		}
		
		return createarrok('ok',$rslt,$msg,$info);
	}

	public function mdfusrpw($usrid,$usrpw){
		$info=collectinfo(__METHOD__,'$usrid,$usrpw',array($usrid,$usrpw));
		if(isset($usrid)===false){return createarrerr('error_code','usrid 不能为空',$info);}//防止NULL
		if(isset($usrpw)===false){return createarrerr('error_code','usrpw 不能为空',$info);}//防止NULL
		
		$usr=M('usr');
		$dt=array('usrpw'=>md5($usrpw));
		$usr->where('usrid='.$usrid)->setField($dt);

		return createarrok('ok',$data,'',$info);
	}
} 
?>