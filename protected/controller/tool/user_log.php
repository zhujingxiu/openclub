<?php
class ControllerToolsUserLog extends Controller {
	private $error = array();
 
	public function index() {
		$this->language->load('tools/user_log');
 
		$this->document->setTitle($this->language->get('heading_title'));
 		
		$this->load->model('user/log');
		
		$this->getList();
	}
	
	public function view() {
		
		$this->language->load('tools/user_log');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('user/log');

		$this->getForm();
	}

	public function delete() { 
		$this->language->load('tools/user_log');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('user/log');
		
		if (isset($this->request->post['selected']) && $this->validateDelete('tools/user_log/delete')) {
      		foreach ($this->request->post['selected'] as $user_log_id) {
				$this->model_user_log->deleteLog($user_log_id);	
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
						
			$this->redirect($this->url->link('tools/user_log', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
				
		if (isset($this->request->get['filter_user_id'])) {
			$filter_user_id = $this->request->get['filter_user_id'];
		} else {
			if(!in_array($this->user->getUserGroupId(), array(1,2,3))){
				$filter_user_id = $this->user->getId();
			}else{
				$filter_user_id = null;
			}
		}

		if (isset($this->request->get['filter_action'])) {
			$filter_action = $this->request->get['filter_action'];
		} else {
			$filter_action = null;
		}
		
		if (isset($this->request->get['filter_url'])) {
			$filter_url = $this->request->get['filter_url'];
		} else {
			$filter_url = null;
		}
		
		if (isset($this->request->get['filter_log_time_start'])) {
			$filter_log_time_start = $this->request->get['filter_log_time_start'];
		} else {
			$filter_log_time_start = null;
		}
				
		if (isset($this->request->get['filter_log_time_end'])) {
			$filter_log_time_end = $this->request->get['filter_log_time_end'];
		} else {
			$filter_log_time_end = null;
		}
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'log_time';
		}
		 
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$url = '';
		
		if (isset($this->request->get['filter_user_id'])) {
			$url .= '&filter_user_id=' . $this->request->get['filter_user_id'];
		}
			
		if (isset($this->request->get['filter_action'])) {
			$url .= '&filter_action=' . $this->request->get['filter_action'];
		}
		
		if (isset($this->request->get['filter_url'])) {
			$url .= '&filter_url=' . $this->request->get['filter_url'];
		}	
					
		if (isset($this->request->get['filter_log_time_start'])) {
			$url .= '&filter_log_time_start=' . $this->request->get['filter_log_time_start'];
		}
		if (isset($this->request->get['filter_log_time_end'])) {
			$url .= '&filter_log_time_start=' . $this->request->get['filter_log_time_end'];
		}
		
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
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('tools/user_log', 'token=' . $this->session->data['token'] , 'SSL'),
      		'separator' => ' :: '
   		);
				
		$this->data['delete'] = $this->url->link('tools/user_log/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['users'] = $this->model_user_log->getUsers();
		$this->data['user_logs'] = array();

		$data = array(
			'filter_user_id' => $filter_user_id,
			'filter_action'  => $filter_action,
			'filter_url'	 => $filter_url,
			'filter_log_time_start' => $filter_log_time_start,
			'filter_log_time_end'	=> $filter_log_time_end,	
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$user_log_total = $this->model_user_log->getTotalLogs($data);
		
		$results = $this->model_user_log->getLogs($data);

		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_view'),
				'href' => $this->url->link('tools/user_log/view', 'token=' . $this->session->data['token'] . '&user_log_id=' . $result['user_log_id'] . $url, 'SSL')
			);		
		
			$this->data['user_logs'][] = array(
				'user_log_id' => $result['user_log_id'],
				'username'    => $result['username'],
				'logaction'      => $result['action'],
				'url'         => $result['url'],
				'data'        => $result['data'],
				'log_time'    => $result['log_time'],
				'selected'      => isset($this->request->post['selected']) && in_array($result['user_log_id'], $this->request->post['selected']),
				'action'      => $action
			);
		}	
	
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_user_name'] = $this->language->get('column_user_name');
		$this->data['column_log_action'] = $this->language->get('column_log_action');
		$this->data['column_log_url'] = $this->language->get('column_log_url');
		$this->data['column_log_time'] = $this->language->get('column_log_time');
		$this->data['column_log_data'] = $this->language->get('column_data');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['button_filter'] = $this->language->get('button_filter');
		$this->data['button_delete'] = $this->language->get('button_delete');
 		$this->data['button_truncate'] = $this->language->get('button_truncate');
 		
 		$this->data['text_all_users'] = $this->language->get('text_all_users');
 		$this->load->model('user/user');			
		$this->data['all_users'] = $this->model_user_user->getUsers();
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
		
		if (isset($this->request->get['filter_user_id'])) {
			$url .= '&filter_user_id=' . $this->request->get['filter_user_id'];
		}
			
		if (isset($this->request->get['filter_action'])) {
			$url .= '&filter_action=' . $this->request->get['filter_action'];
		}
		
		if (isset($this->request->get['filter_url'])) {
			$url .= '&filter_url=' . $this->request->get['filter_url'];
		}	
					
		if (isset($this->request->get['filter_log_time_start'])) {
			$url .= '&filter_log_time_start=' . $this->request->get['filter_log_time_start'];
		}
		if (isset($this->request->get['filter_log_time_end'])) {
			$url .= '&filter_log_time_start=' . $this->request->get['filter_log_time_end'];
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}	
	
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		$this->data['token'] = $this->session->data['token'];
		$this->data['sort_username'] = $this->url->link('tools/user_log', 'token=' . $this->session->data['token'] . '&sort=username' . $url, 'SSL');
		$this->data['sort_action'] = $this->url->link('tools/user_log', 'token=' . $this->session->data['token'] . '&sort=action' . $url, 'SSL');
		$this->data['sort_url'] = $this->url->link('tools/user_log', 'token=' . $this->session->data['token'] . '&sort=url' . $url, 'SSL');
		$this->data['sort_log_time'] = $this->url->link('tools/user_log', 'token=' . $this->session->data['token'] . '&sort=log_time' . $url, 'SSL');
		
			
		$url = '';
		
		if (isset($this->request->get['filter_user_id'])) {
			$url .= '&filter_user_id=' . $this->request->get['filter_user_id'];
		}
			
		if (isset($this->request->get['filter_action'])) {
			$url .= '&filter_action=' . $this->request->get['filter_action'];
		}
		
		if (isset($this->request->get['filter_url'])) {
			$url .= '&filter_url=' . $this->request->get['filter_url'];
		}	
					
		if (isset($this->request->get['filter_log_time_start'])) {
			$url .= '&filter_log_time_start=' . $this->request->get['filter_log_time_start'];
		}
		if (isset($this->request->get['filter_log_time_end'])) {
			$url .= '&filter_log_time_start=' . $this->request->get['filter_log_time_end'];
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}	
				
		$pagination = new Pagination();
		$pagination->total = $user_log_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('tools/user_log', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
		
		$this->data['pagination'] = $pagination->render();				

		$this->data['filter_user_id'] = $filter_user_id;
		$this->data['filter_action'] = $filter_action;
		$this->data['filter_url'] = $filter_url;
		$this->data['filter_log_time_start'] = $filter_log_time_start;
		$this->data['filter_log_time_end'] = $filter_log_time_end;
		
		$this->data['sort'] = $sort; 
		$this->data['order'] = $order;

		$this->template = 'tools/user_log_list.tpl';
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
				
		$this->data['entry_user'] = $this->language->get('entry_user');
		$this->data['entry_action'] = $this->language->get('entry_action');
		$this->data['entry_url'] = $this->language->get('entry_url');
		$this->data['entry_data'] = $this->language->get('entry_data');
		$this->data['entry_log_time'] = $this->language->get('entry_log_time');
		
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
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('tools/user_log', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
			
		  
    	$this->data['cancel'] = $this->url->link('tools/user_log', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['user_log_id']) && $this->request->server['REQUEST_METHOD'] != 'POST') {
			$user_log_info = $this->model_user_log->getLog($this->request->get['user_log_id']);
			$last_log_info = $this->model_user_log->getLastLogInfo($user_log_info);
		}

		if (!empty($user_log_info)) {
			$this->data['username'] = $user_log_info['username'];
		} else {
			$this->data['username'] = '';
		}

		if (isset($user_log_info['url'])) {
			$this->data['url'] = $user_log_info['url'];
		} else { 
			$this->data['url'] = '';
		}

		if (isset($user_log_info['action'])) {
			$this->data['action'] = $user_log_info['action'];
		} else { 
			$this->data['action'] = '';
		}
		if (isset($user_log_info['data'])) {
			$this->data['data'] = $user_log_info['data'];
		} else { 
			$this->data['data'] = '';
		}
		
		if (isset($user_log_info['log_time'])) {
			$this->data['log_time'] = $user_log_info['log_time'];
		} else { 
			$this->data['log_time'] = '';
		}
		
		if (!empty($last_log_info['username'])) {
			$this->data['last_username'] = $last_log_info['username'];
		} else {
			$this->data['last_username'] = '';
		}

		if (!empty($last_log_info['action'])) {
			$this->data['last_action'] = $last_log_info['action'];
		} else {
			$this->data['last_action'] = '';
		}
		
		if (!empty($last_log_info['url'])) {
			$this->data['last_url'] = $last_log_info['url'];
		} else {
			$this->data['last_url'] = '';
		}
		
		if (!empty($last_log_info['data'])) {
			$this->data['last_data'] = $last_log_info['data'];
		} else {
			$this->data['last_data'] = '';
		}
		
		if (!empty($last_log_info['log_time'])) {
			$this->data['last_log_time'] = $last_log_info['log_time'];
		} else {
			$this->data['last_log_time'] = '';
		}
	
		$this->template = 'tools/user_log_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	protected function validateDelete($route) {
		
		if (!$this->user->hasPermission('modify', $route)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	
	public function truncate(){
		$this->language->load('tools/user_log');
		$json = array();
		if (!$this->user->hasPermission('modify', 'tools/user_log/truncate')) {
			$json['warning'] = $this->language->get('error_permission');
		}
		if(!$json){
			$this->load->model('user/log');
			$this->model_user_log->truncate();
			$json['success'] = $this->language->get('text_success');
		}
		echo json_encode($json);
		exit;
	}
	
	public function export_logs(){
		$operator = !empty($this->request->post['operator']) ? (int)$this->request->post['operator'] : 0;
		$start_date = !empty($this->request->post['date_start']) ? date('Y-m-d H:i',strtotime($this->request->post['date_start'])) : '';
		$end_date = !empty($this->request->post['date_end']) ? date('Y-m-d H:i',strtotime($this->request->post['date_end'])) : '';
		$filter['start'] = 0;
		$filter['filter_all'] = true;
		if($operator){
			$filter['filter_user_id'] = $operator;
		}
		if(!empty($start_date)){
			$filter['filter_log_time_start'] = $start_date;
		}
		if(!empty($end_date)){
			$filter['filter_log_time_end'] = $end_date;
		}
		$basePath=rtrim($_SERVER['DOCUMENT_ROOT'],"/").'/download';
		if(!file_exists($basePath)){
			@mkdir($basePath);
		}
		
		$this->load->model('user/log');
		$total_logs = $this->model_user_log->getTotalLogs($filter);
		if($total_logs){
			$logs = $this->model_user_log->getLogs($filter);
			$items = array();
			$offset = 2;
			foreach ($logs as $k => $log){
				if(is_array($log)){
					$items[] = array("A".$offset=>$log['user_log_id'],"B".$offset=>$log['lastname'].$log['firstname'].'['.$log['username'].']',"C".$offset=>$log['action'],"D".$offset=>$log['url'],"E".$offset=>$log['data'],"F".$offset=>$log['log_time']);
				}
				$offset++;
			}
			$first_line = array('A1'=>'Log ID','B1'=>'Operator','C1'=>'Action','D1'=>'URL','E1'=>'Data','F1'=>'Log Time' );
		
			$customer = $this->user->getFirstName()." ".$this->user->getLastName();
			$data = array('first_line'=>$first_line,'items'=>$items,'setting'=>array('creator'=>$customer,'lastModified'=>$customer,'title'=>'User Logs','subject'=>'User Logs'));
			$fileName=date('YmdHis').'-User-Logs-'.count($items).'.xls';
			$targetFile = rtrim($basePath,'/') . '/'. $fileName;
			if(writeExcel($targetFile,$data)){
				$status = 1;
				$downloadUrl= 'index.php?route=common/download&token='.$this->session->data['token'].'&file=/download/'.$fileName."&downloadName=user_logs.xls";
				$msg = '<dl style="margin-top:0px;margin-bottom:0px;"><dd><span>Totals:'.count($items).'</span> <a href="'.$downloadUrl.'" style="text-align:right;color:#0066CC;text-decoration:underline;">download</a><dd></dl>';
			}else{
				$status = 0;
				$msg = "Error!";
			}
			echo json_encode(array('status'=>$status,'msg'=>$msg));
			exit;
		}
	
	}
}
