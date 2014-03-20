<?php


	function rechargeAmount($value){
		
		if(is_numeric($value)){
			$value = (int)$value;
			if($value>0 && $value<=10000){
				return true;
			}
		}
		return false;
	}
	function isFacebookURL($url){
		if(isURL($url)){
			if(stripos($url, 'facebook.com')){
				return true;
			}
		}
		return false;
	}
	/**
	 * *
	 * @param string $value
	 * @param string $match
	 * @return boolean
	 */
	function isURL($url,$match='/^(http:\/\/)?(https:\/\/)?([\w\d-]+\.)+[\w-]+(\/[\d\w-.\/?%&=]*)?$/i'){
		if(empty($url)){
			return false;
		}
		$url = strtolower(trim($url));
		return preg_match($match, $url);
		return false;
		
	}


	/**
	 * @param string $value
	 * @param int $length
	 * @return boolean
	 */
	function isEmail($value,$match='/^[\w\d]+[\w\d-.]*@[\w\d-.]+\.[\w\d]{2,10}$/i'){
		$v = trim($value);
		if(empty($v)) 
			return false;

		return preg_match($match,$v);

	}
	
	/**
	 * @param string $value
	 * @return boolean
	 */
	function isTelephone($value,$match='/^0[0-9]{2,3}[-]?\d{7,8}$/'){
		$v = trim($value);
		if(empty($v)) 
			return false;
		return preg_match($match,$v);
	}
	
	/**
	 * @param string $value
	 * @param string $match
	 * @return boolean
	 */
	function isMobile($value,$match='/^[(86)|0]?(13\d{9})|(15\d{9})|(18\d{9})$/'){
		$v = trim($value);
		if(empty($v)) 
			return false;
		return preg_match($match,$v);
	}
	/**
	 * @param string $value
	 * @param string $match
	 * @return boolean
	 */
	function isPostcode($value,$match='/\d{6}/'){
		$v = trim($value);
		if(empty($v)) 
			return false;
		return preg_match($match,$v);
	}
	/**
	 * @param string $value
	 * @param string $match
	 * @return boolean
	 */
	function isIP($value,$match='/^(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])$/'){
		$v = trim($value);
		if(empty($v))
			return false;
		return preg_match($match,$v);
	}
	