<?php
class ControllerCommonDownload extends Controller {
	public function index(){
		if(!empty($this->request->get['file'])){
			$fname=$this->request->get['file'];
			$index=strrpos($fname,'/');
			$downloadFname=substr($fname,$index+1);
			if(!empty($this->request->get['downloadName'])){
				$downloadFname=$this->request->get['downloadName'];
			}
			$absPath=$_SERVER['DOCUMENT_ROOT'].$fname;
			if(!file_exists($absPath)){
				echo 'file not found';
			　　exit();
			}else{
				$file = fopen($absPath,"r"); // 打开文件
				// 输入文件标签
				Header("Content-type: application/octet-stream");
				Header("Accept-Ranges: bytes");
				Header("Accept-Length: ".filesize($absPath));
				Header("Content-Disposition: attachment; filename=".$downloadFname);
				// 输出文件内容
				echo fread($file,filesize($absPath));
				fclose($file);
				exit();
			}
		}
	}
}
?>