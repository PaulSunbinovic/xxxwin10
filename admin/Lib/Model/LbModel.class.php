<?php
class LbModel extends Action{
	//getlbls nb()
	//
	
	####
	private  $para=array('lbid'=>'列表ID','lbnm'=>'列表名称','lbodr'=>'列表顺序');
	public function nb($mdmk,$fld,$cdt,$spccdt,$odr,$pagestart,$lmt){
		$info=collectinfo(__METHOD__,'$mdmk,$fld,$cdt,$spccdt,$odr,$pagestart,$lmt',array($mdmk,$fld,$cdt,$spccdt,$odr,$pagestart,$lmt));

		if($mdmk==''){return createarrerr('error_code','mdmk 不能为空',$info);}

		$nb=D('NB');
		########NB搜索
    	$jn=array();
    	if(!$fld){$fld=array('lbid','lbnm','lbodr');}//总para,挡住的意味着默认选中，总para没有挡住的可以选 fld标明选中（包括挡住默认选中的）
    	if(!$cdt){$cdt=array(array('lbnm','类'));}//根据总字段获取cdt,其中挡住的就算了没挡住的需要体现出来，而罗列出来的需要体现
    	if(!$spccdt){$spccdt=array(array('lbid<>0','列表ID不为0【废话只是测试】','1'));}//有多少罗列多少
    	if(!$odr){$odr=array(array('lbodr','ASC'));}//列出多少选多少 ASC DESC ''三种情况
    	$para=$this->para;$this->assign('para',$para);//总字段
    	if(!$pagestart){$pagestart=0;}
    	if(!$lmt){$lmt=10;}
    	$hide=array('lbid');//一般情况下都是一致的
    	$hide_fld=$hide;$hide_cdt=$hide;
    	$arr=$nb->getls($para,$mdmk,$jn,$fld,$cdt,$spccdt,$odr,$pagestart,$lmt,$hide_fld,$hide_cdt);
    	$mls=$arr['data'];

    	return createarrok('ok',$mls,'',$info);
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
} 
?>