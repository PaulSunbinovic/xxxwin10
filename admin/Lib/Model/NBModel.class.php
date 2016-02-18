<?php
class NBModel extends Action{
	//test
	//
	//############test
	public function getls($para,$mdmk,$jn,$fld,$cdt,$spccdt,$odr,$lmt,$hide_fld,$hide_cdt,$spccdtls,$odrls,$defaultls){
		$info=collectinfo(__METHOD__,'$para,$mdmk,$jn,$fld,$cdt,$spccdt,$odr,$lmt,$hide_fld,$hide_cdt,$spccdtls,$odrls,$defaultls',array($para,$mdmk,$jn,$fld,$cdt,$spccdt,$odr,$lmt,$hide_fld,$hide_cdt,$spccdtls,$odrls,$defaultls));

		if(isset($para)===false){return createarrerr('error_code','para 不能为空',$info);}
		if(isset($mdmk)===false){return createarrerr('error_code','mdmk 不能为空',$info);}
		if(isset($jn)===false){return createarrerr('error_code','jn 不能为空',$info);}
		if(isset($fld)===false){return createarrerr('error_code','fld 不能为空',$info);}
		if(isset($cdt)===false){return createarrerr('error_code','cdt 不能为空',$info);}
		if(isset($spccdt)===false){return createarrerr('error_code','spccdt 不能为空',$info);}
		if(isset($odr)===false){return createarrerr('error_code','odr 不能为空',$info);}
		if(isset($lmt)===false){return createarrerr('error_code','lmt 不能为空',$info);}
		if(isset($hide_fld)===false){return createarrerr('error_code','hide_fld 不能为空',$info);}
		if(isset($hide_cdt)===false){return createarrerr('error_code','hide_cdt 不能为空',$info);}

		$this->assign('para',$para);$this->assign('mdmk',$mdmk);$this->assign('fld',$fld);$this->assign('cdt',$cdt);$this->assign('odr',$odr);$this->assign('spccdt',$spccdt);$this->assign('lmt',$lmt);$this->assign('hide_fld',$hide_fld);$this->assign('hide_cdt',$hide_cdt);$this->assign('spccdtls',$spccdtls);$this->assign('odrls',$odrls);$this->assign('lowmdmk',strtolower($mdmk)); 


		

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
		foreach($cdt as $cdtvk=>$cdtvv){
			if(strstr($cdtvk,'_')){
				$thiscdt=$cdtvk.'='.$cdtvv;
				//此时一般需要把这个对应的数据给显示出来
				if($defaultls==1){
					$tmp=explode('_', $cdtvk);
					$tmp=explode('id',$tmp[2]);
					$tmp=$tmp[0];$tmp=M($tmp);
					$this->assign($cdtvk,$tmp->select());
				}
			}else{$thiscdt=$cdtvk." LIKE '%".$cdtvv."%'";}
			$cdt_str=$cdt_str.' AND '.$thiscdt;
		}
		foreach($spccdt as $spccdtv){$cdt_str=$cdt_str.' AND ('.$spccdtls[$spccdtv][0].') ';}
		$m->where($cdt_str);

		//此时已经可以确定多少条了
		$m_forcount=clone $m;
		$count=$m_forcount->count();

		//分页
		import('ORG.Util.Page');
		$page=new Page($count,$lmt);//后台管理页面默认一页显示N条记录
		$page->setConfig('prev', "&laquo; 上一页");//上一页
		$page->setConfig('next', '下一页 &raquo;');//下一页
		$page->setConfig('first', '&laquo; 首页');//第一页
		$page->setConfig('last', '末页 &raquo;');//最后一页
		$page->setConfig('theme','共%totalPage%页/%totalRow%%header% %first% %upPage%  %linkPage%  %downPage% %end%');
		//设置分页回调方法
		$show=$page->show();
		$this->assign('page',$show);
		
		$odr_str='';
		$i=0;foreach($odr as $odrvk=>$odrvv){if($i!=0){$odr_str=$odr_str.',';}$odr_str=$odr_str.$odrvk.' '.$odrvv;$i++;}
		$m->order($odr_str);
		$this->assign('pagestart',$page->firstRow);
		$m->limit($page->firstRow.','.$page->listRows);

		$mls=$m->select();
		
		

		
		
		// //处理page管理
		// $sum=$m_clone->count();//共多少条
		// $pagenum=floor($sum/$lmt)+1;//共多少页
		// $nowpage=$pagestart/$lmt; //当前第几页
		// if($nowpage==0){$prev='no';$first='no';}else{$prev=$nowpage-1;$first=0;}
		// if($nowpage==$pagenum-1){$next='no';$last='no';}else{$next=$nowpage+1;$last=$pagenum-1;}
		
		// $page['sum']=$sum;$page['pagenum']=$pagenum;$page['nowpage']=$nowpage;$page['prev']=$prev;$page['next']=$next;$page['first']=$first;$page['last']=$last;$page['lmt']=$lmt;
		
		// $this->assign('page',$page);//不管是ajax不用还是 首次查询要用，我都assign了
				
		return createarrok('ok',$mls,'',$info);
	}
	
	#####
	public function processget($get){
		$info=collectinfo(__METHOD__,'$get',array($get));

		$arr_fld=array();$arr_cdt=array();$arr_spccdt=array();$arr_odr=array();
		foreach ($get as $key => $value) {
			//fld
			if(strstr($key,'nb_fld')){
				$fldls=explode('-',$value);
				for($i=1;$i<count($fldls)-1;$i++){
					array_push($arr_fld,$fldls[$i]);
				}
			}
			//cdt
			if(strstr($key,'nb_cdt')){
				$k=explode('_nb_cdt', $key)[0];
				$arr_cdt[$k]=$value;
			}
			//spccdt
			if(strstr($key,'nb_spccdt')){
				array_push($arr_spccdt,$value);
			}
			//odr
			if(strstr($key,'nb_odr')){
				$k=explode('_nb_odr', $key)[0];
				$arr_odr[$k]=$value;
			}
		}
		$lmt=$get['nb_lmt'];

		$get=array();
		$get['fld']=$arr_fld;$get['cdt']=$arr_cdt;$get['spccdt']=$arr_spccdt;$get['odr']=$arr_odr;$get['lmt']=$lmt;
		
		return createarrok('ok',$get,'',$info);
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
		//把mo中的给别人修改的ls选项列出来
		foreach($mo as $k=>$v){
			$tmp=explode('_', $k);
			$tmp=explode('id',$tmp[2]);
			$tmp=$tmp[0];$tmp=M($tmp);
			$this->assign($k,$tmp->select());
		}

		return createarrok('ok',$mo,'',$info);
	}

	public function doupdate($mdmk,$get){
		$info=collectinfo(__METHOD__,'$mdmk,$get',array($mdmk,$get));
		if(isset($mdmk)===false){return createarrerr('error_code','mdmk 不能为空',$info);}//防止NULL
		if(isset($get)===false){return createarrerr('error_code','get 不能为空',$info);}//防止NULL
		
		$lowmdmk=strtolower($mdmk);
		$m=M($lowmdmk);
		$mid=$lowmdmk.'id';
		
		$id=$get[$mid];
		unset($get[$mid]);
		unset($get['_URL_']);

		if($id==0){
			//add
			$m->data($get)->add();
			$pattern=0;
		}else{
			$m->where($mid.'='.$id)->setField($get);
			$pattern=1;
		}
		

		return createarrok('ok',$pattern,'',$info);
	}

} 
?>