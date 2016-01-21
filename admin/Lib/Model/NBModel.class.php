<?php
class NBModel extends Action{
	//test
	//
	//############test
	public function getls($para,$mdmk,$jn,$fld,$cdt,$spccdt,$odr,$pagestart,$lmt,$hide_fld,$hide_cdt){
		$info=collectinfo(__METHOD__,'$para,$mdmk,$jn,$fld,$cdt,$spccdt,$odr,$pagestart,$lmt,$hide_fld,$hide_cdt',array($para,$mdmk,$jn,$fld,$cdt,$spccdt,$odr,$pagestart,$lmt,$hide_fld,$hide_cdt));

		if(isset($para)===false){return createarrerr('error_code','para 不能为空',$info);}
		if(isset($mdmk)===false){return createarrerr('error_code','mdmk 不能为空',$info);}
		if(isset($jn)===false){return createarrerr('error_code','jn 不能为空',$info);}
		if(isset($fld)===false){return createarrerr('error_code','fld 不能为空',$info);}
		if(isset($cdt)===false){return createarrerr('error_code','cdt 不能为空',$info);}
		if(isset($spccdt)===false){return createarrerr('error_code','spccdt 不能为空',$info);}
		if(isset($odr)===false){return createarrerr('error_code','odr 不能为空',$info);}
		if(isset($pagestart)===false){return createarrerr('error_code','pagestart 不能为空',$info);}
		if(isset($lmt)===false){return createarrerr('error_code','lmt 不能为空',$info);}
		if(isset($hide_fld)===false){return createarrerr('error_code','hide_fld 不能为空',$info);}
		if(isset($hide_cdt)===false){return createarrerr('error_code','hide_cdt 不能为空',$info);}

		$this->assign('fld',$fld);$this->assign('cdt',$cdt);$this->assign('odr',$odr);$this->assign('spccdt',$spccdt);$this->assign('pagestart',$pagestart);$this->assign('lmt',$lmt);$this->assign('hide_fld',$hide_fld);$this->assign('hide_cdt',$hide_cdt);
		//先搞定针对哪个数据
		$mdmk=strtolower($mdmk);
		$m=M($mdmk);
		foreach($jn as $jnv){$m->join($jnv);}
		$fld_str='';$thls=array();
		for($i=0;$i<count($fld);$i++){
			if(!in_array($fld[$i],$hide_fld)){array_push($thls, $para[$fld[$i]]);}
			if($i==0){$fld_str=$fld[$i];}else{$fld_str=$fld_str.','.$fld[$i];}
		}
		$m->field($fld_str);$this->assign('thls',$thls);
		$cdt_str='1=1';
		foreach($cdt as $cdtv){
			if(strstr($cdtv[0],'_id')){$thiscdt=$cdtv[0].'='.$cdtv[1];}else{$thiscdt=$cdtv[0]." LIKE '%".$cdtv[1]."%'";}
			$cdt_str=$cdt_str.' AND '.$thiscdt;
		}
		foreach($spccdt as $spccdtv){$cdt_str=$cdt_str.' AND ('.$spccdtv[0].') ';}
		$m->where($cdt_str);
		$odr_str='';
		foreach($odr as $odrv){if($odrv[1]!=''){$thisodr=$odrv[0].' '.$odrv[1];if(!$odr_str){$odr_str=$thisodr;}else{$odr_str=$odr_str.','.$thisodr;}}}
		$m->order($odr_str);
		$m_clone=clone $m;
		
		if($lmt){$m->limit($pagestart,$lmt);}
		$mls=$m->select();
		
		//处理page管理
		$sum=$m_clone->count();//共多少条
		$pagenum=floor($sum/$lmt)+1;//共多少页
		$nowpage=$pagestart/$lmt; //当前第几页
		if($nowpage==0){$prev='no';$first='no';}else{$prev=$nowpage-1;$first=0;}
		if($nowpage==$pagenum-1){$next='no';$last='no';}else{$next=$nowpage+1;$last=$pagenum-1;}
		
		$page['sum']=$sum;$page['pagenum']=$pagenum;$page['nowpage']=$nowpage;$page['prev']=$prev;$page['next']=$next;$page['first']=$first;$page['last']=$last;$page['lmt']=$lmt;
		
		$this->assign('page',$page);//不管是ajax不用还是 首次查询要用，我都assign了
				
		return createarrok('ok',$mls,'',$info);
	}
	

} 
?>