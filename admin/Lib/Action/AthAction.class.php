<?php
// 本类由系统自动生成，仅供测试用途
class AthAction extends Action {

	
	//预设  para一般自身的所有以及扩展的zabojingua东西
	//聚合
    private $all=array(
    	'mdmk'=>'Ath',//NB
  		'ttl'=>'权限',
  		'jn'=>array('tb_rl ON f_ath_rlid=rlid','tb_grp ON f_rl_grpid=grpid','tb_md ON f_ath_mdid=mdid'),//NB
      //自己的全部+f的显示的东西
  		'para'=>array('athid'=>'ID','grpnm'=>'团队名','f_ath_rlid'=>'角色','rlnm'=>'角色名','f_rl_grpid'=>'角色名','f_ath_mdid'=>'模版','mdnm'=>'模板名','atha'=>'增加','athd'=>'删除','athm'=>'修改','athv'=>'查看','aths'=>'设置'),//NB
  		//抛去不是zabojin的属性针对para
      'notself'=>array('rlnm','mdnm','f_rl_grpid','grpnm'),
       ##########modify 添加修改中不需要展示和理会的属性 针对para
      'no_update'=>array('athid','rlnm','mdnm','f_rl_grpid','grpnm'),
      #####update的时候允许为空的值 针对zabojin刨掉不然显示的update字段后
      'allowempty'=>array(),

      'hide_fld'=>array('athid','f_ath_rlid','f_rl_grpid','f_ath_mdid'),//NB
      'hide_cdt'=>array('athid','grpnm','rlnm','f_rl_grpid','mdnm','atha','athd','athm','athv','aths'),//NB
  		
    //   'spccdtls'=>array('spccdt_0'=>array('aaid<>0','aaID不为0【废话只是测试】')),
  		// 'odrls'=>array('aanm'),
    //   'spccdt_dflt'=>array('spccdt_0'),
    //   'odr_dflt'=>array('aanm'=>'ASC'),

      'spccdtls'=>array(),//NB
      'odrls'=>array('grpnm'),//NB
      'spccdt_dflt'=>array(),//NB
      'odr_dflt'=>array('grpnm'=>'ASC'),//NB
      //hide的fld必须有，他们虽然不显示但是必须选择，这样才能在第一次进入query的时候，隐藏属性可以被调用，特别是id和fid
  		'fld_dflt'=>array('athid','grpnm','f_ath_rlid','rlnm','f_rl_grpid','f_ath_mdid','mdnm','atha','athd','athm','athv','aths'),//NB
  		'cdt_dflt'=>array(),//NB
  		
  		'lmt_dflt'=>10,//NB
  		
  		'defaultls'=>1,//默认枚举//NB
  		##########view
  		'no_view'=>array('athid','f_ath_rlid','f_rl_grpid','f_ath_mdid'),
	   
      #########删除提醒
      'deleteconfirm'=>'确定要删除此条记录？',
      #####转义
      'transmean'=>array('atha'=>array('0'=>'否','1'=>'是'),'athd'=>array('0'=>'否','1'=>'是'),'athm'=>array('0'=>'否','1'=>'是'),'athv'=>array('0'=>'否','1'=>'是'),'aths'=>array('0'=>'否','1'=>'是')),//NB
      #####默认值
      'dfltvalue'=>array(),
      
    	);

    //dingzhi
    public function query(){
    	header("Content-Type:text/html; charset=utf-8");
    	$pb=D('PB');$tree=D('Tree');$grp=D('Grp');$rl=D('Rl');
    	$pb->query($this->all);
      //dingzhis
      //覆盖
      $arr_grpls=$grp->getmlsbyodr('grpodr ASC');$grpls=$arr_grpls['data'];
      $grpidls=$tree->unlimitedForListID($grpls,0,'grpid','grpnm','grppid','grpodr');
      $rllsall=array();
      foreach($grpidls as $grpidv){
        $grpid=$grpidv;
        $arr_rlls=$rl->getmlsbygrpid($grpid);$rlls=$arr_rlls['data'];
        if($rlls){
          $rllsnw=array();
          foreach($rlls as $rlv){
            $rlv['rlnm']='【'.$rlv['grpnm'].'】'.$rlv['rlnm'];
            array_push($rllsnw,$rlv);
          }
          if($rllsall){
            $rllsall=array_merge($rllsall,$rllsnw);
          }else{
            $rllsall=$rllsnw;
          }
        }
        
      }
      $this->assign('f_ath_rlid',$rllsall);
      //dingzhio
      $this->display('query');
  
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