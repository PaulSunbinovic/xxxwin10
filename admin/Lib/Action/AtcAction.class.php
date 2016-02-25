<?php
// 本类由系统自动生成，仅供测试用途
class AtcAction extends Action {

	
	//预设  para一般自身的所有以及扩展的zabojingua东西
	//聚合
    private $all=array(
    	'mdmk'=>'Atc',//NB
  		'ttl'=>'文章',
  		'jn'=>array('tb_bd ON f_atc_bdid=bdid'),//NB
      //自己的全部+f的显示的东西
  		'para'=>array('atcid'=>'ID','f_atc_bdid'=>'板块','bdnm'=>'板块名称','atctpc'=>'标题','atcath'=>'作者','atcaddtm'=>'添加时间','atcmdftm'=>'修改时间','atctp'=>'是否置顶','atcps'=>'是否审核','atcanc'=>'是否通知','atcdnmc'=>'是否动态','atcctt'=>'正文','atccnt'=>'阅读数','atcnw'=>'是否内网','atczn'=>'赞','atctc'=>'吐槽','atcvw'=>'是否查看','atccv'=>'封面','atcsmr'=>'摘要'),//NB
  		//抛去不是zabojin的属性针对para
      'notself'=>array('bdnm'),
       ##########modify 添加修改中不需要展示和理会的属性 针对para
      'no_update'=>array('atcid','bdnm','atcaddtm','atcmdftm'),
      #####update的时候允许为空的值 针对zabojin刨掉不然显示的update字段后
      'allowempty'=>array('atcsmr'),

      'hide_fld'=>array('atcid','f_atc_bdid','atcctt','atccv','atcsmr'),//NB
      'hide_cdt'=>array('atcid','bdnm'),//NB
  		
    //   'spccdtls'=>array('spccdt_0'=>array('aaid<>0','aaID不为0【废话只是测试】')),
  		// 'odrls'=>array('aanm'),
    //   'spccdt_dflt'=>array('spccdt_0'),
    //   'odr_dflt'=>array('aanm'=>'ASC'),

      'spccdtls'=>array(),//NB
      'odrls'=>array(),//NB
      'spccdt_dflt'=>array(),//NB
      'odr_dflt'=>array(),//NB
      //hide的fld必须有，他们虽然不显示但是必须选择，这样才能在第一次进入query的时候，隐藏属性可以被调用，特别是id和fid
  		'fld_dflt'=>array('atcid','f_atc_bdid','bdnm','atctpc','atcath','atcaddtm','atcmdftm','atctp','atcps','atcanc','atcdnmc','atccnt','atcnw','atczn','atctc','atcvw'),//NB
  		'cdt_dflt'=>array(),//NB
  		
  		'lmt_dflt'=>10,//NB
  		
  		'defaultls'=>1,//默认枚举//NB
  		##########view
  		'no_view'=>array('atcid','f_atc_bdid'),
	   
      #########删除提醒
      'deleteconfirm'=>'确定要删除此条记录？',
      #####转义
      'transmean'=>array('atctp'=>array('0'=>'否','1'=>'是'),'atcps'=>array('0'=>'否','1'=>'是'),'atcanc'=>array('0'=>'否','1'=>'是'),'atcdnmc'=>array('0'=>'否','1'=>'是'),'atcnw'=>array('0'=>'否','1'=>'是'),'atcvw'=>array('0'=>'否','1'=>'是'),),//NB
      #####默认值
      'dfltvalue'=>array('atcvw'=>1),
      
    	);

    //公版
    public function query(){
    	header("Content-Type:text/html; charset=utf-8");
    	$pb=D('PB');$tree=D('Tree');$bd=D('Bd');
    	$pb->query($this->all);
      #dingzhis
      #手动枚举并覆盖
      $arr_bdls=$bd->getmlsbyodr('bdodr ASC');$bdls=$arr_bdls['data'];
      $arr=$tree->unlimitedForListSLCT($bdls,0,'bdid','bdnm','bdpid','bdodr');p($arr);die;
      $this->assign('f_atc_bdid',$arr);
      #dingzhio
      $this->display('Cmn:query');
  
    }
    
    //公版
    public function view(){
    	header("Content-Type:text/html; charset=utf-8");
    	$pb=D('PB');
    	$pb->view($this->all);
		  $this->display('Cmn:view');
    }
   
   	//公版
   	public function update(){
   		header("Content-Type:text/html; charset=utf-8");
    	$pb=D('PB');
    	$pb->update($this->all);
		  $this->display('Cmn:update');
   	}

   	//公版
   	public function doupdate(){
   		header("Content-Type:text/html; charset=utf-8");
   		$pb=D('PB');
   		$arr_pattern=$pb->doupdate($this->all);
   		$data['pattern']=$arr_pattern['pattern'];

   		$this->ajaxReturn($data,'json');
   	}

   	//公版
   	public function dodelete(){
   		header("Content-Type:text/html; charset=utf-8");
   		$pb=D('PB');
   		$pb->dodelete($this->all);
  		
   		$this->ajaxReturn($data,'json');
   	}

}