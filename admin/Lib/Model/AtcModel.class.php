<?php
class AtcModel extends Action{
	
	//公版
	public function getmo($atcid){
		$info=collectinfo(__METHOD__,'$atcid',array($atcid));
		if(isset($atcid)===false){return createarrerr('error_code','atcid 不能为空',$info);}//防止NULL
		
		$atc=M('atc');
		$atco=$atc->join('tb_bd ON f_atc_bdid=bdid')->where('atcid='.$atcid)->find();

		
		return createarrok('ok',$atco,'',$info);
	}

	// //公版
	// public function getmls(){
	// 	$info=collectinfo(__METHOD__,'',array());
	// 	$atc=M('atc');
	// 	$atcls=$atc->join('tb_bd ON f_atc_bdid=bdid')->select();
	// 	return createarrok('ok',$atcls,'',$info);
	// }

	// //公版
	// public function getmlsbybdid($bdid){
	// 	$info=collectinfo(__METHOD__,'$bdid',array($bdid));
	// 	if(isset($bdid)===false){return createarrerr('error_code','bdid 不能为空',$info);}//防止NULL

	// 	$atc=M('atc');
	// 	$atcls=$atc->join('tb_bd ON f_atc_bdid=bdid')->where('f_atc_bdid='.$bdid)->select();

	// 	return createarrok('ok',$atcls,'',$info);
	// }
	
	// //公版
	// public function deletebybdid($bdid){
	// 	$info=collectinfo(__METHOD__,'$bdid',array($bdid));
	// 	if(isset($bdid)===false){return createarrerr('error_code','bdid 不能为空',$info);}//防止NULL
		
	// 	$arr_atcls=$this->getmlsbybdid($bdid);$atcls=$arr_atcls['data'];
	// 	foreach($atcls as $atcv){
	// 		$this->delete($atcv['atcid']);
	// 	}

	// 	return createarrok('ok',$data,'',$info);
	// }

	// //公版
	// public function delete($atcid){
	// 	$info=collectinfo(__METHOD__,'$atcid',array($atcid));
	// 	if(isset($atcid)===false){return createarrerr('error_code','atcid 不能为空',$info);}//防止NULL
		
	// 	$atc=M('atc');$bdatc=D('Ccatc');
	// 	$atc->where('atcid='.$atcid)->delete();
	// 	//删除依赖
 //      	$bdatc->deletebyatcid($atcid);
      	
	// 	return createarrok('ok',$data,'',$info);
	// }

	//公版
	public function add($get){
		$info=collectinfo(__METHOD__,'$get',array($get));
		if(isset($get)===false){return createarrerr('error_code','get 不能为空',$info);}//防止NULL
		
		$atc=M('atc');
		$atc->data($get)->add();

		return createarrok('ok',$data,'',$info);
	}

	//公版
	public function mdf($get,$atcid){
		$info=collectinfo(__METHOD__,'$get,$id',array($get,$atcid));
		if(isset($get)===false){return createarrerr('error_code','get 不能为空',$info);}//防止NULL
		if(isset($atcid)===false){return createarrerr('error_code','atcid 不能为空',$info);}//防止NULL

		$atc=M('atc');
		$atc->where('atcid='.$id)->setField($get);

		return createarrok('ok',$data,'',$info);
	}

	//
	public function addatccnt($origincnt,$atcid){
		$info=collectinfo(__METHOD__,'$origincnt,$atcid',array($origincnt,$atcid));
		if(isset($origincnt)===false){return createarrerr('error_code','origincnt 不能为空',$info);}//防止NULL
		if(isset($atcid)===false){return createarrerr('error_code','atcid 不能为空',$info);}//防止NULL

		$atc=M('atc');
		$nwcnt=$origincnt+1;
		$dt=array('atccnt'=>$nwcnt);
		$atc->where('atcid='.$atcid)->setField($dt);

		return createarrok('ok',$nwcnt,'',$info);
	}



} 
?>