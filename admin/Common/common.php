<?php
function p($array){
	dump($array,1,'<pre>',0);//1表示输出 0表示以print_r方式打印
}
function vd($array){
	var_dump($array);
}
function https_request($url,$data=null){
	$crl=curl_init();
	curl_setopt($crl, CURLOPT_URL, $url);
	curl_setopt($crl,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($crl, CURLOPT_SSL_VERIFYHOST,false);
	
	if(!empty($data)){
		curl_setopt($crl, CURLOPT_POST,1);
		curl_setopt($crl, CURLOPT_POSTFIELDS,$data);
		
	}
	curl_setopt($crl,CURLOPT_RETURNTRANSFER,1);
	$output=curl_exec($crl);
	curl_close($crl);
	
	return $output; 
}
function rplspc($str){
	$str=str_replace(' ','+',$str);
	return $str;
}
/*
用法 logger('BB','log/log1.txt');(推荐)     logger('BB','./log/log1.txt');  logger('BB','log.txt');
 */
function logger($log_content,$log_filename){
		
	if(!$log_filename){
		$log_filename='log/log.txt';//默认根目录
	}

	//################注销掉就是不对大小做限制了
	// $max_size=1024*1024*10;//默认字节Byte 10MB
	// if(file_exists($log_filename)&&abs(filesize($log_filename))>$max_size){
	// 	unlink($log_filename);
	// }
	//#######################
	
	//date_default_timezone_set('PRC');
	
	if($log_content=='#'){
		file_put_contents($log_filename, '###################################################'."\r\n",FILE_APPEND);//双引号才换行##
	}else{
		file_put_contents($log_filename, date('Y-m-d H:i:s',time()).' '.$log_content."\r\n",FILE_APPEND);//双引号才换行
	}
	
}

function url2arr($url,$json){
	if(C('psnvs')!=1){
		$json=https_request($url);
	}
	$arr=json_decode($json,true);
	if($arr['code']!='A00000'){
		logger('#','log/log_'.date('Y-m-d',time()).'.txt');
		logger('url: '.$url,'log/log_'.date('Y-m-d',time()).'.txt');
		logger('json: '.$json,'log/log_'.date('Y-m-d',time()).'.txt');
	}
	$arr['url']=$url;
	return $arr;

}

function str2json($str){
	$arr=json_decode($str,true);
	$json=json_encode($arr);
	return $json;
}

############
function createarrok($cd,$data,$msg,$info){
	$code=createcode($cd);$rslt=1;$msg?$msg=$msg:$msg='ok';
	$arr['data']=$data;$arr['code']=$code;$arr['rslt']=$rslt;$arr['msg']=$msg;$arr['info']=$info;
	return $arr;
}
######
function createarrerr($cd,$msg,$info){
	$code=createcode($cd);$rslt=0;$msg?$msg=$msg:$msg='error';
	$arr['data']=null;$arr['code']=$code;$arr['rslt']=$rslt;$arr['msg']=$msg;$arr['info']=$info;
	logger('#','log/log_'.date('Y-m-d',time()).'.txt');
	logger('event: '.json_encode($arr,JSON_UNESCAPED_UNICODE),'log/log_'.date('Y-m-d',time()).'.txt');
	return $arr;
}
#######
function collectinfo($mtd,$para,$valuels){
	$arr['method']=$mtd;
	$parau=explode(',',$para);
	for($i=0;$i<count($valuels);$i++){
		$key=explode('$',$parau[$i])[1];
		$arr[$key]=$valuels[$i];
	}
	return json_encode($arr);
}
##########
function createcode($cd){
	if($cd=='ok'){
		$code='A00000';
	}else{
		$asc=0;
		for($i=0;$i<strlen($cd);$i++){
			$char=$cd[$i];
			$asc=$asc+ord($char);
			
		}
		$asc=(String)$asc;
		$bits=strlen($asc);
		if($bits<=5){$zeronum=5-$bits;}else{$zeronum=0;}
		$zero='';
		for($i=0;$i<$zeronum;$i++){
			$zero=$zero.'0';
		}
		$code='A'.$zero.$asc;
	}
	return $code;
}
?>