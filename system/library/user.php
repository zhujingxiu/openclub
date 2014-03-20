<?php
class User {
	private $user_id;
	private $username;
	private $firstname;
	private $lastname;
	private $user_role_id;
	private $user_role_name;
  	private $permission = array();

  	public function __construct($registry) {
		$this->db = $registry->get('db');
		$this->request = $registry->get('request');
		$this->session = $registry->get('session');
		
    	if (isset($this->session->data['user_id'])) {
			$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$this->session->data['user_id'] . "' AND status = '1'");
			
			if ($user_query->num_rows) {
				$this->user_id = $user_query->row['user_id'];
				$this->username = $user_query->row['username'];
				$this->firstname = $user_query->row['firstname'];
				$this->lastname = $user_query->row['lastname'];
				$this->user_role_id = $user_query->row['user_role_id'];
      			$this->db->query("UPDATE " . DB_PREFIX . "user SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE user_id = '" . (int)$this->session->data['user_id'] . "'");

      			$user_role_query = $this->db->query("SELECT name,permission FROM " . DB_PREFIX . "user_role WHERE user_role_id = '" . (int)$user_query->row['user_role_id'] . "'");
				$this->user_role_name = $user_role_query->row['name'];
	  			$permissions = unserialize($user_role_query->row['permission']);

				if (is_array($permissions)) {
	  				foreach ($permissions as $key => $value) {
	    				$this->permission[$key] = $value;
	  				}
				}
			} else {
				$this->logout();
			}
    	}
  	}
		
  	public function login($username, $password,$remeber=false) {
    	$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE username = '" . $this->db->escape($username) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1'");

    	if ($user_query->num_rows) {
			$this->session->data['user_id'] = $user_query->row['user_id'];
			
			$this->user_id = $user_query->row['user_id'];
			$this->username = $user_query->row['username'];			
			$this->firstname = $user_query->row['firstname'];
			$this->lastname = $user_query->row['lastname'];
			$this->user_role_id = $user_query->row['user_role_id'];
      		$user_role_query = $this->db->query("SELECT name,permission FROM " . DB_PREFIX . "user_role WHERE user_role_id = '" . (int)$user_query->row['user_role_id'] . "'");
			$this->user_role_name = $user_role_query->row['name'];
	  		$permissions = unserialize($user_role_query->row['permission']);

			if (is_array($permissions)) {
				foreach ($permissions as $key => $value) {
					$this->permission[$key] = $value;
				}
			}
			//$_REQUEST = array_merge(array('request_from_ip'=>$this->request->server['REMOTE_ADDR']),$_REQUEST);
			//$this->user_log(array('action'=>'login','url'=>'common/login','data'=>"<pre>" .$this->db->escape(var_export($_REQUEST,TRUE))."</pre>"));
			if($remeber){
				setcookie('remeber_username',$username,7*24*3600);	
			}
      		return true;
    	} else {
      		return false;
    	}
  	}

  	public function logout() {
  		//$_REQUEST = array_merge(array('request_from_ip'=>$this->request->server['REMOTE_ADDR']),$_REQUEST,array('user_agent'=>!empty($this->request->server['HTTP_USER_AGENT'])?lively_truncate($this->request->server['HTTP_USER_AGENT'],100):''));
  		//$this->user_log(array('action'=>'logout','url'=>'common/logout/index','data'=>"<pre>" .$this->db->escape(var_export($_REQUEST,TRUE))."</pre>"));
		unset($this->session->data['user_id']);
		setcookie("remeber_username", '', time()-3600);
		$this->user_id = '';
		$this->username = '';
		$this->firstname = $this->lastname = $this->user_role_id = $this->user_role_name = null;
		session_destroy();
  	}

  	public function hasPermission($key, $value,$log=true) {

  		if($this->getUserRoleId()==1){
  			
  			return true;
  		}else if (isset($this->permission[$key])) {
    		//$_REQUEST = array_merge(array('request_from_ip'=>$this->request->server['REMOTE_ADDR']),$_REQUEST);
    		if(in_array($value, $this->permission[$key]) ){
    			if($log===TRUE){
	    			if(isset($this->permission[$key]) && isset($this->permission['log'])  && in_array($value,$this->permission['log'])){
	    				//$this->user_log(array('action'=>$key,'url'=>$value,'data'=>"<pre>" .$this->db->escape(var_export($_REQUEST,TRUE))."</pre>"));
	    			}
    			}
    			return true;
    		}else if(in_array(rtrim($value,'/').'/index',$this->permission[$key])){
    			if($log===TRUE){
	    			if(isset($this->permission[$key]) && isset($this->permission['log'])  && in_array(rtrim($value,'/').'/index',$this->permission['log'])){
	    				//$this->user_log(array('action'=>$key,'url'=>$value,'data'=>"<pre>" .$this->db->escape(var_export($_REQUEST,TRUE))."</pre>"));
	    			}
    			}
    			return true;
    		}
    		return false;
    		
		}else {
	  		return false;
		}
  	}
  	
  	public function getMenu(){
  		$admin_memu = initAdminMenu();
		$ignore = initAdminIgnoreRoute();
  		if($admin_memu){
  			foreach ($admin_memu as $key => $item){
  				if(is_array($item)){
  					foreach ($item as $sk => $sval){
  						if(is_array($sval)){
  							foreach ($sval as $ssk => $ssval){
	  							$part = explode('/', $ssval);
								$route = '';
								if (isset($part[0])) {
									$route .= $part[0];
								}
								
								if (isset($part[1])) {
									$route .= '/' . $part[1];
								}
			  					if(!in_array($route,$ignore) && !$this->hasPermission('access',$ssval,false)){
			  						unset($admin_memu[$key][$sk][$ssk]);
			  					}
  							}
  						}else{
	  						$part = explode('/', $sval);
							$route = '';
							if (isset($part[0])) {
								$route .= $part[0];
							}
							
							if (isset($part[1])) {
								$route .= '/' . $part[1];
							}
		  					if(!in_array($route,$ignore) && !$this->hasPermission('access',$sval,false)){
		  						unset($admin_memu[$key][$sk]);
		  					}
  						}
  					}
  					
  				}
  				
  			}
  			if(count($admin_memu)){
  				foreach ($admin_memu as $key2 => $item2){
  					if(is_array($item2)){
  						foreach ($item2 as $sk2 => $sval2){
  							if(is_array($sval2) && !count($sval2)){
  								unset($admin_memu[$key2][$sk2]);
  							}
  						}
  					}
  				}
  			}
  		}
  		return $admin_memu;
  	}
  	
  	private function user_log($data){
  		
  		$this->db->query("INSERT INTO ".DB_PREFIX."user_log ( user_id,action ,url,data,log_time) VALUES ('".$this->session->data['user_id']."','{$data['action']}','{$data['url']}','{$data['data']}','".date('Y-m-d H:i:s')."')");
  	}
  
  	public function isLogged() {
    	return $this->user_id;
  	}
  
  	public function getId() {
    	return $this->user_id;
  	}
	
  	public function getUserName() {
    	return $this->username;
  	}	
	public function getFirstName() {
    	return $this->firstname;
  	}
	public function getLastName() {
    	return $this->lastname;
  	}
	public function getUserRoleId(){
  		return $this->user_role_id;
  	}
  	public function getUserRoleName(){
  		return $this->user_role_name;
  	}
}
?>