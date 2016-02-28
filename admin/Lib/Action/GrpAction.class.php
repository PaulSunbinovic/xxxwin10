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

	//
   	public function update(){
   		header("Content-Type:text/html; charset=utf-8");
    	$pb=D('PB');
    	$pb->update($this->all);
    	 //dingzhis
      //如果是添加的话需要初始给点数据的 重新覆盖添加的mo
      $id=$_GET['id'];$pid=$_GET['pid'];$odr=$_GET['odr'];
      if($id==0){$mo['grppid']=$pid;$mo['grpodr']=$odr;$this->assign('mo',$mo);}
       //dingzhio 	
      
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

		header("Content-Type:text/html; charset=utf-8");
		$tree=D('Tree');$grp=D('Grp');
		//先找出要删除的所有ID，然后一个个删
		$grpid=$_POST['id'];
		$arr_grpo=$grp->getmo($grpid);$grpo=$arr_grpo['data'];
    $grppid=$grpo['grppid'];

		$arr_grpls=$grp->getmlsbyodr('grpodr ASC');$grpls=$arr_grpls['data'];
  	$grpidls=$tree->unlimitedForListID($grpls,$grpid,'grpid','grpnm','grppid','grpodr');
  	array_push($grpidls,$grpid);

  	foreach($grpidls as $grpidv){
  		$grpid=$grpidv;
  		
  		$grp->delete($grpid);
  		
  	}
  	//调整缺少了他的同伴的顺序
  	$tree->paixu($grppid,'grp');

		$this->ajaxReturn($data,'json');
		
	}

}



?>