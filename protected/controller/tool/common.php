<?php
class ControllerToolsCommon extends Controller { 
	public function spin(){
		
		$this->language->load('tools/spin');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),       		
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('tools/common/spin', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
	
		$this->template = 'tools/common_spin.tpl';
				
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());
	}
	public function world_clock(){
	
		$this->language->load('tools/world_clock');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),       		
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('tools/common/world_clock', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['entry_server_time'] = $this->language->get('entry_server_time');
   		$this->data['entry_local_time'] = $this->language->get('entry_local_time');
		
		$this->template = 'tools/common_world_clock.tpl';
				
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());
	}
	
	public function different_name(){
		
		$this->language->load('tools/different_name');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),       		
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('tools/common/different_name', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		$this->data['token']=$this->session->data['token'];
   		$this->data['entry_first'] = $this->language->get('entry_first');
   		$this->data['entry_second'] = $this->language->get('entry_second');
   		$this->data['entry_result'] = $this->language->get('entry_result');
		
		$this->template = 'tools/common_different_name.tpl';
				
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());
	}
	
	public function check_diff_name(){
		$first_file = isset($this->request->post['first_file'])  ? trim($this->request->post['first_file']) : false ;
		$second_file = isset($this->request->post['second_file']) ? trim($this->request->post['second_file']) : false;
		$first_file_name = isset($this->request->post['first_file_name'])  ? trim($this->request->post['first_file_name']) : false ;
		$second_file_name = isset($this->request->post['second_file_name']) ? trim($this->request->post['second_file_name']) : false;
		if($first_file ===false || $second_file ===false || !file_exists($first_file) || !file_exists($second_file)){
			echo json_encode(array('status'=>0,'msg'=>'File Exception!'));
			exit;
		}
		$first_content = file_get_contents($first_file);
		$second_content = file_get_contents($second_file);
		$diff = $first_array = $second_array =  array();
		if($first_content && $second_content){
			$first_array = explode("\n", $first_content);
			$second_array = explode("\n", $second_content);
			if($first_array){
				foreach ($first_array as $kf => $vf){
					$first_array[$kf] = strtolower(trim($vf));
				}
			}
			if($second_array){
				foreach ($second_array as $ks => $vs){
					$second_array[$ks] = strtolower(trim($vs));
				}
			}
			if($first_array && $second_array){
				foreach ($first_array as $first_item){
					if(!in_array($first_item, $second_array)){
						$diff[] = $first_item;
					}
				}
				foreach ($second_array as $second_item){
					if(!in_array($second_item, $first_array)){
						$diff[] = $second_item;
					}
				}
			}
		}
		$basePath=rtrim($_SERVER['DOCUMENT_ROOT'],"/").'/download';
		if(!file_exists($basePath)){
			mkdir($basePath);
		}
		$fileName=date('YmdHi',time()).'-diff-name-'.md5(time().uniqid()).'.txt';
		$targetFile = rtrim($basePath,'/') . '/'. $fileName;
		$handle = @fopen($targetFile, "w");
		require_once DIR_SYSTEM."library/client.php";
		$client = new Client();
		$client_info = $client->Get_Useragent();
		
		if(strtolower($client_info['os_code'])=='windows'){
			$suffix = "\r\n";
		}else if(strtolower($client_info['os_code'])=='macos'){
			$suffix = "\r";
		}else{
			$suffix = "\n";
		}
		if($diff){
			foreach ($diff as $item){
				@fwrite($handle,$item.$suffix);
			}
		}
		@fclose($handle);
		$file_path = '/download/'.$fileName;
		$downloadUrl= 'index.php?route=common/download&token='.$this->session->data['token'].'&file='.$file_path."&downloadName=diff_name.txt";
		
		$msg = '<dl style="margin-top:0px;margin-bottom:0px;"><dd><span>First File:'.$first_file_name.'</span></dd><dd><span>Second File:'.$second_file_name.'</span></dd><dd><span>Totals:'.count($diff).'</span> <a id="can-copy-a" style="text-align:right;color:#0066CC;text-decoration:underline;">copy</a> <a target="_blank" filename="diff_name.txt" href="'.$downloadUrl.'" style="text-align:right;color:#0066CC;text-decoration:underline;">download</a><dd></dl><pre name="code" style="margin:5px;padding:5px;border:1px solid #cccccc;">'.implode("\n", $diff).'</pre>';
		echo json_encode(array('status'=>1,'msg'=>$msg));
		@unlink($first_file);
		@unlink($second_file);
		
		exit;
	}
	public function parsing_excel(){
		
		$this->document->setTitle("Parsing Excel");
		$this->data['heading_title'] = "Parsing Excel";
		
		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),       		
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => "Parsing Excel",
			'href'      => $this->url->link('tools/common/parsing_excel', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		$this->data['token']=$this->session->data['token'];

   		$this->data['entry_result'] = $this->language->get('entry_result');
		
		$this->template = 'tools/common_parsing_excel.tpl';
				
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());
	}
	public function parsing_file(){
		$first_file = isset($this->request->post['first_file'])  ? trim($this->request->post['first_file']) : false ;
		$second_file = isset($this->request->post['second_file']) ? trim($this->request->post['second_file']) : false;
		$first_file_name = isset($this->request->post['first_file_name'])  ? trim($this->request->post['first_file_name']) : false ;
		$second_file_name = isset($this->request->post['second_file_name']) ? trim($this->request->post['second_file_name']) : false;
		if($first_file ===false || $second_file ===false || !file_exists($first_file) || !file_exists($second_file)){
			echo json_encode(array('status'=>0,'msg'=>'File Exception!'));
			exit;
		}
		$first_content = readExcel($first_file);
		$second_content = readExcel($second_file);
		$this->data['token']=$this->session->data['token'];
		$diff = $first_array = $second_array =  array();
		if($first_content && $second_content){

			if(count($first_content)>1){
				foreach ($first_content as $fkey => $fitem){
					if($fkey && isset($fitem[1])){
						$first_array[trim($fitem[1])] = $fitem;
					}
				}
			}
			if(count($second_content)>1){
				foreach ($second_content as $skey => $sitem){
					if($skey && isset($sitem[1])){
						$second_array[trim($sitem[1])] = $sitem;
					}
				}
			}

			if($first_array && $second_array){
				foreach ($first_array as $key1 => $first_item){
					if(!array_key_exists($key1, $second_array)){
						$diff[$key1] = $first_item;
					}
				}
				foreach ($second_array as $key2 =>$second_item){
					if(!array_key_exists($key2, $first_array)){
						$diff[$key2] = $second_item;
					}
				}
				ksort($diff);
			}
		}
		$basePath=rtrim($_SERVER['DOCUMENT_ROOT'],"/").'/download';
		if(!file_exists($basePath)){
			@mkdir($basePath);
		}
		$fileName=date('YmdHi',time()).'-parsing-file-'.md5(time().uniqid()).'.xls';
		$targetFile = rtrim($basePath,'/') . '/'. $fileName;
		
		$items= array();
		if($diff){
			$offset = 2;
			foreach ($diff as $k => $val){
				if(is_array($val)){
					$A_key = "A".$offset;
					$B_key = "B".$offset;
					$C_key = "C".$offset;
					$items[] = array($A_key=>$val[0],$B_key=>$val[1],$C_key=>$val[2]);
				}
				$offset++;
			}
		}
		if(count($items)){
			$first_line = array('A1'=>$first_content[0][0],'B1'=>$first_content[0][1],'C1'=>$first_content[0][2]);
		
			$customer = $this->user->getFirstName()." ".$this->user->getLastName();
			$data = array('first_line'=>$first_line,'items'=>$items,'setting'=>array('creator'=>$customer,'lastModified'=>$customer,'title'=>'Parsing File','subject'=>'Parsing File'));
			
			if(writeExcel($targetFile,$data)){
				$status = 1;
				$downloadUrl= 'index.php?route=common/download&token='.$this->session->data['token'].'&file=/download/'.$fileName."&downloadName=parsing_file.xls";
				$msg = '<dl style="margin-top:0px;margin-bottom:0px;"><dd><span>First File:'.$first_file_name.'</span></dd><dd><span>Second File:'.$second_file_name.'</span></dd><dd><span>Totals:'.count($items).'</span> <a href="'.$downloadUrl.'" style="text-align:right;color:#0066CC;text-decoration:underline;">download</a><dd></dl>';
			}else{
				$status = 0;
				$msg = "Error!Please upload the correct file!";
			}
		}else{
			$status = 0;
			$msg = "Error!Please upload the correct file!";
		}
		echo json_encode(array('status'=>$status,'msg'=>$msg));
		@unlink($first_file);
		@unlink($second_file);
		exit;
	}
}