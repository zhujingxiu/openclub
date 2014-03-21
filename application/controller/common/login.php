<?php  
class ControllerCommonLogin extends Controller { 
	private $error = array();
	          
	public function index() { 
		
    	$this->language->load('common/login');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->document->setBodyClass('login');
		
		$this->document->addStyle('protected/view/stylesheet/login.css');
		
		$this->document->addScript('asset/js/jquery.validate.min.js');
				
		if ($this->user->isLogged() ) {
			$this->redirect($this->url->link('common/home', '' , 'SSL'));
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) { 
		
			
			
			if (isset($this->request->post['redirect'])) {
				
				$this->redirect($this->request->post['redirect'] );
			} else {
				$this->redirect($this->url->link('common/home', '' , 'SSL'));
			}
		}
		
    	$this->data['heading_title'] = $this->language->get('heading_title');
    	
		//Login
		$this->data['text_login'] = $this->language->get('text_login');
		$this->data['text_forgotten'] = $this->language->get('text_forgotten');
		$this->data['error_null'] = $this->language->get('error_null');
		$this->data['entry_username'] = $this->language->get('entry_username');
    	$this->data['entry_password'] = $this->language->get('entry_password');
    	$this->data['entry_remeber'] = $this->language->get('entry_remeber');
    	$this->data['button_login'] = $this->language->get('button_login');
    	
    	//Forgotten
    	
    	//Register
    	$this->data['text_account_already'] = sprintf($this->language->get('text_account_already'), $this->url->link('account/login', '', 'SSL'));
		$this->data['text_your_details'] = $this->language->get('text_your_details');
    	$this->data['text_your_address'] = $this->language->get('text_your_address');
    	$this->data['text_your_password'] = $this->language->get('text_your_password');
		$this->data['text_newsletter'] = $this->language->get('text_newsletter');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_none'] = $this->language->get('text_none');
						
    	$this->data['entry_firstname'] = $this->language->get('entry_firstname');
    	$this->data['entry_lastname'] = $this->language->get('entry_lastname');
    	$this->data['entry_email'] = $this->language->get('entry_email');
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');

    	$this->data['entry_password'] = $this->language->get('entry_password');
    	$this->data['entry_confirm'] = $this->language->get('entry_confirm');

    	
				
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->error['l_username'])) {
			$this->data['error_l_username'] = $this->error['l_username'];
		} else {
			$this->data['error_l_username'] = '';
		}
		
		if (isset($this->session->data['success'])) {
    		$this->data['success'] = $this->session->data['success'];
    
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
				
    	$this->data['login_action'] = $this->url->link('common/login', 'action=login', 'SSL');
    	
    	$this->data['forgotten_action'] = $this->url->link('common/login', 'action=forgotten', 'SSL');
    	
    	$this->data['register_action'] = $this->url->link('common/login', 'action=register', 'SSL');

		if (isset($this->request->post['username'])) {
			$this->data['username'] = $this->request->post['username'];
		} else {
			$this->data['username'] = '';
		}
		
		if (isset($this->request->post['password'])) {
			$this->data['password'] = $this->request->post['password'];
		} else {
			$this->data['password'] = '';
		}

		if (isset($this->request->get['route'])) {
			$route = $this->request->get['route'];
			
			unset($this->request->get['route']);
			
			if (isset($this->request->get['token'])) {
				unset($this->request->get['token']);
			}
			
			$url = '';
						
			if ($this->request->get) {
				$url .= http_build_query($this->request->get);
			}
			
			$this->data['redirect'] = $this->url->link($route, $url, 'SSL');
		} else {
			$this->data['redirect'] = '';	
		}
		
		if ($this->config->get('config_password')) {
			$this->data['forgotten'] = $this->url->link('common/forgotten', '', 'SSL');
		} else {
			$this->data['forgotten'] = '';
		}
		
		$this->template = 'common/login.tpl';
		$this->children = array(
			'common/header',
			
		);
				
		$this->response->setOutput($this->render());
  	}
		
	public function validate() {
		
		if(!empty($this->request->get['action'])){
			
			switch (strtolower($this->request->get['action'])){
				case 'login':
					if (isset($this->request->post['username']) && isset($this->request->post['password']) && !$this->user->login($this->request->post['username'], $this->request->post['password'],isset($this->request->post['remember']))) {
						$this->error['warning'] = $this->language->get('error_login');
						$this->error['l_username']=	isset($this->request->post['username']) ? $this->request->post['username'] :'';
						$this->error['l_password']=	isset($this->request->post['password']) ? $this->request->post['password'] :'';
					}
					break;
				case 'forgotten':
					
					break;
				case 'check_account':
					$this->load->model('user/user');
					if ($this->model_user_user->getUserByUsername($this->request->post['username'])) {
				      	echo "false";	      	
				    }else{
				    	echo "true";
				    }
				    exit;
					break;
				case 'register':
						$this->load->model('user/user');
						if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
				      		$this->error['email'] = $this->language->get('error_email');
				    	}
				
				    	if ($this->model_user_user->getTotalUsersByEmail($this->request->post['email'])) {
				      		$this->error['warning'] = $this->language->get('error_exists');
				    	}
				    	
						if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
				      		$this->error['password'] = $this->language->get('error_password');
				    	}
				
				    	if ($this->request->post['rpassword'] != $this->request->post['password']) {
				      		$this->error['confirm'] = $this->language->get('error_confirm');
				    	}
				    	
				    	if (!$this->error) {
				    		$user_id  = $this->model_user_user->addUser($this->request->post);
				    		if(!$user_id){
				    			$this->error['account'] = $this->language->get('error_account');
				    		}else{
				    			$this->session->data['user_id'] = $user_id;				    			
				    		}
				    	}
					break;
			}
			if (!$this->error) {
				return true;
			} else {
				return false;
			}
		}else{
			
			return false;
		}
	}
	
}  
?>