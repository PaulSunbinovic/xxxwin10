<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class GrpAction extends Action{
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Grp'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$athofn=$Idtath->identify($mdo['mdid'],$x);
		
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		if($x=='vw'){
			$grpid=$_GET['grpid'];
			$grp=M('grp');
			$mo=$grp->where("grpid=".$grpid)->find();
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$grpid=$_GET['id'];
			$grp=M('grp');
			if($grpid==0){
				$mo['grpid']=0;
				$mo['grppid']=$_GET['pid'];
				$mo['grpodr']=$_GET['odr'];
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$grp->where("grpid=".$grpid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			
			$this->display('update');
		}else if($x=='edit'){
			header("Content-Type:text/html; charset=utf-8");
			
			import('@.TREE.TreeAction');
			$tree = new TreeAction();
			$grp=M('grp');
			$grpls=$grp->order('grpodr ASC')->select();//在按照这个顺序前提下，总体永远是1在上2在下
			
			$str=$tree->unlimitedForListPlus($grpls,0,'grpid','grpnm','grppid','grpodr',__URL__,'Grp');
			$strpos=$tree->unlimitedForListMv($grpls,0,'grpid','grpnm','grppid','grpodr');
			//p($str);die;
			//q特殊
			$this->assign('tree',$str);
			$this->assign('treepos',$strpos);
			$this->assign('title','浏览团队列表（编辑模式）');
			$this->assign('theme','团队管理（编辑模式）');
			
			$this->display('edit');
		}
	
	
	}
	
	public function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Grp'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$athofn=$Idtath->identify($mdo['mdid'],'qry');
		
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();

		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		import('@.TREE.TreeAction');
		$tree = new TreeAction();
		$grp=M('grp');
		$grpls=$grp->order('grpodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
		
		$str=$tree->unlimitedForList($grpls,0,'grpid','grpnm','grppid','grpodr');
		$this->assign('tree',$str);
		
		$this->assign('title','浏览团队列表');
		$this->assign('theme','团队管理');

		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$grpid=$_POST['grpid'];
	
		if($grpid==0){
			$grp=M('grp');
			//先截获数据
			$data=array(
				'grpnm'=>$_POST['grpnm'],
				'grppid'=>$_POST['grppid'],
				'grpodr'=>$_POST['grpodr'],
			);
					
			if($grp->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$grp=M('grp');
			//先截获数据
			
			$data=array(
				'grpnm'=>$_POST['grpnm'],
				'grppid'=>$_POST['grppid'],
				'grpodr'=>$_POST['grpodr'],
			);
			
			
			if($grp->where('grpid='.$grpid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function move(){
		$pid=$_POST['pid'];
		$pos=$_POST['pos'];
		$id=$_POST['id'];
		$grp=M('grp');
		$grpim=$grp->where('grpid='.$id)->find();
		
		//先排序新家
		$newgrphm=$grp->where('grppid='.$pid)->order('grpodr ASC')->select();//新家
		//先确定原著从哪个位置开始往下挪动一位，给新人留下控件
		$postrue=$pos+1;
		//先让原著居民相关的居民移位
		for($i=$postrue;$i<=count($newgrphm);$i++){//18115806374 15722796181
			$grpid=$newgrphm[$i-1]['grpid'];
			$dataorg=array(
				'grpodr'=>$newgrphm[$i-1]['grpodr']+1
			);
			$grp->where('grpid='.$grpid)->setField($dataorg);
		}
		//迁入移民
		$dataim=array(
			'grppid'=>$pid,
			'grpodr'=>$postrue,
		);
		$grp->where('grpid='.$id)->setField($dataim);
		
		
		//再排序老家
		$grpold=$grp->where('grppid='.$grpim['grppid'])->order('grpodr ASC')->select();
		for($i=0;$i<count($grpold);$i++){
			$dataold=array(
				'grpodr'=>$i+1
			);
			$grp->where('grpid='.$grpold[$i]['grpid'])->setField($dataold);
		}
		$data['status']=1;
		$this->ajaxReturn($data,'json');
		
	}
	
	function delete(){
		//先找出要删除的所有ID，然后一个个删
		$grpid=$_POST['grpid'];
		
		$grp=M('grp');
		
		///
		$grpo=$grp->where('grpid='.$grpid)->find();
		$grppid=$grpo['grppid'];
		
		$grpls=$grp->order('grpodr ASC')->select();
		
		import('@.TREE.TreeAction');
		$tree = new TreeAction();
		//找他的子嗣
		$sons=$tree->unlimitedForListID($grpls, $grpid, 'grpid', 'grpnm', 'grppid', 'grpodr');
		$grpidu='-'.$grpid.'-'.$sons;
		$epldgrpidu=explode('-', $grpidu);
		for($i=1;$i<count($epldgrpidu)-1;$i++){
			
			//通过grp建立的usr-rl 关系也应该不复存在
			//有多少员工usrs
			$usrgrp=M('usrgrp');
			$usrgrpls=$usrgrp->where('f_usrgrp_grpid='.$epldgrpidu[$i])->select();//重点在usrs
			//下头有多少岗位rl
			$grprl=M('grprl');
			$grprlls=$grprl->where('f_grprl_grpid='.$epldgrpidu[$i])->select();//重点在rls
			//管他三七二十一删删删
			$usrrl=M('usrrl');
			for($i=0;$i<count($usrgrpls);$i++){
				for($j=0;$j<count($grprlls);$j++){
					$usrrl->where('f_usrrl_usrid='.$usrgrpls[$i]['f_usrgrp_usrid'].' AND f_usrrl_rlid='.$grprlls[$j]['f_grprl_rlid'])->delete();
				}
			}
			
			
			$usrgrp=M('usrgrp');
			$usrgrp->where('f_usrgrp_grpid='.$epldgrpidu[$i])->delete();
			
			$grprl=M('grprl');
			$grprl->where('f_grprl_grpid='.$epldgrpidu[$i])->delete();
			
			if($grp->delete($epldgrpidu[$i])){
				//$this->success('删除成功');
				$data['status']=1;
			}else{
				$data['status']=2;
				//$this->error($u->getLastSql());
			}
			///给剩下的进行排序
			$grpls=$grp->where('grppid='.$grppid)->order('grpodr ASC')->select();
			for($i=0;$i<count($grpls);$i++){
				$dt=array('grpodr'=>$i+1);
				$grp->where('grpid='.$grpls[$i]['grpid'])->setField($dt);
			}
			
		}
		$this->ajaxReturn($data,'json');
		
	}

}



?>