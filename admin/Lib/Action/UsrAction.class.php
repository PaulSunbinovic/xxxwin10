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
        'deleteconfirm'=>'确定要删除此条记录？',
        #####转义
        'transmean'=>array('usrmk'=>array('0'=>'否','1'=>'是'),'usrps'=>array('0'=>'否','1'=>'是'),'usrvw'=>array('0'=>'否','1'=>'是')),
        #####默认值
        'dfltvalue'=>array('usrmk'=>0,'usrpw'=>'11111111','usrpt'=>'/xxx/Public/img/usr/default.jpg','usrps'=>0,'usrvw'=>0),
        #####update的时候允许为空的值抛去no_update不用管的哪些zabojin的属性外允许空的
        'allowempty'=>array('usrcp','usrml'),
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
        $usr=D(Usr);

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

    //公版
    public function dodelete(){
        header("Content-Type:text/html; charset=utf-8");
        $pb=D('PB');
        $pb->dodelete($this->all);
        
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
}