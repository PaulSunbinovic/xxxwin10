<?php 
class TreeModel{
	//###################处理权限极其关系问题统一在这里
	/*
	3浙江01
		7湖州31
		2杭州32
			9萧山区21
			1拱墅区22
			5江干区23
				4下沙51
			10西湖区24
		6金华33
	8江苏02
	//#####测试使用代码
	$tree=D('Tree');
	$treels=M('tree')->order('treeodr ASC')->select();//p($treels);die;
	p($tree->unlimitedForLayer($treels,'treeid','treepid'));
	*/
	//############test形成有序的数组
	public function unlimitedForLayer ($cate,$fldnm_id,$fldnm_pid,$name='child',$pid=0) {
		
		$arr = array();
		foreach ($cate as $v) {
			if ($v[$fldnm_pid] == $pid) {
				$v[$name] = self::unlimitedForLayer($cate,$fldnm_id,$fldnm_pid,$name,$v[$fldnm_id]);
				$arr[] = $v;
			}
		}
		return $arr;
	}


	#####################
	public function unlimitedForList($cate,$pid,$idzd,$nmzd,$pidzd,$odrzd){
		$str='';
		$a_oc_x="<a class='oc'><i class='glyphicon glyphicon-plus'></i></a>";
		$a_oc_i="<a class='oc'><i class='glyphicon glyphicon-minus'></i></a>";
		foreach ($cate as $v) {
			
			if ($v[$pidzd] == $pid) {
				if($v[$odrzd]==1){
					$str=$str.'<ul>';
				}
				$rslt=self::unlimitedForList($cate,$v[$idzd],$idzd,$nmzd,$pidzd,$odrzd);
				if($rslt==''){//无子嗣就算了
					$str=$str."<li>".$a_oc_i."&nbsp;".$v[$nmzd];
				}else{
					$str=$str."<li>".$a_oc_x."&nbsp;".$v[$nmzd].$rslt;
				}
				$str=$str.'</li>';
				//$arr[] = $v;
			}
		}
		if($str==''){
			return '';
		}else{
			return $str.'</ul>';//有子嗣要补上/ul
		}
		
	}

	##################
	public function unlimitedForListPlus($cate,$pid,$idzd,$nmzd,$pidzd,$odrzd,$url,$thm){
		//额外模块专门验证有没有a的权限
		$rbac=D('RBAC');$md=D('Md');
		$usrid=session('usridss');
		$arr_mdo=$md->getmdobymdmk($thm);$mdo=$arr_mdo['data'];
		$arr_atho=$rbac->getatho($usrid,$mdo['mdid']);
		$athofn=$arr_atho['data'];
		if($athofn['atha']==1){
			$str='';$odr=0;
			//$a_add="<a class='tadd' href='#'>添加</a>";
			//$a_mdf="<a href='#'>修改</a>";
			//$a_mv="<a href='#'>移位</a>";
			//$a_dlt="<a href='#'>删除</a>";
			$a_oc_x="<a class='oc'><i class='glyphicon glyphicon-plus'></i></a>";
			$a_oc_i="<a class='oc'><i class='glyphicon glyphicon-minus'></i></a>";
			foreach ($cate as $v) {
				if ($v[$pidzd] == $pid) {
					$odr=$v[$odrzd];
					if($v[$odrzd]==1){
						$str=$str.'<ul>';
					}
					$rslt=self::unlimitedForListPlus($cate,$v[$idzd],$idzd,$nmzd,$pidzd,$odrzd,$url,$thm);
					if($rslt=="<ul><li>"."<a class='tadd' href='".$url."/update/id/0/pid/".$v[$pidzd]."/odr/1'>添加</a>"."</li></ul>"){//无子嗣就算了
						$str=$str."<li>".$a_oc_x."&nbsp;".$v[$nmzd]."&nbsp;&nbsp;"."<a href='".$url."/update/id/".$v[$idzd]."'>修改</a>"."&nbsp;&nbsp;"."<a href='javascript:disp(".$v[$idzd].")'>移位</a>"."&nbsp;&nbsp;"."<a href='javascript:dlt(".$v[$idzd].")'>删除</a>".$rslt;
					}else{
						$str=$str."<li>".$a_oc_x."&nbsp;".$v[$nmzd]."&nbsp;&nbsp;"."<a href='".$url."/update/id/".$v[$idzd]."'>修改</a>"."&nbsp;&nbsp;"."<a href='javascript:disp(".$v[$idzd].")'>移位</a>"."&nbsp;&nbsp;"."<a href='javascript:dlt(".$v[$idzd].")'>删除</a>".$rslt;
					}
					$str=$str.'</li>';
					//$arr[] = $v;
				}
			}
			
			if($str==''){//没找着儿子
				return "<ul><li>"."<a class='tadd' href='".$url."/update/id/0/pid/".$pid."/odr/1'>添加</a>"."</li></ul>";
			}else{
				return $str."<li>"."<a class='tadd' href='".$url."/update/id/0/pid/".$pid."/odr/".($odr+1)."'>添加</a>"."</li>".'</ul>';//有子嗣要补上/ul
			}
		}else{
			$str='';
			$a_oc_x="<a class='oc'><i class='glyphicon glyphicon-plus'></i></a>";
			$a_oc_i="<a class='oc'><i class='glyphicon glyphicon-minus'></i></a>";
			foreach ($cate as $v) {
			
				if ($v[$pidzd] == $pid) {
					if($v[$odrzd]==1){
						$str=$str.'<ul>';
					}
					$rslt=self::unlimitedForListPlus($cate,$v[$idzd],$idzd,$nmzd,$pidzd,$odrzd,$url);
					if($rslt==''){//无子嗣就算了
						$str=$str."<li>".$a_oc_i."&nbsp;".$v[$nmzd]."&nbsp;&nbsp;"."<a href='".$url."/update/id/".$v[$idzd]."'>修改</a>"."&nbsp;&nbsp;"."<a href='javascript:disp(".$v[$idzd].")'>移位</a>"."&nbsp;&nbsp;"."<a href='javascript:dlt(".$v[$idzd].")'>删除</a>";
					}else{
						$str=$str."<li>".$a_oc_x."&nbsp;".$v[$nmzd]."&nbsp;&nbsp;"."<a href='".$url."/update/id/".$v[$idzd]."'>修改</a>"."&nbsp;&nbsp;"."<a href='javascript:disp(".$v[$idzd].")'>移位</a>"."&nbsp;&nbsp;"."<a href='javascript:dlt(".$v[$idzd].")'>删除</a>".$rslt;
					}
					$str=$str.'</li>';
					//$arr[] = $v;
				}
			}
			if($str==''){
				return '';
			}else{
				return $str.'</ul>';//有子嗣要补上/ul
			}
		}	
		
		
	}

	###############################
	//BD组合多维数组结果以List形式（ul li）
	public function unlimitedForListMv($cate,$pid,$idzd,$nmzd,$pidzd,$odrzd){
		$str='';$odr=0;
		//$a_add="<a class='tadd' href='#'>添加</a>";
		//$a_mdf="<a href='#'>修改</a>";
		//$a_mv="<a href='#'>移位</a>";
		//$a_dlt="<a href='#'>删除</a>";
		$a_oc_x="<a class='oc'><i class='glyphicon glyphicon-plus'></i></a>";
		$a_oc_i="<a class='oc'><i class='glyphicon glyphicon-minus'></i></a>";
		foreach ($cate as $v) {
			if ($v[$pidzd] == $pid) {
				$odr=$v[$odrzd];
				if($v[$odrzd]==1){
					$str=$str."<ul><li><a href='javascript:mvhr(".$v[$pidzd].",0)' style='color:red'>移动至此处</a></li>";
				}
				$rslt=self::unlimitedForListMv($cate,$v[$idzd],$idzd,$nmzd,$pidzd,$odrzd);
				if($rslt=="<ul><li>"."<a href='javascript:mvhr(".$v[$idzd].",0)' style='color:red'>移动至此处</a>"."</li></ul>"){//无子嗣就算了
					$str=$str."<li>".$a_oc_x."&nbsp;".$v[$nmzd].$rslt;
				}else{
					$str=$str."<li>".$a_oc_x."&nbsp;".$v[$nmzd].$rslt;
				}
				$str=$str.'</li>'."<li><a href='javascript:mvhr(".$v[$pidzd].",".$v[$odrzd].")' style='color:red'>移动至此处</a></li>";
				//$arr[] = $v;
			}
		}
		if($str==''){//没找着儿子
			return "<ul><li><a href='javascript:mvhr(".$pid.",0)' style='color:red'>移动至此处</a></li></ul>";
		}else{
			return $str."</ul>";//有子嗣要补上/ul
		}
	}


}

?>