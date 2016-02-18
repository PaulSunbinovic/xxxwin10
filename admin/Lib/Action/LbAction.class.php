<?php
// 本类由系统自动生成，仅供测试用途
class LbAction extends Action {

	
	//预设  para一般自身的所有以及扩展的zabojingua东西
	private $mdmk='Lb';
	private $ttl='大类';
	private $jn=array();
	private $para=array('lbid'=>'列表ID','lbnm'=>'列表名称','lbodr'=>'列表顺序');
	private $notself=array();
	private $spccdtls=array('spccdt_0'=>array('lbid<>0','列表ID不为0【废话只是测试】'));
	private $odrls=array('lbodr');
	private $fld_dflt=array('lbid','lbnm','lbodr');
	private $cdt_dflt=array('lbnm'=>'类',);
	private $spccdt_dflt=array('spccdt_0');
	private $odr_dflt=array('lbodr'=>'ASC');
	private $lmt_dflt=10;
	private $hide_dflt=array('lbid');//一般情况下都是一致的
	private $defaultls=1;
	##########view
	private $no_view=array('lbid');
    ##########modify
    private $no_update=array('lbid');

    //公版
    public function query(){
    	header("Content-Type:text/html; charset=utf-8");
    	$environment=D('Environment');
    	$nb=D('NB');
    	###################
		$mdmk=$this->mdmk;
		$lowmdmk=strtolower($mdmk);
    	
    	$arr_usross=$environment->setenvironment($mdmk);$usross=$arr_usross['data'];

		import('ORG.Util.Page');
		###################
		$para=$this->para;//总字段
		$spccdtls=$this->spccdtls;
		$odrls=$this->odrls;
		//采用公版为默认显示ls（针对筛选里的ls）
		$defaultls=$this->defaultls;
		
		//NB搜索
		$arr_get=$nb->processget($_GET);$get=$arr_get['data'];
    	$jn=$this->jn;
    	###################
    	if(!$get['fld']){$fld=$this->fld_dflt;}else{$fld=$get['fld'];}//总para,挡住的意味着默认选中，总para没有挡住的可以选 fld标明选中（包括挡住默认选中的）
    	if(!$get['fld']){$cdt=$this->cdt_dflt;}else{$cdt=$get['cdt'];}//根据总字段获取cdt,其中挡住的就算了没挡住的需要体现出来，而罗列出来的需要体现
    	if(!$get['fld']){$spccdt=$this->spccdt_dflt;}else{$spccdt=$get['spccdt'];}//有多少罗列多少
    	if(!$get['fld']){$odr=$this->odr_dflt;}else{$odr=$get['odr'];}//列出多少选多少 ASC DESC 
    	if(!$get['fld']){$lmt=$this->lmt_dflt;}else{$lmt=$get['lmt'];}
    	##############有的时候hide_fld和hide_cdt不一样的
    	$hide_fld=$this->hide_dflt;$hide_cdt=$this->hide_dflt;
    	$arr=$nb->getls($para,$mdmk,$jn,$fld,$cdt,$spccdt,$odr,$lmt,$hide_fld,$hide_cdt,$spccdtls,$odrls,$defaultls);
    	$mls=$arr['data'];
    	
		$this->assign('mls',$arr['data']);

		$this->assign('ttl',$this->ttl);
		$this->display('query');
    }
    
    //公版
    public function view(){
    	header("Content-Type:text/html; charset=utf-8");
    	$environment=D('Environment');
    	$nb=D('NB');

    	$mdmk=$this->mdmk;
    	$lowmdmk=strtolower($mdmk);$this->assign('lowmdmk',$lowmdmk);

    	$arr_usross=$environment->setenvironment($mdmk);$usross=$arr_usross['data'];
    	
    	$id=$_GET['id'];
    	$para=$this->para;$this->assign('para',$para);
    	$jn=$this->jn;
    	$no_view=$this->no_view;$this->assign('no_view',$no_view);


    	$arr_mo=$nb->getmo($mdmk,$id,$para,$jn);$mo=$arr_mo['data'];
    	
    	$this->assign('mo',$mo);
    	$this->assign('ttl',$mo[$lowmdmk.'nm']);
		$this->display('view');
    }
   
   	//公版
   	public function update(){
   		header("Content-Type:text/html; charset=utf-8");
    	$environment=D('Environment');
    	$nb=D('NB');

    	$mdmk=$this->mdmk;
    	$lowmdmk=strtolower($mdmk);$this->assign('lowmdmk',$lowmdmk);
    	$notself=$this->notself;$this->assign('notself',$notself);


    	$arr_usross=$environment->setenvironment($mdmk);$usross=$arr_usross['data'];
    	
    	$id=$_GET['id'];$this->assign('id',$id);
    	$para=$this->para;$this->assign('para',$para);
    	$jn=$this->jn;
    	$no_update=$this->no_update;$this->assign('no_update',$no_update);

    	if($id==0){$mo=array();$pattern='添加';}else{
    		$arr_mo=$nb->getmo($mdmk,$id,$para,$jn);$mo=$arr_mo['data'];$pattern='修改';
    	}
    	
    	$this->assign('mo',$mo);
    	$this->assign('ttl',$mo[$lowmdmk.'nm'].$pattern);
		$this->display('update');
   	}

   	//公版
   	public function doupdate(){
   		header("Content-Type:text/html; charset=utf-8");

   		$mdmk=$this->mdmk;
   		
   		$nb=D('NB');
   		$arr_pattern=$nb->doupdate($mdmk,$_GET);
   		$pattern=$arr_pattern['data'];
   		$data['pattern']=$pattern;

   		$this->ajaxReturn($data,'json');
   	}

   	//公版
   	public function dodelete(){
   		header("Content-Type:text/html; charset=utf-8");

   		$mdmk=$this->mdmk;
   		$id=$_GET['id'];
   		$nb=D('NB');
   		$nb->dodelete($mdmk,$id);
   		
   		$this->ajaxReturn($data,'json');
   	}

}