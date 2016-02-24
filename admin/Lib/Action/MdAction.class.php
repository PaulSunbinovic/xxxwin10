<?php
// 本类由系统自动生成，仅供测试用途
class MdAction extends Action {

	
	//预设  para一般自身的所有以及扩展的zabojingua东西
	//聚合
    private $all=array(
    	'mdmk'=>'Md',
  		'ttl'=>'模块',
  		'jn'=>array('tb_lb ON f_md_lbid=lbid'),
  		'para'=>array('mdid'=>'','f_md_lbid'=>'列表大类','lbnm'=>'列表名称','mdmk'=>'模块标示','mdnm'=>'模块名称','mdodr'=>'模块顺序'),
  		'notself'=>array('lbnm'),
      'hide_fld'=>array('mdid','f_md_lbid'),
      'hide_cdt'=>array('mdid','lbnm'),
  		
    //   'spccdtls'=>array('spccdt_0'=>array('aaid<>0','aaID不为0【废话只是测试】')),
  		// 'odrls'=>array('aanm'),
    //   'spccdt_dflt'=>array('spccdt_0'),
    //   'odr_dflt'=>array('aanm'=>'ASC'),

      'spccdtls'=>array(),
      'odrls'=>array('mdodr'),
      'spccdt_dflt'=>array(),
      'odr_dflt'=>array('mdodr'=>'ASC'),

  		'fld_dflt'=>array('mdid','f_md_lbid','lbnm','mdmk','mdnm','mdodr'),
  		'cdt_dflt'=>array(),
  		
  		'lmt_dflt'=>10,
  		
  		'defaultls'=>1,//默认枚举
  		##########view
  		'no_view'=>array('mdid','f_md_lbid'),
	    ##########modify
	    'no_update'=>array('mdid','lbnm'),
      #########删除提醒
      'deleteconfirm'=>'删除md势必造成ath中的相应权限删除？',
      #####转义
      'transmean'=>array(),
      #####默认值
      'dfltvalue'=>array(),
      #####update的时候允许为空的值
      'allowempty'=>array(),

    	);

    //公版
    public function query(){
    	header("Content-Type:text/html; charset=utf-8");
    	$pb=D('PB');
    	$pb->query($this->all);
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

   	//dingzhi
   	public function doupdate(){
   		header("Content-Type:text/html; charset=utf-8");
   		$pb=D('PB');$ath=D('Ath');
   		$arr_pattern=$pb->doupdate($this->all);
   		$data['pattern']=$arr_pattern['pattern'];
      //dingzhis
      //添加了模块必然会导致ath的增加
      $mdid=$_GET['mdid'];
      $ath->addbymdid($mdid);
      //dingzhio
   		$this->ajaxReturn($data,'json');
   	}

   	//dingzhi
   	public function dodelete(){
   		header("Content-Type:text/html; charset=utf-8");
   		//dingzhis
      $md=D('Md');
      $mdid=$_GET['id'];
      $md->delete($mdid);
      //dingzhio
   		$this->ajaxReturn($data,'json');
   	}

}