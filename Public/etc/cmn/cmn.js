function rmvblk(prmts){//remove blank 去空格
	var prmtsnw='';//parameters new
	prmtsun=prmts.split('&');//parameters union
	for(var i=0;i<prmtsun.length;i++){
		if(i!=prmtsun.length-1){
			prmtsnw=prmtsnw+prmtsun[i].split('=')[0]+'='+superTrim(prmtsun[i].split('=')[1],'+')+'&';
		}else{
			prmtsnw=prmtsnw+prmtsun[i].split('=')[0]+'='+superTrim(prmtsun[i].split('=')[1],'+');
		}
	}
	return prmtsnw;
}

function  superTrim(str,ch) {  
	if(str.length>0 && str.indexOf(ch)!=-1){ //it is a string and have ch
	while(str.substring(0,1)==ch)  
			  str  =  str.substring(1,str.length);  
	while(str.substring(str.length-1,str.length)==ch)  
		str   =   str.substring(0,str.length-1);  
	}
	return   str;  
}

function isempty(str){
	var str=$.trim(str.val());
	if(str==''){return true;}else{return false;}
}

$(function(){
	$('#showhideleft').click(function(){
		var left=$('#left');var right=$('#right');var showhideright=$('#showhideright');
		left.hide();right.attr('class','col-md-12 nopadding right');showhideright.show();
		
	})
	$('#showhideright').click(function(){
		var left=$('#left');var right=$('#right');var showhideright=$('#showhideright');
		left.show();right.attr('class','col-md-10 nopadding right');showhideright.hide();
		
	})
})