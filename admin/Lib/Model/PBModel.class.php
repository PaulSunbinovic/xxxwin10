<?php
class PBModel extends Action{
	//test
	//
	//############test
	public function query($all){
		$info=collectinfo(__METHOD__,'$all',array($all));
		if(isset($all)===false){return createarrerr('error_code','all 不能为空',$info);}//防止NULL
		
		$environment=D('Environment');
    	$nb=D('NB');
    	###################
		$mdmk=$all['mdmk'];
		$lowmdmk=strtolower($mdmk);
    	
    	$arr_usross=$environment->setenvironment($mdmk);$usross=$arr_usross['data'];

		import('ORG.Util.Page');
		###################
		$para=$all['para'];//总字段
		$spccdtls=$all['spccdtls'];
		$odrls=$all['odrls'];
		//采用公版为默认显示ls（针对筛选里的ls）
		$defaultls=$all['defaultls'];
		
		//NB搜索
		$arr_get=$nb->processget($_GET);$get=$arr_get['data'];
    	$jn=$all['jn'];
    	###################
    	if(!$get['fld']){$fld=$all['fld_dflt'];}else{$fld=$get['fld'];}//总para,挡住的意味着默认选中，总para没有挡住的可以选 fld标明选中（包括挡住默认选中的）
    	if(!$get['fld']){$cdt=$all['cdt_dflt'];}else{$cdt=$get['cdt'];}//根据总字段获取cdt,其中挡住的就算了没挡住的需要体现出来，而罗列出来的需要体现
    	if(!$get['fld']){$spccdt=$all['spccdt_dflt'];}else{$spccdt=$get['spccdt'];}//有多少罗列多少
    	if(!$get['fld']){$odr=$all['odr_dflt'];}else{$odr=$get['odr'];}//列出多少选多少 ASC DESC 
    	if(!$get['fld']){$lmt=$all['lmt_dflt'];}else{$lmt=$get['lmt'];}
    	##############有的时候hide_fld和hide_cdt不一样的
    	$hide_fld=$all['hide_fld'];$hide_cdt=$all['hide_cdt'];
    	$arr=$nb->getls($para,$mdmk,$jn,$fld,$cdt,$spccdt,$odr,$lmt,$hide_fld,$hide_cdt,$spccdtls,$odrls,$defaultls);
    	$mls=$arr['data'];
    	
		$this->assign('mls',$arr['data']);

		$this->assign('ttl',$all['ttl']);
		
		return createarrok('ok',$data,'',$info);
	}
	###
	public function getmo($mdmk,$id,$para,$jn){
		$info=collectinfo(__METHOD__,'$mdmk,$id,$para,$jn',array($mdmk,$id,$para,$jn));
		if(isset($mdmk)===false){return createarrerr('error_code','mdmk 不能为空',$info);}//防止NULL
		if(isset($id)===false){return createarrerr('error_code','id 不能为空',$info);}//防止NULL
		if(isset($para)===false){return createarrerr('error_code','para 不能为空',$info);}//防止NULL
		if(isset($jn)===false){return createarrerr('error_code','jn 不能为空',$info);}//防止NULL
		
		$lowmdmk=strtolower($mdmk);
		$m=M($lowmdmk);
		foreach($jn as $jnv){$m->join($jnv);}
		$mo=$m->where($lowmdmk.'id='.$id)->find();
		
		return createarrok('ok',$mo,'',$info);
	}
	#########
	public function view($all){
		$info=collectinfo(__METHOD__,'$all',array($all));
		if(isset($all)===false){return createarrerr('error_code','all 不能为空',$info);}//防止NULL
		
		$environment=D('Environment');
    	
    	$mdmk=$all['mdmk'];
    	$lowmdmk=strtolower($mdmk);$this->assign('lowmdmk',$lowmdmk);

    	$arr_usross=$environment->setenvironment($mdmk);$usross=$arr_usross['data'];
    	
    	$id=$_GET['id'];
    	$para=$all['para'];$this->assign('para',$para);
    	$jn=$all['jn'];
    	$no_view=$all['no_view'];$this->assign('no_view',$no_view);


    	$arr_mo=$this->getmo($mdmk,$id,$para,$jn);$mo=$arr_mo['data'];
    	
    	$this->assign('mo',$mo);
    	$this->assign('ttl',$mo[$lowmdmk.'nm']);
		
		return createarrok('ok',$data,'',$info);
	}
	##########
	public function update($all){
		$info=collectinfo(__METHOD__,'$all',array($all));
		if(isset($all)===false){return createarrerr('error_code','all 不能为空',$info);}//防止NULL
		
		$environment=D('Environment');
    	
    	$mdmk=$all['mdmk'];
    	$lowmdmk=strtolower($mdmk);$this->assign('lowmdmk',$lowmdmk);
    	$notself=$all['notself'];$this->assign('notself',$notself);


    	$arr_usross=$environment->setenvironment($mdmk);$usross=$arr_usross['data'];
    	
    	$id=$_GET['id'];$this->assign('id',$id);
    	$para=$all['para'];$this->assign('para',$para);
    	$jn=$all['jn'];
    	$no_update=$all['no_update'];$this->assign('no_update',$no_update);

    	//甭管添加还是修改 zabojingua 属性必须要ls给好
    	foreach($para as $k=>$v){
    		if(!in_array($k,$notself)){
				$tmp=explode('_', $k);
				$tmp=explode('id',$tmp[2]);
				$tmp=$tmp[0];$tmp=M($tmp);
				$this->assign($k,$tmp->select());
			}
		}

    	if($id==0){$mo=array();$pattern='添加';}else{
    		$arr_mo=$this->getmo($mdmk,$id,$para,$jn);$mo=$arr_mo['data'];$pattern='修改';
    	}
    	
    	$this->assign('mo',$mo);
    	$this->assign('ttl',$mo[$lowmdmk.'nm'].$pattern);
		
		return createarrok('ok',$data,'',$info);
	}
	##########
	public function doupdate($all){
		$info=collectinfo(__METHOD__,'$all',array($all));
		if(isset($all)===false){return createarrerr('error_code','all 不能为空',$info);}//防止NULL
		
		$get=$_GET;
		$mdmk=$all['mdmk'];
   		
   		$lowmdmk=strtolower($mdmk);
		$m=M($lowmdmk);
		$mid=$lowmdmk.'id';
		
		$id=$get[$mid];
		unset($get[$mid]);
		unset($get['_URL_']);

		if($id==0){
			$m->data($get)->add();
			$pattern=0;
		}else{
			$m->where($mid.'='.$id)->setField($get);
			$pattern=1;
		}
   		
		
		return createarrok('ok',$pattern,'',$info);
	}
	##########
	public function dodelete($all){
		$info=collectinfo(__METHOD__,'$all',array($all));
		if(isset($all)===false){return createarrerr('error_code','all 不能为空',$info);}//防止NULL
		
		$mdmk=$all['mdmk'];
   		$id=$_GET['id'];
   		$lowmdmk=strtolower($mdmk);
		$m=M($lowmdmk);
		$mid=$lowmdmk.'id';

		$m->where($mid.'='.$id)->delete();

   		return createarrok('ok',$data,'',$info);
	}

	
} 
?>