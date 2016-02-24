<?php
class AaModel extends Action{
	
	//############test
	public function getmo($aaid){
		$info=collectinfo(__METHOD__,'$aaid',array($aaid));
		if(isset($aaid)===false){return createarrerr('error_code','aaid 不能为空',$info);}//防止NULL
		
		$aa=M('aa');
		$aao=$aa->where('aaid='.$aaid)->find();

		
		return createarrok('ok',$aao,'',$info);
	}

	####
	public function getmls(){
		$info=collectinfo(__METHOD__,'',array());
		$aa=M('aa');
		$aals=$aa->join('tb_cc ON f_aa_ccid=ccid')->select();
		return createarrok('ok',$aals,'',$info);
	}

	//############test
	public function getmlsbyccid($ccid){
		$info=collectinfo(__METHOD__,'$ccid',array($ccid));
		if(isset($ccid)===false){return createarrerr('error_code','ccid 不能为空',$info);}//防止NULL

		$aa=M('aa');
		$aals=$aa->join('tb_cc ON f_aa_ccid=ccid')->where('f_aa_ccid='.$ccid)->select();

		return createarrok('ok',$aals,'',$info);
	}
	
	//############test
	public function deletebyccid($ccid){
		$info=collectinfo(__METHOD__,'$ccid',array($ccid));
		if(isset($ccid)===false){return createarrerr('error_code','ccid 不能为空',$info);}//防止NULL
		
		$arr_aals=$this->getmlsbyccid($ccid);$aals=$arr_aals['data'];
		foreach($aals as $aav){
			$this->delete($aav['aaid']);
		}

		return createarrok('ok',$data,'',$info);
	}

	####
	public function delete($aaid){
		$info=collectinfo(__METHOD__,'$aaid',array($aaid));
		if(isset($aaid)===false){return createarrerr('error_code','aaid 不能为空',$info);}//防止NULL
		
		$aa=M('aa');$ccaa=D('Ccaa');
		$aa->where('aaid='.$aaid)->delete();
		//删除依赖
      	$ccaa->deletebyaaid($aaid);
      	
		return createarrok('ok',$data,'',$info);
	}

	//############test
	public function add($get){
		$info=collectinfo(__METHOD__,'$get',array($get));
		if(isset($get)===false){return createarrerr('error_code','get 不能为空',$info);}//防止NULL
		
		$aa=M('aa');
		$aa->data($get)->add();

		return createarrok('ok',$data,'',$info);
	}

	//############test
	public function mdf($get,$id){
		$info=collectinfo(__METHOD__,'$get,$id',array($get,$id));
		if(isset($get)===false){return createarrerr('error_code','get 不能为空',$info);}//防止NULL
		if(isset($id)===false){return createarrerr('error_code','id 不能为空',$info);}//防止NULL

		$aa=M('aa');
		$aa->where('aaid='.$id)->setField($get);

		return createarrok('ok',$data,'',$info);
	}

} 
?>