<?php   
class ControllerCommonHome extends Controller {   
	public function index() {
		
    	$this->language->load('common/home');
	 
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->document->addStyle('asset/css/jquery.gritter.css');
		$this->document->addStyle('asset/css/daterangepicker.css');
		$this->document->addStyle('asset/css/fullcalendar.css');
		$this->document->addStyle('asset/css/jqvmap.css');
		$this->document->addStyle('asset/css/jquery.easy-pie-chart.css');
		
		//$this->document->addScript('asset/js/jquery.vmap.js');
		//$this->document->addScript('asset/js/jquery.vmap.russia.js');
		//$this->document->addScript('asset/js/jquery.vmap.world.js');
		//$this->document->addScript('asset/js/jquery.vmap.europe.js');
		//$this->document->addScript('asset/js/jquery.vmap.germany.js');
		//$this->document->addScript('asset/js/jquery.vmap.usa.js');
		//$this->document->addScript('asset/js/jquery.vmap.sampledata.js');
		$this->document->addScript('asset/js/jquery.flot.js');
		$this->document->addScript('asset/js/date.js');
		$this->document->addScript('asset/js/daterangepicker.js');
		$this->document->addScript('asset/js/jquery.gritter.js');
		$this->document->addScript('asset/js/fullcalendar.min.js');
		$this->document->addScript('asset/js/jquery.easy-pie-chart.js');
		$this->document->addScript('asset/js/jquery.sparkline.min.js');
		
		$this->document->addScript('application/view/javascript/index.js');
		
		
    	$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_overview'] = $this->language->get('text_overview');
		$this->data['text_statistics'] = $this->language->get('text_statistics');
		
		$this->data['text_total_sale'] = $this->language->get('text_total_sale');
		$this->data['text_total_sale_year'] = $this->language->get('text_total_sale_year');
		$this->data['text_total_order'] = $this->language->get('text_total_order');
		$this->data['text_total_customer'] = $this->language->get('text_total_customer');
		$this->data['text_total_review_approval'] = $this->language->get('text_total_review_approval');
		$this->data['text_day'] = $this->language->get('text_day');
		$this->data['text_week'] = $this->language->get('text_week');
		$this->data['text_month'] = $this->language->get('text_month');
		$this->data['text_year'] = $this->language->get('text_year');
		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_order'] = $this->language->get('column_order');
		$this->data['column_customer'] = $this->language->get('column_customer');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_total'] = $this->language->get('column_total');
		$this->data['column_firstname'] = $this->language->get('column_firstname');
		$this->data['column_lastname'] = $this->language->get('column_lastname');
		$this->data['column_action'] = $this->language->get('column_action');
		
		$this->data['entry_range'] = $this->language->get('entry_range');
		
		$this->dir_writable();
										
		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', '' , 'SSL'),
      		'separator' => false
   		);
		
		$this->data['orders'] = array(); 
			
		$this->template = 'common/home.tpl';
		
		$this->children = array(
			'common/header',
			'common/footer',
			'common/top',
			'common/sidebar'
		);
				
		$this->response->setOutput($this->render());
  	}
  	
	public function login() {
		$route = '';
		
		if (isset($this->request->get['route'])) {
			$part = explode('/', $this->request->get['route']);
			
			if (isset($part[0])) {
				$route .= $part[0];
			}
			
			if (isset($part[1])) {
				$route .= '/' . $part[1];
			}
		}
		
		$ignore = array(
			'common/login',
			'common/forgotten',
			'common/reset'
		);	
					
		if (!$this->user->isLogged() && !in_array($route, $ignore)) {
			return $this->forward('common/login');
		}
		
	}
	
	public function permission() {
		if (isset($this->request->get['route'])) {
			$route = '';
			
			$part = explode('/', $this->request->get['route']);
			
			if (isset($part[0])) {
				$route .= $part[0];
			}
			
			if (isset($part[1])) {
				$route .= '/' . $part[1];
			}
			
			$ignore = initAdminIgnoreRoute();		
			if (!in_array($route, $ignore) && !$this->user->hasPermission('access', isset($part[2]) ? $route.'/'.$part[2] : $route.'/index')) {
				return $this->forward('error/permission');
			}
		}
	}
	
  	private function dir_writable(){
  		
  		// Check image directory is writable
		$file = DIR_IMAGE . 'test';
		
		$handle = fopen($file, 'a+'); 
		
		fwrite($handle, '');
			
		fclose($handle); 		
		
		if (!file_exists($file)) {
			$this->data['error_image'] = sprintf($this->language->get('error_image'). DIR_IMAGE);
		} else {
			$this->data['error_image'] = '';
			
			unlink($file);
		}
		
		// Check image cache directory is writable
		$file = DIR_IMAGE . 'cache/test';
		
		$handle = fopen($file, 'a+'); 
		
		fwrite($handle, '');
			
		fclose($handle); 		
		
		if (!file_exists($file)) {
			$this->data['error_image_cache'] = sprintf($this->language->get('error_image_cache'). DIR_IMAGE . 'cache/');
		} else {
			$this->data['error_image_cache'] = '';
			
			unlink($file);
		}
		
		// Check cache directory is writable
		$file = DIR_CACHE . 'test';
		
		$handle = fopen($file, 'a+'); 
		
		fwrite($handle, '');
			
		fclose($handle); 		
		
		if (!file_exists($file)) {
			$this->data['error_cache'] = sprintf($this->language->get('error_image_cache'). DIR_CACHE);
		} else {
			$this->data['error_cache'] = '';
			
			unlink($file);
		}
		
		// Check download directory is writable
		$file = DIR_DOWNLOAD . 'test';
		
		$handle = fopen($file, 'a+'); 
		
		fwrite($handle, '');
			
		fclose($handle); 		
		
		if (!file_exists($file)) {
			$this->data['error_download'] = sprintf($this->language->get('error_download'). DIR_DOWNLOAD);
		} else {
			$this->data['error_download'] = '';
			
			unlink($file);
		}
		
		// Check logs directory is writable
		$file = DIR_LOGS . 'test';
		
		$handle = fopen($file, 'a+'); 
		
		fwrite($handle, '');
			
		fclose($handle); 		
		
		if (!file_exists($file)) {
			$this->data['error_logs'] = sprintf($this->language->get('error_logs'). DIR_LOGS);
		} else {
			$this->data['error_logs'] = '';
			
			unlink($file);
		}
  	}
}
?>
