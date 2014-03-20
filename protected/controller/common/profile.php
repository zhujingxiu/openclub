<?php 
class ControllerCommonProfile extends Controller {
	private $error = array();
	      
  	public function index() {
  		
  		$this->language->load('common/profile');
  		
  		$this->document->setTitle($this->language->get('heading_title'));

  		$this->document->addStyle('asset/css/bootstrap-fileupload.css');
		$this->document->addStyle('asset/css/chosen.css');
		$this->document->addStyle('asset/css/profile.css');
  		
  		$this->document->addScript('asset/js/bootstrap-fileupload.js');
		$this->document->addScript('asset/js/chosen.jquery.min.js');
		
		$this->document->addScript('asset/js/jquery.validate.min.js');
  		
		$this->template = 'common/profile.tpl';
		
		$this->data['success'] = $this->data['error'] = $this->data['warning'] = '';
		
  		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) { 
		
			$this->data['success'] = $this->session->data['success']; 
			
			
		}
		$this->session->data['success'] = '';
		
		$this->data['action'] = $this->url->link('common/profile','','SSL');
		
		$this->children = array(
			'common/header',
			'common/footer',
			'common/top',
			'common/sidebar'
		);
				
		$this->response->setOutput($this->render());
  	}

  	public function validate() {
  		if(!empty($this->request->post['action'])){
  			
  			switch (strtolower($this->request->post['action'])){
  				case 'check_oldpswd':
					$this->load->model('user/user');
  					$result = $this->model_user_user->getUserByPwd($this->request->post['old_password']);
  					if($result){
  						echo 'true';
  					}else{
  						echo 'false';
  					}					
					exit;
  					break;
  				case 'change_password':
  						$this->load->model('user/user');
  						
				    	if ($this->request->post['r_password'] != $this->request->post['new_password']) {
				      		$this->error['pwd_confirm'] = $this->language->get('error_confirm');
				    	}
				    	
				    	if (!$this->error) {
				    		$this->model_user_user->editPassword((int)$this->user->getId(),$this->request->post['new_password']);
				    		$this->session->data['success'] = $this->language->get('success_change');
				    	}
  					break;
  				case 'personal_info':
			    	if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
			      		$this->error['firstname'] = $this->language->get('error_firstname');
			    	}
			
			    	if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
			      		$this->error['lastname'] = $this->language->get('error_lastname');
			    	}
			
			    	if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
			      		$this->error['email'] = $this->language->get('error_email');
			    	}
			
			    	if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
			      		$this->error['warning'] = $this->language->get('error_exists');
			    	}
					
			    	if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
			      		$this->error['telephone'] = $this->language->get('error_telephone');
			    	}
		    	break;
  			}
  		}
		
    	if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
  	}
  	
  	public function change_password(){
  		if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
      		$this->error['firstname'] = $this->language->get('error_firstname');
    	}

    	if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
      		$this->error['lastname'] = $this->language->get('error_lastname');
    	}

    	if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
      		$this->error['email'] = $this->language->get('error_email');
    	}

    	if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
      		$this->error['warning'] = $this->language->get('error_exists');
    	}
		
    	if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
      		$this->error['telephone'] = $this->language->get('error_telephone');
    	}
  		
  	}
	
}
?>