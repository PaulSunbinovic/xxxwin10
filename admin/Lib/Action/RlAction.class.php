<?php
// 本类由系统自动生成，仅供测试用途
class RlAction extends Action {

	
	//预设  para一般自身的所有以及扩展的zabojingua东西
	//聚合
    private $all=array(
    	'mdmk'=>'Rl',//NB
  		'ttl'=>'角色',
  		'jn'=>array('tb_grp ON f_rl_grpid=grpid'),//NB
      //自己的全部+f的显示的东西
  		'para'=>array('rlid'=>'rlID','rlnm'=>'角色名称','f_rl_grpid'=>'团队','grpnm'=>'团队名称'),//NB
  		//抛去不是zabojin的属性针对para
      'notself'=>array('grpnm'),
       ##########modify 添加修改中不需要展示和理会的属性 针对para
      'no_update'=>array('rlid','grpnm'),
      #####update的时候允许为空的值 针对zabojin刨掉不然显示的update字段后
      'allowempty'=>array(),

      'hide_fld'=>array('rlid','f_rl_grpid'),//NB
      'hide_cdt'=>array('rlid','grpnm'),//NB
  		
    //   'spccdtls'=>array('spccdt_0'=>array('aaid<>0','aaID不为0【废话只是测试】')),
  		// 'odrls'=>array('aanm'),
    //   'spccdt_dflt'=>array('spccdt_0'),
    //   'odr_dflt'=>array('aanm'=>'ASC'),

      'spccdtls'=>array(),//NB
      'odrls'=>array('grpnm'),//NB
      'spccdt_dflt'=>array(),//NB
      'odr_dflt'=>array('grpnm'=>'ASC'),//NB
      //hide的fld必须有，他们虽然不显示但是必须选择，这样才能在第一次进入query的时候，隐藏属性可以被调用，特别是id和fid
  		'fld_dflt'=>array('rlid','rlnm','f_rl_grpid','grpnm'),//NB
  		'cdt_dflt'=>array(),//NB
  		
  		'lmt_dflt'=>10,//NB
  		
  		'defaultls'=>0,//默认枚举//NB
  		##########view
  		'no_view'=>array('rlid','f_rl_grpid'),
	   
      #########删除提醒
      'deleteconfirm'=>'删除角色将会使得依附该角色的用户失去工作？',
      #####转义
      'transmean'=>array(),//NB
      #####默认值
      'dfltvalue'=>array(),
      
    	);

    //dingzhi
    public function query(){
    	header("Content-Type:text/html; charset=utf-8");
    	$pb=D('PB');$tree=D('Tree');$grp=D('Grp');
    	$pb->query($this->all);
      #dingzhis
      #手动枚举
      $arr_grpls=$grp->getmlsbyodr('grpodr ASC');$grpls=$arr_grpls['data'];
      $arr=$tree->unlimitedForListSLCT($grpls,0,'grpid','grpnm','grppid','grpodr');
      $this->assign('f_rl_grpid',$arr);
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