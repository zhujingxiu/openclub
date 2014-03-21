<?php  
class ControllerCommonUpload extends Controller {
	public function index(){
		$result=array('status'=>'ok','msg'=>'');
		if (!empty($_FILES)){
			$timePath=date('Ymd',time());
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$basePath=$_SERVER['DOCUMENT_ROOT'].'/uploads';
			if(!file_exists($basePath)){
				mkdir($basePath);
			}
			$targetPath = $basePath.'/'.$timePath;
			if(!file_exists($targetPath)){
				mkdir($targetPath);
			}
			
	
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png','doc','docx','txt','facebook'); // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			$fileName=md5(time().uniqid()).'.'.$fileParts['extension'];
			$targetFile = rtrim($targetPath,'/') . '/'. $fileName;
			$imgUri='/uploads/'.$timePath.'/'.$fileName;
			
			if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile,$targetFile);
				$result['status']='ok';
				$result['msg']=$imgUri;
			} else {
				$result['status']='error';
				$result['msg']='Invalid file type,only '.join(' | ',$fileTypes).' can accept.';
			}
		}
		echo json_encode($result);
	}
	
	public function types(){
		$result=array('status'=>'ok','msg'=>'');
		if (!empty($_FILES)){
			if (($_FILES["Filedata"]["size"] / 1024)>2000) {
				$result['status']='error';
				$result['msg']='Warning: File too big ,please keep below 2Mb !';
				echo json_encode($result);
				exit;
			}
			
			$timePath=date('Ymd',time());
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$basePath=$_SERVER['DOCUMENT_ROOT'].'/uploads';
			if(!file_exists($basePath)){
				mkdir($basePath);
			}
			$targetPath = $basePath.'/'.$timePath;
			if(!file_exists($targetPath)){
				mkdir($targetPath);
			}	
			// Validate the file type
			if(!isset($_GET['type'])){
				$fileTypes = array('txt'); // File extensions
			}else{
				$fileTypes = explode("|", $_GET['type']);
			}
			
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			$fileName=md5(time().uniqid()).'.'.$fileParts['extension'];
			$targetFile = rtrim($targetPath,'/') . '/'. $fileName;
			$imgUri='../uploads/'.$timePath.'/'.$fileName;
			 if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile,$targetFile);
				$result['status']='ok';
				$result['msg']=$imgUri;
			} else {
				$result['status']='error';
				$result['msg']='Invalid file type,only '.join(' | ',$fileTypes).' can accept.';
			}
		}
		echo json_encode($result);
	}
}
?>