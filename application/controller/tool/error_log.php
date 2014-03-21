<?php 
class ControllerToolErrorLog extends Controller { 
	private $error = array();
	
	public function index() {		
		$this->language->load('tool/error_log');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		 
		$this->data['button_clear'] = $this->language->get('button_clear');

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),       		
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('tool/error_log', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		//for livelyservice by jason
		$this->data['button_clearcache'] = $this->language->get('button_clearcache');
		$this->data['clearcache'] = $this->url->link('tool/error_log/clearcache', 'token=' . $this->session->data['token'], 'SSL');
   		//for livelyservice by jason
		$this->data['clear'] = $this->url->link('tool/error_log/clear', 'token=' . $this->session->data['token'], 'SSL');
		
		$file = DIR_LOGS . $this->config->get('config_error_filename');
		
		if (file_exists($file)) {
			$this->data['log'] = file_get_contents($file, FILE_USE_INCLUDE_PATH, null);
		} else {
			$this->data['log'] = '';
		}

		$this->template = 'tool/error_log.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	//for livelyservice by jason
	public function clearcache() {
		$this->load->language('tool/error_log');
		$files = glob(DIR_CACHE . 'cache.*');
		foreach($files as $file){
			$this->deldir($file);
		}
        $imgfiles = glob(DIR_IMAGE . 'cache/*');
        foreach($imgfiles as $imgfile){
            $this->deldir($imgfile);
		}
		$this->session->data['success'] = $this->language->get('text_successch');
		
		$this->redirect($this->url->link('tool/error_log', 'token=' . $this->session->data['token'], 'SSL'));		
	}
    public function deldir($dirname){         
		if(file_exists($dirname)) {
			if(is_dir($dirname)){
                $dir=opendir($dirname);
                while($filename=readdir($dir)){
                    if($filename!="." && $filename!=".."){
                        $file=$dirname."/".$filename;
						$this->deldir($file); 
                    }
                }
               	closedir($dir);  
                rmdir($dirname);
            }else {
            	@unlink($dirname);
            }			
		}
	}
	//for livelyservice by jason
	public function clear() {
		$this->language->load('tool/error_log');
		
		$file = DIR_LOGS . $this->config->get('config_error_filename');
		
		$handle = fopen($file, 'w+'); 
				
		fclose($handle); 			
		
		$this->session->data['success'] = $this->language->get('text_success');
		
		$this->redirect($this->url->link('tool/error_log', 'token=' . $this->session->data['token'], 'SSL'));		
	}
}
?>