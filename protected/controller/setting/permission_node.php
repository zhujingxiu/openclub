<?php
class ControllerSettingPermissionNode extends Controller {
	private $error = array();
 
	public function index() {
		$this->language->load('setting/permission_node'); 

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->document->addStyle('asset/css/bootstrap-tree.css');
		
		$this->document->addStyle('asset/css/jquery-ui-1.10.1.custom.min.css');
		
		$this->document->addStyle('asset/css/bootstrap-modal.css');
		
		
		$this->document->addScript('asset/js/bootstrap-tree.js');
				
		$this->document->addScript('asset/js/bootstrap-modal.js');
		
		$this->document->addScript('asset/js/bootstrap-modalmanager.js');
		
		$this->load->model('setting/permission_node');
		
		$this->data['all_nodes'] = $this->model_setting_permission_node->getAllNodes();
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_items'] = $this->language->get('text_items');
		$this->data['text_product'] = $this->language->get('text_product');
		$this->data['text_tax'] = $this->language->get('text_tax');
		$this->data['text_account'] = $this->language->get('text_account');
		$this->data['text_checkout'] = $this->language->get('text_checkout');
		$this->data['text_stock'] = $this->language->get('text_stock');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
 		$this->data['text_browse'] = $this->language->get('text_browse');
		
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_owner'] = $this->language->get('entry_owner');
		$this->data['entry_address'] = $this->language->get('entry_address');
		$this->data['entry_email'] = $this->language->get('entry_email');

		$this->data['entry_error_filename'] = $this->language->get('entry_error_filename');
		$this->data['entry_faq'] = $this->language->get('entry_faq');

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
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', '', 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('setting/setting', '', 'SSL'),
      		'separator' => ' :: '
   		);
		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$this->data['action'] = $this->url->link('setting/setting', '', 'SSL');
		
		$this->data['cancel'] = $this->url->link('setting/store', '', 'SSL');

		if (isset($this->request->post['config_name'])) {
			$this->data['config_name'] = $this->request->post['config_name'];
		} else {
			$this->data['config_name'] = $this->config->get('config_name');
		}
		
		if (isset($this->request->post['config_owner'])) {
			$this->data['config_owner'] = $this->request->post['config_owner'];
		} else {
			$this->data['config_owner'] = $this->config->get('config_owner');
		}

		if (isset($this->request->post['config_address'])) {
			$this->data['config_address'] = $this->request->post['config_address'];
		} else {
			$this->data['config_address'] = $this->config->get('config_address');
		}		
						
		$this->template = 'setting/permission_node_tree.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
			'common/top',
			'common/sidebar'
		);
				
		$this->response->setOutput($this->render());
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'setting/setting')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
			
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}	
	
	public function render_form(){
		
		$this->load->model('setting/permission_node');
		
		$this->data['node_id'] = isset($this->request->get['node_id']) ? (int)$this->request->get['node_id'] : 0;
		$this->data['action'] = isset($this->request->get['action']) ? strtolower($this->request->get['action']) : 'add';
		
		$nodeInfo = $this->data['node_id'] ? $this->model_setting_permission_node->getNode($this->data['node_id']) : false;
		$this->data['parentNode'] = $parentNode = $nodeInfo ? $this->model_setting_permission_node->getNode($nodeInfo['parent_node_id']) : false;

		$this->data['name'] = !empty($nodeInfo) ? $nodeInfo['name'] : '';
		$this->data['type'] = !empty($nodeInfo) ? $nodeInfo['type'] : 'controller';
		$this->data['url'] = !empty($nodeInfo) ? $nodeInfo['url'] : '';
		$this->data['remark'] = !empty($nodeInfo) ? $nodeInfo['remark'] : '';
		$this->data['status'] = !empty($nodeInfo) ? $nodeInfo['status'] : 1;
		$this->data['ignore'] = !empty($nodeInfo) ? $nodeInfo['ignore'] : 0;
		$this->data['sort_order'] = !empty($nodeInfo) ? $nodeInfo['sort_order'] : 0;
		$this->data['parent_node_id'] = !empty($nodeInfo) ? $nodeInfo['parent_node_id'] : 0;
		$this->data['topNode'] =  $this->data['topNodes'] = $this->data['parentNodes'] = '';
		
		$data = array();
		switch ($this->data['action']){
			case 'add':
				$data['title'] = "Add ".ucfirst($this->_getNodeLevel($nodeInfo['type']))." Node"; 
				$data['node_name'] = ucfirst($this->_getNodeLevel($nodeInfo['type']));
				if($this->data['type']=='model'){
					$this->data['parentNodes'] = $this->model_setting_permission_node->getParentNodes($parentNode['parent_node_id']);
					$this->data['topNode'] = $this->model_setting_permission_node->getNode($parentNode['parent_node_id']);
					if($this->data['topNode']){
						$this->data['topNodes'] = $this->model_setting_permission_node->getParentNodes($this->data['topNode']['parent_node_id']);
					}
				}		
				break;
			case 'edit':
				$data['title'] = "Edit ".ucfirst($nodeInfo['type']).":".$nodeInfo['name']." Node";
				$data['node_name'] = ucfirst($nodeInfo['type']);	
				break;
			case 'remove':
				$data['title'] = "Remove ".ucfirst($nodeInfo['type']).":".$nodeInfo['name']." Node";
				$data['node_name'] = ucfirst($nodeInfo['type']);
				break;
		}
		$this->data['node_name'] = $data['node_name']." Name ";
		$this->data['title'] = $data['title'];
		$this->template = 'setting/permission_node_form.tpl';
		$this->response->setOutput($this->render());
	}
	
	public function save_node(){
		$action = isset($this->request->post['action']) ? strtolower(trim($this->request->post['action'])) : 'add';
		$parent_node_id = isset($this->request->post['parent_node_id']) ? (int)$this->request->post['parent_node_id'] : 0;
		$node_id = isset($this->request->post['_node_id']) ? (int)$this->request->post['_node_id'] : 0;
		$type = isset($this->request->post['type']) ? trim($this->request->post['type']) : 'action';
		$node_name = isset($this->request->post['node_name']) ? trim($this->request->post['node_name']) : false;
		$url = isset($this->request->post['url']) ? trim($this->request->post['url']) : '';
		$remark = isset($this->request->post['remark']) ? trim($this->request->post['remark']) : '';
		$status = isset($this->request->post['status']) ? trim($this->request->post['status']) : '';
		$ignore = isset($this->request->post['ignore']) ? trim($this->request->post['ignore']) : '';
		$sort_order = isset($this->request->post['sort_order']) ? trim($this->request->post['sort_order']) : '';
		$this->load->model('setting/permission_node');
		$json = array();
		
		if(!empty($node_name)){
			if($this->model_setting_permission_node->getNodeByName($node_name,$type)){
				$json['error']['node_name'] = 'The node name has already exists!';
			}			
		}else{
			$json['error']['node_name'] = 'The node name is required!';
		}
		
		if(!empty($url)){
			if($this->model_setting_permission_node->getNodeByUrl($url,$type)){
				$json['error']['url'] = 'The node url has already exists!';
			}
		}
		$data = array(
			'type'			=> $type,
			'name' 			=> $node_name,
			'parent_node_id'=> $parent_node_id,
			'url'			=> $url,
			'remark'		=> $remark,
			'status'		=> $status,
			'ignore'		=> $ignore,
			'sort_order'	=> $sort_order
		);
		if(!isset($json['error'])){
			switch ($action){
				case 'add':		
					$data['type'] = $this->_getNodeLevel($type);		
					if($this->model_setting_permission_node->addNode($data)){
						$json['success'] = 'Success : Add Node:<b>'.$node_name.'</b> success!';
					}
					break;
				case 'edit':					
					if($this->model_setting_permission_node->editNode($node_id,$data)){
						$json['success'] = 'Success : Edit Node:<b>'.$node_name.'</b> success!';
					}
					break;
				case 'remove':					
					if($this->model_setting_permission_node->deleteNode($node_id)){
						$json['success'] = 'Success : Remove Node:<b>'.$node_name.'</b> success!';
					}
					break;
			}
		}
		echo json_encode($json);
		exit;
	}
	

	
	private function  _getNodeLevel($type,$direction_down = true){
		
		switch (strtolower($type)){
			case 'controller':
				return $direction_down ? 'model' : '' ;
				break;
			case 'model':
				return $direction_down ? 'action' : 'controller';
				break;
			case 'action':
				return $direction_down ? '' : 'model';
				break;
			default: 
				return 'controller';
		}
	}

}
?>