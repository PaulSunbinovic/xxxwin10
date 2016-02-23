<?php
// 本类由系统自动生成，仅供测试用途
class UsrgrpAction extends Action {

	
	//预设  para一般自身的所有以及扩展的zabojingua东西
	//聚合
    private $all=array(
    	'mdmk'=>'Usrgrp',//NB
  		'ttl'=>'用户——团队关系',
  		'jn'=>array('tb_usr ON f_usrgrp_usrid=usrid','tb_grp ON f_usrgrp_grpid=grpid'),//NB
      //自己的全部+f的显示的东西
  		'para'=>array('usrgrpid'=>'usrgrpID','f_usrgrp_usrid'=>'用户','usrnn'=>'用户真名','f_usrgrp_grpid'=>'团队','grpnm'=>'团队名称',),//NB
  		//抛去不是zabojin的属性针对para
      'notself'=>array('usrnn','grpnm'),
       ##########modify 添加修改中不需要展示和理会的属性 针对para
      'no_update'=>array('usrgrpid','usrnn','grpnm'),
      #####update的时候允许为空的值 针对zabojin刨掉不然显示的update字段后
      'allowempty'=>array(),

      'hide_fld'=>array('usrgrpid','f_usrgrp_usrid','f_usrgrp_grpid'),//NB
      'hide_cdt'=>array('usrgrpid','usrnn','grpnm'),//NB
  		
    //   'spccdtls'=>array('spccdt_0'=>array('aaid<>0','aaID不为0【废话只是测试】')),
  		// 'odrls'=>array('aanm'),
    //   'spccdt_dflt'=>array('spccdt_0'),
    //   'odr_dflt'=>array('aanm'=>'ASC'),

      'spccdtls'=>array(),//NB
      'odrls'=>array(),//NB
      'spccdt_dflt'=>array(),//NB
      'odr_dflt'=>array(),//NB
      //hide的fld必须有，他们虽然不显示但是必须选择，这样才能在第一次进入query的时候，隐藏属性可以被调用，特别是id和fid
  		'fld_dflt'=>array('usrgrpid','f_usrgrp_usrid','usrnn','f_usrgrp_grpid','grpnm'),//NB
  		'cdt_dflt'=>array(),//NB
  		
  		'lmt_dflt'=>10,//NB
  		
  		'defaultls'=>0,//默认枚举//NB
  		##########view
  		'no_view'=>array('usrgrpid','f_usrgrp_usrid','f_usrgrp_grpid'),
	   
      #########删除提醒
      'deleteconfirm'=>'确定要删除此条记录？',
      #####转义
      'transmean'=>array(),//NB
      #####默认值
      'dfltvalue'=>array(),
      
    	);

    //定制 由于用户 团队 权限有着千丝万缕的联系因此这里就保留浏览功能以及删除功能，相当于离职
    public function query(){
    	header("Content-Type:text/html; charset=utf-8");
    	$pb=D('PB');$usr=D('Usr');$tree=D('Tree');$grp=D('Grp');
    	$pb->query($this->all);
      //dingzhis
      $arr_usrls=$usr->getmlsbyodr('ASC');$usrls=$arr_usrls['data'];
      $usrlsnw=array();
      foreach($usrls as $usrv){
        $usrv['usrnm']=$usrv['usrnn'];
        array_push($usrlsnw,$usrv);
      }
      $this->assign('f_usrgrp_usrid',$usrlsnw);

      $arr_grpls=$grp->getmlsbyodr('grpodr ASC');$grpls=$arr_grpls['data'];
      $arr=$tree->unlimitedForListSLCT($grpls,0,'grpid','grpnm','grppid','grpodr');
      $this->assign('f_usrgrp_grpid',$arr);
      //dingzhio
      $this->display('query');
  
    }
    
    // //公版
    // public function view(){
    // 	header("Content-Type:text/html; charset=utf-8");
    // 	$pb=D('PB');
    // 	$pb->view($this->all);
		  // $this->display('Cmn:view');
    // }
   
   	// //公版
   	// public function update(){
   	// 	header("Content-Type:text/html; charset=utf-8");
    // 	$pb=D('PB');
    // 	$pb->update($this->all);
		  // $this->display('Cmn:update');
   	// }

   	// //公版
   	// public function doupdate(){
   	// 	header("Content-Type:text/html; charset=utf-8");
   	// 	$pb=D('PB');
   	// 	$arr_pattern=$pb->doupdate($this->all);
   	// 	$data['pattern']=$arr_pattern['pattern'];

   	// 	$this->ajaxReturn($data,'json');
   	// }

   	//公版
   	public function dodelete(){
   		header("Content-Type:text/html; charset=utf-8");
   		$pb=D('PB');
   		$pb->dodelete($this->all);
  		
   		$this->ajaxReturn($data,'json');
   	}

}