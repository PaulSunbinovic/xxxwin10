<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class BdAction extends Action{

	//预设  para一般自身的所有以及扩展的zabojingua东西
	//聚合
    private $all=array(
    	'mdmk'=>'Bd',//NB
  		'ttl'=>'板块',
  		'jn'=>array(),//NB
     	 //自己的全部+f的显示的东西
  		'para'=>array('bdid'=>'bdID','bdnm'=>'板块名称','bdpid'=>'bdPID','bdodr'=>'顺序'),//NB
  		//抛去不是zabojin的属性针对para
      'notself'=>array(),
       ##########modify 添加修改中不需要展示和理会的属性 针对para
      'no_update'=>array('bdid'),
      #####update的时候允许为空的值 针对zabojin刨掉不然显示的update字段后
      'allowempty'=>array(),

      'hide_fld'=>array('bdid'),//NB
      'hide_cdt'=>array('bdid'),//NB
  		
    //   'spccdtls'=>array('spccdt_0'=>array('aaid<>0','aaID不为0【废话只是测试】')),
  		// 'odrls'=>array('aanm'),
    //   'spccdt_dflt'=>array('spccdt_0'),
    //   'odr_dflt'=>array('aanm'=>'ASC'),

      'spccdtls'=>array(),//NB
      'odrls'=>array(),//NB
      'spccdt_dflt'=>array(),//NB
      'odr_dflt'=>array(),//NB
      //hide的fld必须有，他们虽然不显示但是必须选择，这样才能在第一次进入query的时候，隐藏属性可以被调用，特别是id和fid
  		'fld_dflt'=>array('bdid','bdnm','bdpid','bdodr'),//NB
  		'cdt_dflt'=>array(),//NB
  		
  		'lmt_dflt'=>10,//NB
  		
  		'defaultls'=>1,//默认枚举//NB
  		##########view
  		'no_view'=>array('bdid'),
	   
      #########删除提醒
      'deleteconfirm'=>'删除该板块将会把其子板块递归删除，同时依附于他的文章也将被删除',
      #####转义
      'transmean'=>array(),//NB
      #####默认值
      'dfltvalue'=>array(),
      
    	);

	
	
	public function query(){
		header("Content-Type:text/html; charset=utf-8");
		$environment=D('Environment');$tree=D('Tree');$bd=D('Bd');

		$all=$this->all;$mdmk=$all['mdmk'];

		$arr_usross=$environment->setenvironment($mdmk);$usross=$arr_usross['data'];
		
		$arr_bdls=$bd->getmlsbyodr('bdodr ASC');$bdls=$arr_bdls['data'];

		$str=$tree->unlimitedForList($bdls,0,'bdid','bdnm','bdpid','bdodr');

		$this->assign('tree',$str);
		
		$this->assign('ttl',$all['ttl']);
		$this->display('query');
	}
	

	public function edit(){
		header("Content-Type:text/html; charset=utf-8");
		$environment=D('Environment');$tree=D('Tree');$bd=D('Bd');

		$all=$this->all;$mdmk=$all['mdmk'];

		$arr_usross=$environment->setenvironment($mdmk);$usross=$arr_usross['data'];
		
		$arr_bdls=$bd->getmlsbyodr('bdodr ASC');$bdls=$arr_bdls['data'];

		$str=$tree->unlimitedForListPlus($bdls,0,'bdid','bdnm','bdpid','bdodr',__URL__,'Bd');
		$strpos=$tree->unlimitedForListMv($bdls,0,'bdid','bdnm','bdpid','bdodr');

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

		header("Content-Type:text/html; charset=utf-8");
		$tree=D('Tree');$bd=D('Bd');
		//先找出要删除的所有ID，然后一个个删
		$bdid=$_POST['id'];
		$arr_bdo=$bd->getmo($bdid);$bdo=$arr_bdo['data'];
    $bdpid=$bdo['bdpid'];

		$arr_bdls=$bd->getmlsbyodr('bdodr ASC');$bdls=$arr_bdls['data'];
  	$bdidls=$tree->unlimitedForListID($bdls,$bdid,'bdid','bdnm','bdpid','bdodr');
  	array_push($bdidls,$bdid);

  	foreach($bdidls as $bdidv){
  		$bdid=$bdidv;
  		
  		$bd->delete($bdid);
  		
  	}
  	//调整缺少了他的同伴的顺序
  	$tree->paixu($bdpid,'bd');

		$this->ajaxReturn($data,'json');
		
	}

}



?>