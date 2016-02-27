<?php
// 本类由系统自动生成，仅供测试用途
class UsrrlAction extends Action {

	
	//预设  para一般自身的所有以及扩展的zabojingua东西
	//聚合
    private $all=array(
    	'mdmk'=>'Usrrl',//NB
  		'ttl'=>'用户——团队——角色',
  		'jn'=>array('tb_usr ON f_usrrl_usrid=usrid','tb_rl ON f_usrrl_rlid=rlid','tb_grp ON f_rl_grpid=grpid'),//NB
      //自己的全部+f的显示的东西
  		'para'=>array('usrrlid'=>'ID','f_usrrl_usrid'=>'用户','usrnn'=>'用户真名','grpnm'=>'团队名','f_usrrl_rlid'=>'角色','rlnm'=>'角色名','f_rl_grpid'=>'团队'),//NB
  		//抛去不是zabojin的属性针对para
      'notself'=>array('usrnn','rlnm','f_rl_grpid','grpnm'),
       ##########modify 添加修改中不需要展示和理会的属性 针对para
      'no_update'=>array('usrrlid','usrnn','rlnm','f_rl_grpid','grpnm'),
      #####update的时候允许为空的值 针对zabojin刨掉不然显示的update字段后
      'allowempty'=>array(),

      'hide_fld'=>array('usrrlid','f_usrrl_usrid','f_usrrl_rlid','f_rl_grpid'),//NB
      'hide_cdt'=>array('usrrlid','usrnn','rlnm','grpnm'),//NB
  		
    //   'spccdtls'=>array('spccdt_0'=>array('aaid<>0','aaID不为0【废话只是测试】')),
  		// 'odrls'=>array('aanm'),
    //   'spccdt_dflt'=>array('spccdt_0'),
    //   'odr_dflt'=>array('aanm'=>'ASC'),

      'spccdtls'=>array(),//NB
      'odrls'=>array('grpnm'),//NB
      'spccdt_dflt'=>array(),//NB
      'odr_dflt'=>array('grpnm'=>'ASC'),//NB
      //hide的fld必须有，他们虽然不显示但是必须选择，这样才能在第一次进入query的时候，隐藏属性可以被调用，特别是id和fid
  		'fld_dflt'=>array('usrrlid','f_usrrl_usrid','usrnn','grpnm','f_usrrl_rlid','rlnm','f_rl_grpid'),//NB
  		'cdt_dflt'=>array(),//NB
  		
  		'lmt_dflt'=>10,//NB
  		
  		'defaultls'=>0,//默认枚举//NB
  		##########view
  		'no_view'=>array('usrrlid','f_usrrl_usrid','f_usrrl_rlid','f_rl_grpid'),
	   
      #########删除提醒
      'deleteconfirm'=>'如果该用户在团队内没有任何职务将离开团队，确定吗？',
      #####转义
      'transmean'=>array(),//NB
      #####默认值
      'dfltvalue'=>array(),
      
    	);

    //dingzhi
    public function query(){
    	header("Content-Type:text/html; charset=utf-8");
    	$pb=D('PB');$usr=D('Usr');$tree=D('Tree');$grp=D('Grp');$rl=D('Rl');
    	$pb->query($this->all);
      //dingzhis
      $arr_usrls=$usr->getmlsbyodr('ASC');$usrls=$arr_usrls['data'];
      $usrlsnw=array();
      foreach($usrls as $usrv){
        $usrv['usrnm']=$usrv['usrnn'];
        array_push($usrlsnw,$usrv);
      }
      $this->assign('f_usrrl_usrid',$usrlsnw);

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
          $rllsall=array_merge($rllsall,$rllsnw);
          
        }
        
      }
      $this->assign('f_usrrl_rlid',$rllsall);

      $arr_grpls=$grp->getmlsbyodr('grpodr ASC');$grpls=$arr_grpls['data'];
      $arr=$tree->unlimitedForListSLCT($grpls,0,'grpid','grpnm','grppid','grpodr');
      $this->assign('f_rl_grpid',$arr);

      //dingshio
      $this->display('Cmn:query');
  
    }
    
    //公版
    public function view(){
    	header("Content-Type:text/html; charset=utf-8");
    	$pb=D('PB');
    	$pb->view($this->all);
		  $this->display('Cmn:view');
    }
   
   	//dingzhi
   	public function update(){
   		header("Content-Type:text/html; charset=utf-8");
    	$pb=D('PB');$usr=D('Usr');$tree=D('Tree');$grp=D('Grp');$rl=D('Rl');
    	$pb->update($this->all);
      //dingzhis
      $arr_usrls=$usr->getmlsbyodr('ASC');$usrls=$arr_usrls['data'];
      $usrlsnw=array();
      foreach($usrls as $usrv){
        $usrv['usrnm']=$usrv['usrnn'];
        array_push($usrlsnw,$usrv);
      }
      $this->assign('f_usrrl_usrid',$usrlsnw);

      $arr_grpls=$grp->getmlsbyodr('grpodr ASC');$grpls=$arr_grpls['data'];
      $grpls_onodr=$tree->unlimitedForListID($grpls,0,'grpid','grpnm','grppid','grpodr');
      $rllsall=array();
      foreach($grpls_onodr as $grpv){
        $grpid=$grpv['grpid'];
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
      $this->assign('f_usrrl_rlid',$rllsall);


      //dingshio
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