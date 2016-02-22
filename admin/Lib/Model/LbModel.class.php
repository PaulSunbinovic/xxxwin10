<?php
class LbModel extends Action{
	//getlbls nb()
	//
	
	
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

		if($lbid==''){return createarrerr('error_code','lbid不能为空',$info);}

		$md=M('md');
		$mdls=$md->where('f_md_lbid='.$lbid)->order('mdodr ASC')->select();
		
		return createarrok('ok',$mdls,'',$info);
	}
	############test
	public function getmdobymdmk($mdmk){
		$info=collectinfo(__METHOD__,'$mdmk',array($mdmk));
		if($mdmk==''){return createarrerr('error_code','mdmk不能为空',$info);}
		
		$md=M('md');
		$mdo=$md->where("mdmk='".$mdmk."'")->find();

		return createarrok('ok',$mdo,'',$info);
	}
	#####
	public function dodelete($lbid){
		$info=collectinfo(__METHOD__,'$lbid',array($lbid));
		if(isset($lbid)===false){return createarrerr('error_code','lbid 不能为空',$info);}//防止NULL
		
		//首先把相关的md都删咯
		$md=D('Md');
		$md->deletemdlsbylbid($lbid);

		$lb=M('lb');
		$lb->where('lbid='.$lbid)->delete();

		return createarrok('ok',$data,'',$info);
	}
} 
?>