<?php    
class ControllerErrorPermission extends Controller {    
	public function index() { 
    	$this->language->load('error/permission');
  
    	$this->document->setTitle($this->language->get('heading_title'));
		
    	$this->document->addStyle('protected/view/stylesheet/error.css');
    	
    	$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_permission'] = $this->language->get('text_permission');
													
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', '' , 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('error/permission', '' , 'SSL'),
      		'separator' => ' :: '
   		);

		$this->template = 'error/permission.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
			'common/top',
			'common/sidebar'
		);
				
		$this->response->setOutput($this->render());
  	}
}
?>