<?php
class ControllerCommonSidebar extends Controller {   
	protected function index() {
		$this->language->load('common/sidebar');
		
		$this->data['text_footer'] = $this->language->get('text_footer');
		
		$this->data['base']	= HTTP_SERVER;
		
		$this->data['permission_node']	= $this->url->link('setting/permission_node','','SSL');
		
		$this->data['user']	= $this->url->link('user/user','','SSL');
		
		$this->data['role']	= $this->url->link('user/user_role','','SSL');
		
		$this->template = 'common/sidebar.tpl';
	
    	$this->render();
  	}
}
?>