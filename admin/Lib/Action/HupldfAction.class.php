<?php 

//规矩：需要display的 就m mls 不需要的 只要cstmusro cstmusrls 之类，方便批量移植
class HupldfAction extends Action{
	
	function upload(){
		header('Content-type: application/octet-stream;charset=UTF-8');
		$sys=D('Sys');

		//由于一些新版的apache 和 ngix不支持HTTP_X_FILENAME，所以直接判断"php://input"来的实惠
		$content = file_get_contents("php://input");

		//在js里头做了点小文章，把tail提取出来存在session里，回头会消掉的
    	$tail=session('tail');
		// if($content){
		// 	p(urlencode($content));die;
		// }
	
		// $fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);
		
		if ($content) {
			//生成一个临时的session存放他送来的照片地址，再后来可以销毁
			// $tm=time();
			// $tmp=explode('.',$fn);
			// $nwflnm=$tm.'.'.$tmp[1];
			$nwflnm=time().'.'.$tail;	
			$folder=$_GET['folder'];

			file_put_contents(
			'./Uploads/'.$folder.'/' . $nwflnm,
			$content
			);
			//设置图片信息到数据库
				
			session('myfl','/'.C('PROJECT').'/Uploads/'.$folder.'/'.$nwflnm);
			
			exit();
		}
		
	}
	
	function showphoto(){
		$data['myfl']=session('myfl');
		session('myfl',null);
		session('tail',null);
		
		$data['status']=1;
		$this->ajaxReturn($data,'json');
		
	}

	public function dogivetail(){
		header("Content-Type:text/html; charset=utf-8");
		$tail=$_GET['tail'];
		session('tail',$tail);
		$this->ajaxReturn($data,'json');
	}
	

}



?>