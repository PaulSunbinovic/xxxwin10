<?php
// 本类由系统自动生成，仅供测试用途
class LbAction extends Action {

	
	//预设  para一般自身的所有以及扩展的zabojingua东西
	//聚合
    private $all=array(
    	'mdmk'=>'Lb',
  		'ttl'=>'大类',
  		'jn'=>array(),
  		'para'=>array('lbid'=>'列表ID','lbnm'=>'列表名称','lbodr'=>'列表顺序'),
  		'notself'=>array(),
  		'spccdtls'=>array('spccdt_0'=>array('lbid<>0','列表ID不为0【废话只是测试】')),
  		'odrls'=>array('lbodr'),
  		'fld_dflt'=>array('lbid','lbnm','lbodr'),
  		'cdt_dflt'=>array('lbnm'=>'类',),
  		'spccdt_dflt'=>array('spccdt_0'),
  		'odr_dflt'=>array('lbodr'=>'ASC'),
  		'lmt_dflt'=>10,
  		'hide_cdt'=>array('lbid'),
  		'hide_fld'=>array('lbid'),
  		'defaultls'=>1,
  		##########view
  		'no_view'=>array('lbid'),
  	    ##########modify
	    'no_update'=>array('lbid'),
      'deleteconfirm'=>'删除改记录同时会删除该大类下属的模块，确定删除么？',
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
   		$lb=D('Lb');
   		$lb->dodelete($_GET['id']);
  		
   		$this->ajaxReturn($data,'json');
   	}

}