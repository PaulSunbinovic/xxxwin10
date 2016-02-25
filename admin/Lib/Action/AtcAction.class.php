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
      'odrls'=>array('atctp','atcmdftm'),//NB
      'spccdt_dflt'=>array(),//NB
      'odr_dflt'=>array('atctp'=>'DESC','atcmdftm'=>'DESC'),//NB
      //hide的fld必须有，他们虽然不显示但是必须选择，这样才能在第一次进入query的时候，隐藏属性可以被调用，特别是id和fid
  		'fld_dflt'=>array('atcid','f_atc_bdid','bdnm','atctpc','atcath','atcaddtm','atcmdftm','atctp','atcps','atcanc','atcdnmc','atccnt','atcnw','atczn','atctc','atcvw'),//NB
  		'cdt_dflt'=>array(),//NB
  		
  		'lmt_dflt'=>10,//NB
  		
  		'defaultls'=>1,//默认枚举//NB
  		##########view
  		'no_view'=>array('atcid','f_atc_bdid','atccv','atcsmr','atcctt'),
	   
      #########删除提醒
      'deleteconfirm'=>'确定要删除此条记录？',
      #####转义
      'transmean'=>array('atctp'=>array('0'=>'否','1'=>'是'),'atcps'=>array('0'=>'否','1'=>'是'),'atcanc'=>array('0'=>'否','1'=>'是'),'atcdnmc'=>array('0'=>'否','1'=>'是'),'atcnw'=>array('0'=>'否','1'=>'是'),'atcvw'=>array('0'=>'否','1'=>'是'),),//NB
      #####默认值
      'dfltvalue'=>array('atcvw'=>1,'atctp'=>0,'atcps'=>0,'atcanc'=>0,'atcdnmc'=>0,'atccnt'=>0,'atcnw'=>0,'atczn'=>0,'atctc'=>0,'atcvw'=>0),
      
    	);

    //公版
    public function query(){
    	header("Content-Type:text/html; charset=utf-8");
    	$pb=D('PB');$tree=D('Tree');$bd=D('Bd');
    	$pb->query($this->all);
      #dingzhis
      #手动枚举并覆盖
      $arr_bdls=$bd->getmlsbyodr('bdodr ASC');$bdls=$arr_bdls['data'];
      $arr=$tree->unlimitedForListSLCT($bdls,0,'bdid','bdnm','bdpid','bdodr');
      $this->assign('f_atc_bdid',$arr);
      #dingzhio
      $this->display('Cmn:query');
  
    }
    
    //dingzhi
    public function view(){
    	header("Content-Type:text/html; charset=utf-8");
    	//dingzhis
      $environment=D('Environment');$atc=D('Atc');$tree=D('Tree');$bd=D('Bd');

      $all=$this->all;

      $para=$all['para'];$this->assign('para',$para);
      $no_view=$all['no_view'];$this->assign('no_view',$no_view);

      $mdmk=$all['mdmk'];

      $arr_usross=$environment->setenvironment($mdmk);$usross=$arr_usross['data'];
      
      $atcid=$_GET['id'];
      $arr_mo=$atc->getmo($atcid);$mo=$arr_mo['data'];

      $arr_bdls=$bd->getmlsbyodr('bdodr ASC');$bdls=$arr_bdls['data'];
      $str=$tree->findF($bdls, $mo['f_atc_bdid'], 'bdid','bdnm','bdpid');
      $this->assign('tree',$str);

      //对文章内容进行小调整
      $imgrule='/<img.*src=(\"|\')(.+)\1.*>/U';//图片规则
      if (preg_match_all($imgrule,$mo['atcctt'],$quote)){
        //p($quote);die;//$quote平时可以随意查看，有帮助，特别是$quoto[1]代表了啥，2代表了啥，0代表了啥
        for($i=0;$i<count($quote[0]);$i++){
          if(!preg_match("/icon_/", $quote[2][$i]))
          $mo['atcctt']=str_replace($quote[0][$i], "<a href='".$quote[2][$i]."'>".$quote[0][$i].'</a>', $mo['atcctt']);
        }
      }

      $arr_nwcnt=$atc->addatccnt($mo['atccnt'],$atcid);$nwcnt=$arr_nwcnt['data'];
      $mo['atccnt']=$nwcnt;

     
      $transmean=$all['transmean'];
      foreach($mo as $k=>$v){
        if(isset($transmean[$k])){
          $mo[$k]=$transmean[$k][$mo[$k]];
        }
      }
      $this->assign('mo',$mo);
      $this->assign('ttl',$mo['atctpc']);

      //dingzhio
		  $this->display('view');
    }
   
   	//
   	public function update(){
   		header("Content-Type:text/html; charset=utf-8");
    	$pb=D('PB');$bd=D('Bd');$tree=D('Tree');
    	$pb->update($this->all);
      //dingzhis
      $this->assign('project',C('PROJECT'));//为editor而生//为默认图片而生
      #手动枚举并覆盖
      $arr_bdls=$bd->getmlsbyodr('bdodr ASC');$bdls=$arr_bdls['data'];
      $arr=$tree->unlimitedForListSLCT($bdls,0,'bdid','bdnm','bdpid','bdodr');
      $this->assign('f_atc_bdid',$arr);
      //dingzhio
		  $this->display('update');
   	}

   	//公版
   	public function doupdate(){
   		$atc=D('Atc');

        $all=$this->all;
        $get=$_GET;
        
        $id=$get['atcid'];
        unset($get['atcid']);
        unset($get['_URL_']);

        $get['atcctt']=stripslashes($get['atcctt']);

        if($id==0){
            $get['atcaddtm']=date('Y-m-d h:m:s');
            $get['atcmdftm']=date('Y-m-d h:m:s');
            $atc->add($get);
            $pattern=0;
        }else{
            $get['atcmdftm']=date('Y-m-d h:m:s');
            $atc->mdf($get,$id);
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

}