<?php 
class RBACModel{
	//###################处理权限极其关系问题统一在这里
	//getath() getusrrlnms($usrid)
	
	
	//############test
	public function getatho($usrid,$mdid){
		$info=collectinfo(__METHOD__,'$para1,$para2',array($para1,$para2));
		
		if($usrid==''){return createarrerr('error_code','usrid不能为空',$info);}
		if($mdid==''){return createarrerr('error_code','mdid不能为空',$info);}
		
		
		$usr=D('Usr');
		$arr_usro=$usr->getusrobyusrid($usrid);
		$usro=$arr_usro['data'];
		$usrmk=$usro['usrmk'];
		$usrps=$usro['usrps'];
		if($usrmk==1){
			//超级管理员权限全开
			$atha=1;$athd=1;$athm=1;$athv=1;$aths=1;
		}else if($usrps==0){
			//没有被通过的人被关小黑屋
			$atha=0;$athd=0;$athm=0;$athv=0;$aths=0;
		}else{
			//普通用户就要查下他们再相应的nd的权限//用户必然有grp 必然有rl 必然有ath，至少有默认，因此cdt必然不会1=2 还有其他OR的
			//逻辑优先，用户有多少的rl
			$usrrl=M('usrrl');
			//某用户的rl集
			$usrrlls=$usrrl->join('tb_usr ON f_usrrl_usrid=usrid')->join('tb_rl ON f_usrrl_rlid=rlid')->where('usrid='.$usrid)->select();
			//编辑条件
			$cdt='1=2';
			foreach($usrrlls as $usrrlv){
				$cdt=$cdt.' OR rlid='.$usrrlv['rlid'];
			}
			//查找相关所有rl相对于某个ndid对应的ath
			$ath=M('ath');
			$athls=$ath->where('mdid='.$mdid.' AND ('.$cdt.')')->select();
			//默认权限都没有，除非或出来
			$atha=0;$athd=0;$athm=0;$athv=0;$aths=0;
			//通过或的方法 除非都是0 否则他就有1的权限
			foreach($athls as $athv){
				//如果他们或一下是true 那么就1 否则就 0，不要和true
				if($atha||$athv['atha']){$atha=1;}else{$atha=0;}
				if($athd||$athv['athd']){$athd=1;}else{$athd=0;}
				if($athm||$athv['athm']){$athm=1;}else{$athm=0;}
				if($athv||$athv['athv']){$athv=1;}else{$athv=0;}
				if($aths||$athv['aths']){$aths=1;}else{$aths=0;}
			}
		}
		//##########汇总
		$athofn['atha']=$atha;$athofn['athd']=$athd;$athofn['athm']=$athm;$athofn['athv']=$athv;$athofn['aths']=$aths;
		return createarrok('ok',$athofn,'',$info);;
	}
	//############test
	public function getusrrlnms($usrid){
		$info=collectinfo(__METHOD__,'$para1,$para2',array($para1,$para2));
		if(isset($usrid)===false){return createarrerr('error_code','usrid不能为空',$info);}
		
		$usr=D('Usr');

		$arr_usro=$usr->getusrobyusrid($usrid);
		$usro=$arr_usro['data'];
		if($usro['usrmk']==1){
			$str='超级管理员';
		}else{
			$usrrl=M('usrrl');
			$rlls=$usrrl->join('tb_rl ON f_usrrl_rlid=rlid')->where('usrid='.$usrid)->select();
			$str='';
			foreach($rlls as $rlv){
				$str=$str.$rlv['rlnm'].' ';
			}
		}
		

		return createarrok('ok',$str,'',$info);
	}
	
}

?>