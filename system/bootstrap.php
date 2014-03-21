<?php
class Bootstrap {

	public $registry,$loader,$config,$db;
	public $url,$log,$request,$response,$cache,$session,$language;
	public $controller,$action;
	public function __construct(){
		foreach (get_class_methods(__CLASS__) as $function_name){
			if(substr($function_name, 0,5) == "_init"){
				call_user_func("SELF::".$function_name);
			}
		}
	}
	// init Config
	public function _initConfig(){
		require_once('config.php'); 
	}
	
	// init Environment
	public function _initEnvironment(){
		// Registry
		require_once(DIR_SYSTEM . 'engine/registry.php');
		$this->registry = new Registry();
		
		// AutoLoader
		require_once(DIR_SYSTEM . 'engine/loader.php');
		$this->loader = new Loader($this->registry);
		$this->registry->set('load', $this->loader);
		
		// Config
		require_once(DIR_SYSTEM . 'library/config.php');
		$this->config = new Config();
		$this->config->load(APP_ENV,true);
		$this->registry->set('config', $this->config);
		
		// Database
		require_once(DIR_SYSTEM . 'library/db.php');
		$this->db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		$this->registry->set('db', $this->db);
		
		// Settings
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting");
		 
		foreach ($query->rows as $setting) {
			if (!$setting['serialized']) {
				$this->config->set($setting['key'], $setting['value']);
			} else {
				$this->config->set($setting['key'], unserialize($setting['value']));
			}
		}
	}
	
	public function _initLog(){
		// Log 
		require_once(DIR_SYSTEM . 'library/log.php');
		$this->log = new Log($this->config->get('config_error_filename'));
		$this->registry->set('log', $this->log);
		
		function error_handler($errno, $errstr, $errfile, $errline) {
			
			switch ($errno) {
				case E_NOTICE:
				case E_USER_NOTICE:
					$error = 'Notice';
					break;
				case E_WARNING:
				case E_USER_WARNING:
					$error = 'Warning';
					break;
				case E_ERROR:
				case E_USER_ERROR:
					$error = 'Fatal Error';
					break;
				default:
					$error = 'Unknown';
					break;
			}
				
			if ($this->config->get('config_error_display')) {
				echo '<b>' . $error . '</b>: ' . $errstr . ' in <b>' . $errfile . '</b> on line <b>' . $errline . '</b>';
			}
			
			if ($this->config->get('config_error_log')) {
				$this->log->write('PHP ' . $error . ':  ' . $errstr . ' in ' . $errfile . ' on line ' . $errline);
			}
		
			return true;
		}
		
		// Error Handler
		set_error_handler('error_handler');
	}
	
	public function _initComponent(){
		
		// Url
		require_once(DIR_SYSTEM . 'library/url.php');
		$this->url = new Url(HTTP_SERVER, HTTP_SERVER);	
		$this->registry->set('url', $this->url);
		
		// Request
		require_once(DIR_SYSTEM . 'library/request.php');
		$this->request = new Request();
		$this->registry->set('request', $this->request);
		
		// Response
		require_once(DIR_SYSTEM . 'library/response.php');
		$this->response = new Response();
		$this->response->addHeader('Content-Type: text/html; charset=utf-8');
		$this->registry->set('response', $this->response); 
		
		// Cache
		require_once(DIR_SYSTEM . 'library/cache.php');
		$this->cache = new Cache();
		$this->registry->set('cache', $this->cache); 
		
		// Session
		require_once(DIR_SYSTEM . 'library/session.php');
		$this->session = new Session();
		$this->registry->set('session', $this->session); 

		// Document
		require_once(DIR_SYSTEM . 'library/document.php');
		$this->registry->set('document', new Document()); 
	}

	// init Language
	public function _initLanguage(){
		
		$languages = array();
		
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "language` WHERE status = '1'"); 
		
		foreach ($query->rows as $result) {
			$languages[$result['code']] = $result;
		}
		
		$detect = "";
		
		if (isset($this->request->server['HTTP_ACCEPT_LANGUAGE']) && $this->request->server['HTTP_ACCEPT_LANGUAGE']) { 
			$browser_languages = explode(',', $this->request->server['HTTP_ACCEPT_LANGUAGE']);
			foreach ($browser_languages as $browser_language) {				
				foreach ($languages as $key => $value) {
					if ($value['status']) {
						$locale = explode(',', $value['locale']);
						if (in_array($browser_language, $locale)) {							
							$detect = $key;							
						}
					}
				}
			}
		}
		
		if (isset($this->session->data['language']) && array_key_exists($this->session->data['language'], $languages) && $languages[$this->session->data['language']]['status']) {
			$code = $this->session->data['language'];
		} elseif (isset($this->request->cookie['language']) && array_key_exists($this->request->cookie['language'], $languages) && $languages[$this->request->cookie['language']]['status']) {
			$code = $this->request->cookie['language'];
		} else if ($detect) {
			$code = $detect;
		} else {
			$code = $this->config->get('config_language');
		}

		if (!isset($this->session->data['language']) || $this->session->data['language'] != $code) {
			$this->session->data['language'] = $code;
		}
		
		if (!isset($this->request->cookie['language']) || $this->request->cookie['language'] != $code) {	  
			setcookie('language', $code, time() + 60 * 60 * 24 * 30, '/', $this->request->server['HTTP_HOST']);
		}			
		
		$this->config->set('config_language_id', $languages[$code]['language_id']);
		$this->config->set('config_language', $languages[$code]['code']);

		require_once(DIR_SYSTEM . 'library/language.php');
		$this->language = new Language($languages[$this->config->get('config_language')]['directory']);
		$this->language->load($languages[$this->config->get('config_language')]['filename']);	
		$this->registry->set('language', $this->language);
	}
	
	// Helper
	public function _initHelper(){
		
		require_once(DIR_SYSTEM . 'helper/json.php'); 
		require_once(DIR_SYSTEM . 'helper/utf8.php'); 
		require_once(DIR_SYSTEM . 'helper/common.php');
	}
	
	// Common Library
	public function _initLibrary(){
		require_once(DIR_SYSTEM . 'plugin/encryption.php');
		require_once(DIR_SYSTEM . 'library/image.php');
		require_once(DIR_SYSTEM . 'library/mail.php');
		require_once(DIR_SYSTEM . 'library/pagination.php');
		require_once(DIR_SYSTEM . 'library/template.php');
	}
	
	public function run(){
		//Engine
		require_once(DIR_SYSTEM . 'engine/action.php'); 
		require_once(DIR_SYSTEM . 'engine/controller.php');
		require_once(DIR_SYSTEM . 'engine/front.php');
		require_once(DIR_SYSTEM . 'engine/model.php');
		
		// Front Controller
		$this->controller = new Front($this->registry);
		
		// Login
		$this->controller->addPreAction(new Action('common/home/login'));
		
		// Permission
		$this->controller->addPreAction(new Action('common/home/permission'));
		
		// Router
		if (isset($this->request->get['route'])) {
			$this->action = new Action($this->request->get['route']);
		} else {
			$this->action = new Action('common/home');
		}
		
		// Dispatch
		$this->controller->dispatch($this->action, new Action('error/not_found'));
		
		// Output
		$this->response->output();
	}
}
?>
