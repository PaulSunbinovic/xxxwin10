<?php
// 本类由系统自动生成，仅供测试用途
class AaAction extends Action {

	
	//预设  para一般自身的所有以及扩展的zabojingua东西
	//聚合
    private $all=array(
    	'mdmk'=>'Aa',
  		'ttl'=>'aa测试',
  		'jn'=>array('tb_bb ON f_aa_bbid=bbid'),
  		'para'=>array('aaid'=>'aaID','aanm'=>'aa名称','f_aa_bbid'=>'bb名称','bbnm'=>'bb名称'),
  		'notself'=>array('bbnm'),
      'hide_fld'=>array('aaid','f_aa_bbid'),
      'hide_cdt'=>array('aaid','bbnm'),
  		
    //   'spccdtls'=>array('spccdt_0'=>array('aaid<>0','aaID不为0【废话只是测试】')),
  		// 'odrls'=>array('aanm'),
    //   'spccdt_dflt'=>array('spccdt_0'),
    //   'odr_dflt'=>array('aanm'=>'ASC'),

      'spccdtls'=>array(),
      'odrls'=>array(),
      'spccdt_dflt'=>array(),
      'odr_dflt'=>array(),

  		'fld_dflt'=>array('aaid','aanm','bbnm'),
  		'cdt_dflt'=>array('aanm'=>'a',),
  		
  		'lmt_dflt'=>10,
  		
  		'defaultls'=>1,//默认枚举
  		##########view
  		'no_view'=>array('aaid','f_aa_bbid'),
	    ##########modify
	    'no_update'=>array('aaid','bbnm'),

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
   		$pb=D('PB');
   		$pb->dodelete($this->all);
  		
   		$this->ajaxReturn($data,'json');
   	}

}