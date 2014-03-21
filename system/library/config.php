<?php
class Config {
	private $data = array();

  	public function get($key) {
    	return (isset($this->data[$key]) ? $this->data[$key] : null);
  	}	
	
	public function set($key, $value) {
    	$this->data[$key] = $value;
  	}

	public function has($key) {
    	return isset($this->data[$key]);
  	}

  	public function load($filename,$define=False) {
		$file = DIR_CONFIG . $filename . '.php';
		
    	if (file_exists($file)) { 
	  		$_ = array();
	  
	  		require($file);
	  		
    			if($define){
	  			foreach ($_ as $name => $value){
	  				if( is_string($value)){
	  					defined(strtoupper(trim($name)))  || define(strtoupper(trim($name)),  $value );
	  				}
	  			}
	  		}else{
	  			$this->data = array_merge($this->data, $_);
	  		}
	  		
		} else {
			echo $file;
			trigger_error('Error: Could not load config ' . $filename . '!');
			exit();
		}
  	}
}
?>
