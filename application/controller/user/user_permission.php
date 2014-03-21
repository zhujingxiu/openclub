<?php
class ControllerUserUserRole extends Controller {
	private $error = array();
 
	public function index() {
		$this->language->load('user/user_role');
 
		$this->document->setTitle($this->language->get('heading_title'));
 		
		$this->load->model('user/user_role');
		
		$this->getList();
	}

	public function insert() {
		$this->language->load('user/user_role');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('user/user_role');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm('user/user_permission/insert')) {
			$permission = array();
			if(isset($this->request->post['json_permission'])){
				$tmp_permission = json_decode(htmlspecialchars_decode($this->request->post['json_permission']),true);
				if($tmp_permission){
					foreach($tmp_permission as $p ){
						if(isset($p['key']) && isset($p['value'])){
							echo $p['key'],stripos($p['key'],'access');
							if(stripos($p['key'],'access')!==false){
								$permission['access'][] = $p['value'];
							}else if(stripos($p['key'],'modify')!==false){
								$permission['modify'][] = $p['value'];
							}else if(stripos($p['key'],'log')!==false){
								$permission['log'][] = $p['value'];
							}
						}
					}
				}
			}
			$name = isset($this->request->post['name']) ? $this->request->post['name'] : '';
			$this->model_user_user_role->addUserRole(array('name'=>$name,'permission'=>$permission));
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
			$this->redirect($this->url->link('user/user_permission',  $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		
		$this->language->load('user/user_role');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('user/user_role');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm('user/user_permission/update')) {
			$permission = array();
			if(isset($this->request->post['json_permission'])){
				$tmp_permission = json_decode(htmlspecialchars_decode($this->request->post['json_permission']),true);
				if($tmp_permission){
					foreach($tmp_permission as $p ){
						if(isset($p['key']) && isset($p['value'])){
							if(stripos($p['key'],'access')!==false){
								$permission['access'][] = $p['value'];
							}else if(stripos($p['key'],'modify')!==false){
								$permission['modify'][] = $p['value'];
							}else if(stripos($p['key'],'log')!==false){
								$permission['log'][] = $p['value'];
							}
						}
					}
				}
			}
			$name = isset($this->request->post['name']) ? $this->request->post['name'] : '';
			$this->model_user_user_role->editUserRole($this->request->get['user_role_id'], array('name'=>$name,'permission'=>$permission));
			
			$this->session->data['success'] = $this->language->get('text_success');
		
			
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
			$this->redirect($this->url->link('user/user_permission', $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() { 
		$this->language->load('user/user_role');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('user/user_role');
		
		if (isset($this->request->post['selected']) && $this->validateDelete('user/user_permission/delete')) {
      		foreach ($this->request->post['selected'] as $user_role_id) {
				$this->model_user_user_role->deleteUserRole($user_role_id);	
			}
						
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
			$this->redirect($this->url->link('user/user_permission', $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}
		 
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$url = '';
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}	
	
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
			
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', '', 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('user/user_permission', '', 'SSL'),
      		'separator' => ' :: '
   		);
							
		$this->data['insert'] = $this->url->link('user/user_permission/insert', '', 'SSL');
		$this->data['delete'] = $this->url->link('user/user_permission/delete', $url, 'SSL');	
	
		$this->data['user_roles'] = array();

		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$user_role_total = $this->model_user_user_role->getTotalUserRoles();
		
		$results = $this->model_user_user_role->getUserRoles($data);

		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('user/user_permission/update','' . '&user_role_id=' . $result['user_role_id'] . $url, 'SSL')
			);		
		
			$this->data['user_roles'][] = array(
				'user_role_id' => $result['user_role_id'],
				'name'          => $result['name'],
				'selected'      => isset($this->request->post['selected']) && in_array($result['user_role_id'], $this->request->post['selected']),
				'action'        => $action
			);
		}	
	
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['sort_name'] = $this->url->link('user/user_permission', 'sort=name' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
				
		$pagination = new Pagination();
		$pagination->total = $user_role_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('user/user_permission', $url . '&page={page}', 'SSL');
		
		$this->data['pagination'] = $pagination->render();				

		$this->data['sort'] = $sort; 
		$this->data['order'] = $order;

		$this->template = 'user/user_role_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
 	}

	protected function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_select_all'] = $this->language->get('text_select_all');
		$this->data['text_unselect_all'] = $this->language->get('text_unselect_all');
				
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_access'] = $this->language->get('entry_access');
		$this->data['entry_modify'] = $this->language->get('entry_modify');
		$this->data['entry_log'] = $this->language->get('entry_log');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
			
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', '', 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('user/user_permission', $url, 'SSL'),
      		'separator' => ' :: '
   		);
			
		if (!isset($this->request->get['user_role_id'])) {
			$this->data['action'] = $this->url->link('user/user_permission/insert', '', 'SSL');
		} else {
			$this->data['action'] = $this->url->link('user/user_permission/update', 'user_role_id=' . $this->request->get['user_role_id'] . $url, 'SSL');
		}
		  
    	$this->data['cancel'] = $this->url->link('user/user_permission', '', 'SSL');

		if (isset($this->request->get['user_role_id']) && $this->request->server['REQUEST_METHOD'] != 'POST') {
			$user_role_info = $this->model_user_user_role->getUserRole($this->request->get['user_role_id']);
		}
       
		if (isset($this->request->post['name'])) {
			$this->data['name'] = $this->request->post['name'];
		} elseif (!empty($user_role_info)) {
			$this->data['name'] = $user_role_info['name'];
		} else {
			$this->data['name'] = '';
		}
		
		$ignore = array(
			'common/home',
			'common/login',
			'common/logout',
			'common/forgotten',
			'common/reset',			
			'error/not_found',
			'error/permission',
			'common/footer',
			'common/header',
		);

		$this->data['permissions'] = array();
		
		$files = glob(DIR_APPLICATION . 'controller/*/*.php');

		foreach ($files as $file) {
			
			$data = explode('/', dirname($file));
			
			$permission = end($data) . '/' . basename($file, '.php');
			if (!in_array($permission, $ignore)) {
			// permission
			
				require_once $file;
				list($_module_name,$_class_name) = explode('/',$permission);
				$_className = 'Controller'.ucfirst($_module_name);
				if($_class_name){
					foreach(explode('_',$_class_name) as $_name){
						if(!empty($_name)){
							$_className .=ucfirst($_name);
						}
					}
				}
				$_class = new ReflectionClass(trim($_className));
				
				$_methods = $_class->getMethods(ReflectionMethod::IS_PUBLIC);
				if($_methods){
					foreach ($_methods as $_tmp){
						
						if($_tmp->class==$_className){
							$url = rtrim($permission,'/').'/'.$_tmp->name;
							$text = $this->model_user_user_role->getPermissionNode($url);
							$this->data['permissions'][] = array('value'=>$url,'text'=> $text);
						}
					}
				}
				
			// permission
			}
		}

		if (isset($this->request->post['permission']['access'])) {
			$this->data['access'] = $this->request->post['permission']['access'];
		} elseif (isset($user_role_info['permission']['access'])) {
			$this->data['access'] = $user_role_info['permission']['access'];
		} else { 
			$this->data['access'] = array();
		}

		if (isset($this->request->post['permission']['modify'])) {
			$this->data['modify'] = $this->request->post['permission']['modify'];
		} elseif (isset($user_role_info['permission']['modify'])) {
			$this->data['modify'] = $user_role_info['permission']['modify'];
		} else { 
			$this->data['modify'] = array();
		}
		
		if (isset($this->request->post['permission']['log'])) {
			$this->data['log'] = $this->request->post['permission']['log'];
		} elseif (isset($user_role_info['permission']['log'])) {
			$this->data['log'] = $user_role_info['permission']['log'];
		} else { 
			$this->data['log'] = array();
		}
	
		$this->template = 'user/user_role_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	protected function validateForm($route) {
		if (!$this->user->hasPermission('modify', $route)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDelete($route) {
		if (!$this->user->hasPermission('modify', $route)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		$this->load->model('user/user');
      	
		foreach ($this->request->post['selected'] as $user_role_id) {
			$user_total = $this->model_user_user->getTotalUsersByGroupId($user_role_id);

			if ($user_total) {
				$this->error['warning'] = sprintf($this->language->get('error_user'), $user_total);
			}
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	
	public function update_remark(){
		$url = isset($this->request->post['url']) ? $this->request->post['url'] : false;
		$remark = $this->request->post['remark'];
		if(!empty($url)){
			$query = $this->db->query("SELECT * FROM ".DB_PREFIX."permission_node WHERE url = '".$url."'");
			if($query->num_rows){
				$this->db->query("UPDATE ".DB_PREFIX."permission_node SET remark = '".$this->db->escape($remark)."' WHERE url = '".$this->db->escape($url)."'");
			}else{
				$this->db->query("INSERT INTO ".DB_PREFIX."permission_node SET remark = '".$this->db->escape($remark)."' , url = '".$this->db->escape($url)."'");
			}
			echo 1;
		}else{
			echo 0;
		}
		exit;
	}
}
?>