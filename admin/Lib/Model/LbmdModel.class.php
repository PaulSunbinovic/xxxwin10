<?php
class LbmdModel extends Action{
	//setleft getlbls getmdlsbylbid getmdobymdmk
	//
	//############test
	public function setleft($usrid,$mdmk){
		$info=collectinfo(__METHOD__,'$usrid',array($usrid));
		####
		$lbmd=D('lbmd');$rbac=D('RBAC');

		if($usrid===''){return createarrerr('error_code','usrid不能为空',$info);}

		//首先获取列表
		$arr_lbls=$lbmd->getlbls();
		$lbls=$arr_lbls['data'];
		$lblsnw=array();
		foreach($lbls as $lbv){
			$arr_mdls=$lbmd->getmdlsbylbid($lbv['lbid']);
			$mdls=$arr_mdls['data'];
			//1 权限判断 2 哪个页面开那个
			$mdlsnw=array();
			$dspl=0;
			foreach($mdls as $mdv){

				$arr_atho=$rbac->getatho($usrid,$mdv['mdid']);
				
				$atho=$arr_atho['data'];
				//看不到么就算单，反正不显示，看得到的情况下考虑显示效果
				if($atho['athv']==1){
					//默认
					$mdv['cls']='default';
					//如果mdmk存在的话说明进入了相应的md里面
					if($mdmk){
						$arr_mdo=$lbmd->getmdobymdmk($mdmk);
						$mdo=$arr_mdo['data'];
						if($mdo['mdid']==$mdv['mdid']){$dspl++;$mdv['cls']='success';}
					}
					
					array_push($mdlsnw,$mdv);
				}
			}
			if($mdlsnw){
				if($dspl>0){$a="";$b='true';$c='in';}else{$a="class='collapsed'";$b='false';$c='';}
				$lbv['a']=$a;$lbv['b']=$b;$lbv['c']=$c;
				$lbv['mdls']=$mdlsnw;
				array_push($lblsnw,$lbv);
			}
			
		}
		$this->assign('lbls',$lblsnw);
		
		return createarrok('ok',$data,'',$info);
	}
	
	####
	public function getlbls(){
		$info=collectinfo(__METHOD__,'',array());
		$lb=M('lb');
		$lbls=$lb->order('lbodr ASC')->select();
		return createarrok('ok',$lbls,'',$info);
	}
	###
	public function getmdlsbylbid($lbid){
		$info=collectinfo(__METHOD__,'$para1,$para2',array($para1,$para2));

		if($lbid===''){return createarrerr('error_code','lbid不能为空',$info);}

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
} 
?>