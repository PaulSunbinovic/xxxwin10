<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class GrpAction extends Action{

	//预设  para一般自身的所有以及扩展的zabojingua东西
	//聚合
    private $all=array(
    	'mdmk'=>'Grp',//NB
  		'ttl'=>'团队',
  		'jn'=>array(),//NB
     	 //自己的全部+f的显示的东西
  		'para'=>array('grpid'=>'grpID','grpnm'=>'团队名称','grppid'=>'grpPID','grpodr'=>'顺序'),//NB
  		//抛去不是zabojin的属性针对para
      'notself'=>array(),
       ##########modify 添加修改中不需要展示和理会的属性 针对para
      'no_update'=>array('grpid'),
      #####update的时候允许为空的值 针对zabojin刨掉不然显示的update字段后
      'allowempty'=>array(),

      'hide_fld'=>array('grpid'),//NB
      'hide_cdt'=>array('grpid'),//NB
  		
    //   'spccdtls'=>array('spccdt_0'=>array('aaid<>0','aaID不为0【废话只是测试】')),
  		// 'odrls'=>array('aanm'),
    //   'spccdt_dflt'=>array('spccdt_0'),
    //   'odr_dflt'=>array('aanm'=>'ASC'),

      'spccdtls'=>array(),//NB
      'odrls'=>array(),//NB
      'spccdt_dflt'=>array(),//NB
      'odr_dflt'=>array(),//NB
      //hide的fld必须有，他们虽然不显示但是必须选择，这样才能在第一次进入query的时候，隐藏属性可以被调用，特别是id和fid
  		'fld_dflt'=>array('grpid','grpnm','grppid','grpodr'),//NB
  		'cdt_dflt'=>array(),//NB
  		
  		'lmt_dflt'=>10,//NB
  		
  		'defaultls'=>1,//默认枚举//NB
  		##########view
  		'no_view'=>array('grpid'),
	   
      #########删除提醒
      'deleteconfirm'=>'删除该团队将会把其子团队递归删除，同时依附于他的rl角色也将被删除',
      #####转义
      'transmean'=>array(),//NB
      #####默认值
      'dfltvalue'=>array(),
      
    	);

	
	
	public function query(){
		header("Content-Type:text/html; charset=utf-8");
		$environment=D('Environment');$tree=D('Tree');$grp=D('Grp');

		$all=$this->all;$mdmk=$all['mdmk'];

		$arr_usross=$environment->setenvironment($mdmk);$usross=$arr_usross['data'];
		
		$arr_grpls=$grp->getmlsbyodr('grpodr ASC');$grpls=$arr_grpls['data'];

		$str=$tree->unlimitedForList($grpls,0,'grpid','grpnm','grppid','grpodr');

		$this->assign('tree',$str);
		
		$this->assign('ttl',$all['ttl']);
		$this->display('query');
	}
	

	public function edit(){
		header("Content-Type:text/html; charset=utf-8");
		$environment=D('Environment');$tree=D('Tree');$grp=D('Grp');

		$all=$this->all;$mdmk=$all['mdmk'];

		$arr_usross=$environment->setenvironment($mdmk);$usross=$arr_usross['data'];
		
		$arr_grpls=$grp->getmlsbyodr('grpodr ASC');$grpls=$arr_grpls['data'];

		$str=$tree->unlimitedForListPlus($grpls,0,'grpid','grpnm','grppid','grpodr',__URL__,'Grp');
		$strpos=$tree->unlimitedForListMv($grpls,0,'grpid','grpnm','grppid','grpodr');

		$this->assign('deleteconfirm',$all['deleteconfirm']);
		//q特殊
		$this->assign('tree',$str);
		$this->assign('treepos',$strpos);
		
		$this->assign('ttl',$all['ttl']);
		$this->display('edit');
	}

	//公版
   	public function update(){
   		header("Content-Type:text/html; charset=utf-8");
    	$pb=D('PB');
    	$pb->update($this->all);
    	    	
		$this->display('update');
   	}

   	//公版
   	public function doupdate(){
   		header("Content-Type:text/html; charset=utf-8");
   		$pb=D('PB');
   		$arr_pattern=$pb->doupdate($this->all);
   		$data['pattern']=$arr_pattern['pattern'];

   		$this->ajaxReturn($data,'json');
   	}



	public function domove(){
		header("Content-Type:text/html; charset=utf-8");
		$tree=D('Tree');

		$all=$this->all;

		$pid=$_GET['pid'];
		$pos=$_GET['pos'];
		$id=$_GET['id'];
		$mdmk=$all['mdmk'];
		
		$tree->move($pid,$pos,$id,$mdmk);

		$this->ajaxReturn($data,'json');
		
	}
	
	function dodelete(){


		$rl=D('Rl');
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
		/////////删除他就有可能呢删除一排的grp，所以要对所有的grp对应的rl进行删除，斩草除根
		$grpid=$_GET['id'];
		//删除角色会导致usrrl相应的数据删除
      	$rl->deletebygrpid($grpid);

		$this->ajaxReturn($data,'json');
		
	}

}



?>