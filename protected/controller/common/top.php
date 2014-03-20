<?php 
class ControllerCommonTop extends Controller {
	protected function index() {
		
		$this->language->load('common/top');
		$this->data['base']	= HTTP_SERVER;
		$this->data['profile']	= $this->url->link('common/profile','','SSL');
		$this->data['logout']	= $this->url->link('common/logout','','SSL');
	
		$this->template = 'common/top.tpl';
		
		$this->render();
	}
}
?>