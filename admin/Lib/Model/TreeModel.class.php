<?php 
class TreeModel{
	//###################处理权限极其关系问题统一在这里
	//############test
	public function test(){
		header("Content-Type:text/html; charset=utf-8");
		return $arr;
	}
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
	
}

?>