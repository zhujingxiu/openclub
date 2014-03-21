<?php 
class ControllerCommonHeader extends Controller {
	protected function index() {
		$this->data['title'] = $this->document->getTitle(); 

		$this->data['base'] = HTTP_SERVER;
		
		$this->data['description'] = $this->document->getDescription();
		$this->data['keywords'] = $this->document->getKeywords();
		$this->data['links'] = $this->document->getLinks();	
		$this->data['styles'] = $this->document->getStyles();
		$this->data['scripts'] = $this->document->getScripts();
		$this->data['lang'] = $this->language->get('code');
		$this->data['direction'] = $this->language->get('direction');
		
		$this->data['body_class'] = $this->document->getBodyClass();
		
		$this->language->load('common/header');

		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_all_users'] = $this->language->get('text_all_users');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_documentation'] = $this->language->get('text_documentation');
		$this->data['text_front'] = $this->language->get('text_front');
		$this->data['text_help'] = $this->language->get('text_help');
		$this->data['text_logout'] = $this->language->get('text_logout');
		$this->data['text_confirm'] = $this->language->get('text_confirm');

		if (!$this->user->isLogged() ) {
			$this->data['logged'] = '';
			$this->data['home'] = $this->url->link('common/login', '', 'SSL');
		} else {
			
			$this->data['logged'] = sprintf($this->language->get('text_logged'), $this->user->getUserName(),$this->user->getFirstName());
            $user_menu = $this->user->getMenu();
            $this->data['menu'] = '';

			$this->data['home'] = $this->url->link('common/home', '' , 'SSL');
			$this->data['logout'] = $this->url->link('common/logout', '', 'SSL');
			
			$this->load->model('user/user');			
			$this->data['all_users'] = $this->model_user_user->getUsers(array('status'=>1));
						
		}
		
		$this->template = 'common/header.tpl';
		
		$this->render();
	}
}
?>