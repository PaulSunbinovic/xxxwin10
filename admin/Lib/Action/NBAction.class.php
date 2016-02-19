<?php
// 本类由系统自动生成，仅供测试用途
class NBAction extends Action {


    public function dosearch(){
        header("Content-Type:text/html; charset=utf-8");

        $spccdtls=$this->spccdtls;
    
        $str='';
        foreach ($_GET as $key => $value) {
            if($key!='_URL_'&&$key!='nb_mdmk'){
                $str=$str.'/'.$key.'/'.urlencode($value);
            }
        }
 
        $url=C('URL').'/'.$_GET['nb_mdmk'].'/query'.$str;
        
        $data['url']=$url;
        $this->ajaxReturn($data,'json');
    }
}