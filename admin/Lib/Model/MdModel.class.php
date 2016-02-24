<?php
class MdModel extends Action{
	//setleft getlbls getmdlsbylbid getmdobymdmk
	//
	
	
	###
	public function getmdlsbylbid($lbid){
		$info=collectinfo(__METHOD__,'$para1,$para2',array($para1,$para2));

		if($lbid==''){return createarrerr('error_code','lbid不能为空',$info);}

		$md=M('md');
		$mdls=$md->where('f_md_lbid='.$lbid)->order('mdodr ASC')->select();
		
		return createarrok('ok',$mdls,'',$info);
	}
	############test
	public function getmdobymdmk($mdmk){
		$info=collectinfo(__METHOD__,'$mdmk',array($mdmk));
		if(isset($mdmk)===false){return createarrerr('error_code','mdmk不能为空',$info);}
		
		$md=M('md');
		$mdo=$md->where("mdmk='".$mdmk."'")->find();

		return createarrok('ok',$mdo,'',$info);
	}
	####
	public function deletebylbid($lbid){
		$info=collectinfo(__METHOD__,'$lbid',array($lbid));
		if(isset($lbid)===false){return createarrerr('error_code','lbid 不能为空',$info);}//防止NULL
		
		$arr_mdls=$this->getmdlsbylbid($lbid);$mdls=$arr_mdls['data'];
		foreach($mdls as $mdv){
			$this->delete($mdv['mdid']);
		}

		return createarrok('ok',$data,'',$info);
	}
	####
	public function delete($mdid){
		$info=collectinfo(__METHOD__,'$mdid',array($mdid));
		if(isset($mdid)===false){return createarrerr('error_code','mdid 不能为空',$info);}//防止NULL
		
		$md=M('md');$ath=D('Ath');
		$md->where('mdid='.$mdid)->delete();
		//删除依赖
		$ath->deletebymdid($mdid);

		return createarrok('ok',$data,'',$info);
	}

} 
?>