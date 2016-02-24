<?php
class BdModel extends Action{
	//test
	//
	//############test
	public function getmlsbyodr($odr){
		$info=collectinfo(__METHOD__,'$odr',array($odr));
		if(isset($odr)===false){return createarrerr('error_code','odr 不能为空',$info);}//防止NULL
		
		$bd=M('bd');

		$bdls=$bd->order($odr)->select();

		return createarrok('ok',$bdls,'',$info);
	}
	
	//############test
	public function delete($bdid){
		$info=collectinfo(__METHOD__,'$bdid',array($bdid));
		if(isset($bdid)===false){return createarrerr('error_code','bdid 不能为空',$info);}//防止NULL
		
		$bd=M('bd');$atc=D('Atc');

		$bd->where('bdid='.$bdid)->delete();

		//删板块会导致atc相应的数据删除
      	$atc->deletebybdid($bdid);

      	
		return createarrok('ok',$data,'',$info);
	}

	//############test
	public function getmo($bdid){
		$info=collectinfo(__METHOD__,'$bdid',array($bdid));
		if(isset($bdid)===false){return createarrerr('error_code','bdid 不能为空',$info);}//防止NULL
		
		$bd=M('bd');
		$bdo=$bd->where('bdid='.$bdid)->find();

		
		return createarrok('ok',$bdo,'',$info);
	}
	

} 
?>