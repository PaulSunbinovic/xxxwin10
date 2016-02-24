<?php
class AthModel extends Action{
	//test
	//
	//############test
	public function addbymdid($mdid){
		$info=collectinfo(__METHOD__,'$mdid',array($mdid));
		if(isset($mdid)===false){return createarrerr('error_code','mdid 不能为空',$info);}//防止NULL
		
		$ath=M('ath');$rl=M('rl');
		$rlls=$rl->select();
		foreach($rlls as $rlv){
			$rlid=$rlv['rlid'];
			$dt=array(
                'f_ath_rlid'=>$rlid,
                'f_ath_mdid'=>$mdid,
                'atha'=>0,
                'athd'=>0,
                'athm'=>0,
                'athv'=>0,
                'aths'=>0
                );
            $ath->data($dt)->add();
		}


		return createarrok('ok',$data,'',$info);
	}

	//############test
	public function addbyrlid($rlid){
		$info=collectinfo(__METHOD__,'$rlid',array($rlid));
		if(isset($rlid)===false){return createarrerr('error_code','rlid 不能为空',$info);}//防止NULL
		
		$ath=M('ath');$md=M('md');
		$mdls=$md->select();
		foreach($mdls as $mdv){
			$mdid=$mdv['mdid'];
			$dt=array(
                'f_ath_rlid'=>$rlid,
                'f_ath_mdid'=>$mdid,
                'atha'=>0,
                'athd'=>0,
                'athm'=>0,
                'athv'=>0,
                'aths'=>0
                );
            $ath->data($dt)->add();
		}


		return createarrok('ok',$data,'',$info);
	}

	


	//############test
	public function getmlsbyrlid($rlid){
		$info=collectinfo(__METHOD__,'$rlid',array($rlid));
		if(isset($rlid)===false){return createarrerr('error_code','rlid 不能为空',$info);}//防止NULL

		$ath=M('ath');
		$athls=$athwhere('f_ath_rlid='.$rlid)->select();

		return createarrok('ok',$athls,'',$info);
	}
	
	//############test
	public function deletebyrlid($rlid){
		$info=collectinfo(__METHOD__,'$rlid',array($rlid));
		if(isset($rlid)===false){return createarrerr('error_code','rlid 不能为空',$info);}//防止NULL
		
		$arr_athls=$this->getmlsbyrlid($rlid);$athls=$arr_athls['data'];
		foreach($athls as $athv){
			$this->delete($athv['athid']);
		}

		return createarrok('ok',$data,'',$info);
	}

	//############test
	public function getmlsbymdid($mdid){
		$info=collectinfo(__METHOD__,'$mdid',array($mdid));
		if(isset($mdid)===false){return createarrerr('error_code','mdid 不能为空',$info);}//防止NULL

		$ath=M('ath');
		$athls=$ath->where('f_ath_mdid='.$mdid)->select();

		return createarrok('ok',$athls,'',$info);
	}
	
	//############test
	public function deletebymdid($mdid){
		$info=collectinfo(__METHOD__,'$mdid',array($mdid));
		if(isset($mdid)===false){return createarrerr('error_code','mdid 不能为空',$info);}//防止NULL
		
		$arr_athls=$this->getmlsbymdid($mdid);$athls=$arr_athls['data'];
		foreach($athls as $athv){
			$this->delete($athv['athid']);
		}

		return createarrok('ok',$data,'',$info);
	}

	####
	public function delete($athid){
		$info=collectinfo(__METHOD__,'$athid',array($athid));
		if(isset($athid)===false){return createarrerr('error_code','athid 不能为空',$info);}//防止NULL
		
		$ath=M('ath');
		$ath->where('athid='.$athid)->delete();
		      	
		return createarrok('ok',$data,'',$info);
	}

	

	
} 
?>