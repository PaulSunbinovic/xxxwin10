<?php
// 本类由系统自动生成，仅供测试用途
class UsrAction extends Action {
	//预设  para一般自身的所有以及扩展的zabojingua东西
    //聚合
    private $all=array(
        'mdmk'=>'Usr',
        'ttl'=>'用户',
        'jn'=>array(),
        'para'=>array('usrid'=>'usrID','usrmk'=>'是否管理员','usrnm'=>'用户名','usrpw'=>'密码','usrnn'=>'真名','usrpt'=>'头像','usraddtm'=>'添加时间','usrmdftm'=>'修改时间','usrcp'=>'手机号','usrml'=>'邮箱','usrps'=>'是否通过','usrvw'=>'是否查看过','usrodr'=>'顺序'),
        //抛去不是zabojin的属性
        'notself'=>array(),
        'hide_fld'=>array('usrid','usrpw'),
        'hide_cdt'=>array('usrid','usrpw','usrpt','usrodr'),

        //   'spccdtls'=>array('spccdt_0'=>array('aaid<>0','aaID不为0【废话只是测试】')),
        // 'odrls'=>array('aanm'),
        //   'spccdt_dflt'=>array('spccdt_0'),
        //   'odr_dflt'=>array('aanm'=>'ASC'),

        'spccdtls'=>array(),
        'odrls'=>array('usrodr'),
        'spccdt_dflt'=>array(),
        'odr_dflt'=>array('usrodr'=>'ASC'),

        'fld_dflt'=>array('usrid','usrmk','usrnm','usrnn','usrpt','usraddtm','usrmdftm','usrcp','usrml','usrps','usrvw','usrodr'),
        'cdt_dflt'=>array(),
        
        'lmt_dflt'=>10,
        
        'defaultls'=>1,//默认枚举
        ##########view
        'no_view'=>array('usrid','usrpw'),
        ##########modify//不用显示不用考虑的属性
        'no_update'=>array('usrid','usrpw','usraddtm','usrmdftm'),
        #########删除提醒
        'deleteconfirm'=>'删除用户会导致usrrl相应的数据删除，确定？',
        #####转义
        'transmean'=>array('usrmk'=>array('0'=>'否','1'=>'是'),'usrps'=>array('0'=>'否','1'=>'是'),'usrvw'=>array('0'=>'否','1'=>'是')),
        #####默认值
        'dfltvalue'=>array('usrmk'=>0,'usrpw'=>'11111111','usrpt'=>'/xxx/Public/img/usr/default.jpg','usrps'=>1,'usrvw'=>1),
        #####update的时候允许为空的值抛去no_update不用管的哪些zabojin的属性外允许空的
        'allowempty'=>array('usrcp','usrml'),
        //dingzhi
        'no_usrct'=>array('usrid','usrpw','usrvw','usrodr'),
        'no_usrupdate'=>array('usrid','usrmk','usrpw','usraddtm','usrmdftm','usrps','usrvw','usrodr'),
        );

    //定制
    public function query(){
        header("Content-Type:text/html; charset=utf-8");
        $pb=D('PB');
        $pb->query($this->all);
        $this->display('query');
  
    }
    
    //定制
    public function view(){
        header("Content-Type:text/html; charset=utf-8");
        $pb=D('PB');
        $pb->view($this->all);
        $this->display('view');
    }
   
    //定制
    public function update(){
        header("Content-Type:text/html; charset=utf-8");
        $pb=D('PB');
        $pb->update($this->all);
        $this->display('update');
    }

    //定制
    public function doupdate(){
        header("Content-Type:text/html; charset=utf-8");
        $usr=D('Usr');

        $all=$this->all;
        $get=$_GET;
        
        $id=$get['usrid'];
        unset($get['usrid']);
        unset($get['_URL_']);

        if($id==0){
            $get['usrpw']=md5('11111111');
            $get['usraddtm']=date('Y-m-d h:m:s');
            $get['usrmdftm']=date('Y-m-d h:m:s');
            $usr->add($get);
            $pattern=0;
        }else{
            $get['usrmdftm']=date('Y-m-d h:m:s');
            $usr->mdf($get,$id);
            $pattern=1;
        }
        
        $data['pattern']=$pattern;
        $this->ajaxReturn($data,'json');
    }

    //dingzhi
    public function dodelete(){
      header("Content-Type:text/html; charset=utf-8");
      //dingzhis
      $usr=D('Usr');
      
      $usrid=$_GET['id'];
      $usr->delete($usrid);
      //dingzhio
      $this->ajaxReturn($data,'json');
    }
    
	
	//#########index
    public function dologin(){
    	header("Content-Type:text/html; charset=utf-8");
		    
    	$usr=D('Usr');
		
    	$usrnm=$_GET['usrnm'];
    	$usrpw=$_GET['usrpw'];
    	$rmb=$_GET['rmb'];

    	$arr=$usr->login($usrnm,$usrpw,$rmb);
    	$rslt=$arr['data']['rslt'];
    	$msg=$arr['msg'];

    	$data['rslt']=$rslt;$data['msg']=$msg;
		$this->ajaxReturn($data,'json');
	}

    //#########index
    public function doresetusrpw(){
        header("Content-Type:text/html; charset=utf-8");
            
        $usr=D('Usr');

        $id=$_GET['id'];
        
        $arr=$usr->resetusrpw($id);
        $msg=$arr['msg'];

        $data['msg']=$msg;
        $this->ajaxReturn($data,'json');
    }

    //定制
    public function usrct(){
        header("Content-Type:text/html; charset=utf-8");
        
		$environment=D('Environment');
    	
    	$all=$this->all;
    	$mdmk=$all['mdmk'];
    	$lowmdmk=strtolower($mdmk);$this->assign('lowmdmk',$lowmdmk);

    	$arr_usross=$environment->setenvironment($mdmk);$usross=$arr_usross['data'];
    	
    	$para=$all['para'];$this->assign('para',$para);
    	$no_usrct=$all['no_usrct'];$this->assign('no_usrct',$no_usrct);

    	$mo=$usross;

    	$transmean=$all['transmean'];
    	foreach($mo as $k=>$v){
    		if(isset($transmean[$k])){
    			$mo[$k]=$transmean[$k][$mo[$k]];
    		}
    	}
    	
    	$this->assign('mo',$mo);
    	$this->assign('ttl',$mo['usrnn']);
        $this->display('usrct');
    }

    //定制
    public function usrupdate(){
        header("Content-Type:text/html; charset=utf-8");

        $environment=D('Environment');
    	$all=$this->all;
    	$mdmk=$all['mdmk'];
    	$lowmdmk=strtolower($mdmk);$this->assign('lowmdmk',$lowmdmk);
    	$notself=$all['notself'];$this->assign('notself',$notself);
    	$transmean=$all['transmean'];$this->assign('transmean',$transmean);


    	$arr_usross=$environment->setenvironment($mdmk);$usross=$arr_usross['data'];
    	
    	$id=$usross['usrid'];$this->assign('id',$id);
    	$para=$all['para'];$this->assign('para',$para);
    	$jn=$all['jn'];
    	$no_usrupdate=$all['no_usrupdate'];$this->assign('no_usrupdate',$no_usrupdate);
    	$dfltvalue=$all['dfltvalue'];
    	$allowempty=$all['allowempty'];$this->assign('allowempty',$allowempty);

    	$defaultls=$all['defaultls'];
    	if($defaultls){
	    	//甭管添加还是修改 zabojingua 属性必须要ls给好
	    	foreach($para as $k=>$v){
	    		if(!in_array($k,$notself)){
					$tmp=explode('_', $k);
					$tmp=explode('id',$tmp[2]);
					$tmp=$tmp[0];$tmp=M($tmp);
					$this->assign($k,$tmp->select());
				}
				if(isset($transmean[$k])){
					$this->assign($k,$transmean[$k]);
				}
			}
		}

    	if($id==0){$mo=$dfltvalue;$pattern='注册';}else{$mo=$usross;$pattern='修改个人信息';}
    	
    	$this->assign('mo',$mo);
    	$this->assign('moforjs',transforjs($mo));
    	$this->assign('ttl',$pattern);
        $this->display('usrupdate');
    }

    public function usrmdfpw(){
    	header("Content-Type:text/html; charset=utf-8");

    	$environment=D('Environment');
    	$arr_usross=$environment->setenvironment($mdmk);$usross=$arr_usross['data'];
    	$id=$usross['usrid'];$this->assign('id',$id);
    	$this->assign('mo',$usross);

    	$this->assign('ttl','修改密码');
        $this->display('usrmdfpw');
    }

    public function domdfusrpw(){
    	header("Content-Type:text/html; charset=utf-8");
            
        $usr=D('Usr');

        $usrid=$_GET['usrid'];
        $originusrpw=$_GET['originusrpw'];
        $nwusrpw=$_GET['nwusrpw'];

        $arr_check=$usr->checkusrpw($usrid,$originusrpw);
        $rslt=$arr_check['data'];
        if($rslt==1){
        	$usr->mdfusrpw($usrid,$nwusrpw);
        }else{
        	$msg=$arr_check['msg'];
        }

        $data['rslt']=$rslt;
        $data['msg']=$msg;
       
        $this->ajaxReturn($data,'json');
    }
}