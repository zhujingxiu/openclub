<?php
class Session {
	public $data = array();
			
  	public function __construct() {		
		if (!session_id()) {
			ini_set('session.use_cookies', 'On');
			ini_set('session.use_trans_sid', 'Off');
			if(SESS_LONG_TIME){
				session_set_cookie_params(99999999, '/');
			}else{
				session_set_cookie_params(0, '/');
			}
			$session_name = session_name(); 
			if (isset($_POST[$session_name]) && $_POST[$session_name]) {			   
			    session_id($_POST[$session_name]);			   
			}
			session_start();
		}
			
		$this->data =& $_SESSION;
	}
	
	function getId() {
		return session_id();
	}
}
?>
