<?php
class Cart {
	private $config;
	private $db;
	private $data = array();

  	public function __construct($registry) {
		$this->config = $registry->get('config');
		$this->customer = $registry->get('customer');
		$this->session = $registry->get('session');
		$this->db = $registry->get('db');
		
		if (!isset($this->session->data['cart']) || !is_array($this->session->data['cart'])) {
      		$this->session->data['cart'] = array();
    	}
	}
	      
  	public function getProducts($express_checkout=false) {
  		
		if (!$express_checkout && $this->data) {
			return $this->data;
		}else{
			$products = array();
			if($express_checkout ){
				if(!empty($this->session->data['ex_cart'])){
					$cart_info = $this->session->data['ex_cart'];
				}else{
					return array();
				}
			}else{
				$cart_info = $this->session->data['cart'];
			}
			foreach ($cart_info as $key => $quantity) {
				$discount_item = $option_discount_item = '';
				$log_subtotal = $log_option_subtotal = '';
				$product = explode(':', $key);
				$product_id = $product[0];
				//$stock = true;
	
				// Options
				if (!empty($product[1])) {
					$options = unserialize(base64_decode($product[1]));
				} else {
					$options = array();
				}           
				
				$product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.date_available <= NOW() AND p.status = '1'");
				
				if ($product_query->num_rows) {
					$option_price = 0.00;
					
					$option_data = array();
					foreach ($options as $product_option_id => $option_value) {
						$option_query = $this->db->query("SELECT po.product_option_id, po.option_id, od.name, o.type FROM " . DB_PREFIX . "product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_option_id = '" . (int)$product_option_id . "' AND po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");
						
						if ($option_query->num_rows) {
							
							if ($option_query->row['type'] == 'select' || $option_query->row['type'] == 'radio' || $option_query->row['type'] == 'image') {
								$option_value_query = $this->db->query("SELECT pov.option_value_id,pov.subscribed_period, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_option_value_id = '" . (int)$option_value . "' AND pov.product_option_id = '" . (int)$product_option_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
								
								if ($option_value_query->num_rows) {

									$tmp_price = $this->customer->getProductOptionDiscount($option_value,$option_value_query->row['price'],$quantity);								
									if($tmp_price != $option_value_query->row['price']){
										$log_option_subtotal = (float)(((float)$option_value_query->row['price']-(float)$tmp_price)*$quantity);
										$option_discount_item .='<div>Option Price:<b>'.$option_value_query->row['price'].'*'.$quantity.' - '.$tmp_price.'*'.$quantity.' = '.$log_option_subtotal.'</b></div>';
									}
									
									if ($option_value_query->row['price_prefix'] == '+') {											
										$option_price += (float)$tmp_price;
									} elseif ($option_value_query->row['price_prefix'] == '-') {											
										$option_price -= (float)$tmp_price;
									}
																		
									//if ($option_value_query->row['subtract'] && (!$option_value_query->row['quantity'] || ($option_value_query->row['quantity'] < $quantity))) {
										//$stock = false;
									//}
									
									$option_data[] = array(
										'product_option_id'       => $product_option_id,
										'product_option_value_id' => $option_value,
										'option_id'               => $option_query->row['option_id'],
										'option_value_id'         => $option_value_query->row['option_value_id'],
										'name'                    => $option_query->row['name'],
										'option_value'            => $option_value_query->row['name'],
										'type'                    => $option_query->row['type'],
										'quantity'                => $option_value_query->row['quantity'],
										'subtract'                => $option_value_query->row['subtract'],
										'price'                   => $option_value_query->row['price'],
										'price_prefix'            => $option_value_query->row['price_prefix'],
										'subscribed_period'		  => $option_value_query->row['subscribed_period'],
									);								
								}
							} elseif ($option_query->row['type'] == 'checkbox' && is_array($option_value)) {
								foreach ($option_value as $product_option_value_id) {
									$option_value_query = $this->db->query("SELECT pov.option_value_id,pov.subscribed_period,ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_option_value_id = '" . (int)$product_option_value_id . "' AND pov.product_option_id = '" . (int)$product_option_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
									
									if ($option_value_query->num_rows) {

										$tmp_price = $this->customer->getProductOptionDiscount($option_value,$option_value_query->row['price'],$quantity);	
										if($tmp_price != $option_value_query->row['price']){
											$log_option_subtotal = (float)(((float)$option_value_query->row['price']-(float)$tmp_price)*$quantity);
											$option_discount_item .='<div>Option Price:<b>'.$option_value_query->row['price'].'*'.$quantity.' - '.$tmp_price.'*'.$quantity.' = '.$log_option_subtotal.'</b></div>';
										}										
										if ($option_value_query->row['price_prefix'] == '+') {
											$option_price += (float)$tmp_price;
										} elseif ($option_value_query->row['price_prefix'] == '-') {
											$option_price -= (float)$tmp_price;
										}
										
										//if ($option_value_query->row['subtract'] && (!$option_value_query->row['quantity'] || ($option_value_query->row['quantity'] < $quantity))) {
											//$stock = false;
										//}
										
										$option_data[] = array(
											'product_option_id'       => $product_option_id,
											'product_option_value_id' => $product_option_value_id,
											'option_id'               => $option_query->row['option_id'],
											'option_value_id'         => $option_value_query->row['option_value_id'],
											'name'                    => $option_query->row['name'],
											'option_value'            => $option_value_query->row['name'],
											'type'                    => $option_query->row['type'],
											'quantity'                => $option_value_query->row['quantity'],
											'subtract'                => $option_value_query->row['subtract'],
											'price'                   => $option_value_query->row['price'],
											'price_prefix'            => $option_value_query->row['price_prefix'],
											'subscribed_period'		 => $option_value_query->row['subscribed_period'],
										);								
									}
								}						
							} elseif ($option_query->row['type'] == 'text' || $option_query->row['type'] == 'textarea' || $option_query->row['type'] == 'file' || $option_query->row['type'] == 'date' || $option_query->row['type'] == 'datetime' || $option_query->row['type'] == 'time') {
								
								$option_data[] = array(
									'product_option_id'       => $product_option_id,
									'product_option_value_id' => '',
									'option_id'               => $option_query->row['option_id'],
									'option_value_id'         => '',
									'name'                    => $option_query->row['name'],
									'option_value'            => $option_value,
									'type'                    => $option_query->row['type'],
									'quantity'                => '',
									'subtract'                => '',
									'price'                   => '',
									'price_prefix'            => '',
									'subscribed_period'		 => 0,
								);						
							}
						}
					} 
				
					if ($this->customer->isLogged()) {
						$customer_group_id = $this->customer->getCustomerGroupId();
					} else {
						$customer_group_id = $this->config->get('config_customer_group_id');
					}
					
					$price = $product_query->row['price'];
					
					// Product Discounts
					$discount_quantity = 0;
					foreach ($cart_info as $key_2 => $quantity_2) {
						$product_2 = explode(':', $key_2);
						if ($product_2[0] == $product_id) {
							$discount_quantity += $quantity_2;
						}
					}
					
					$product_discount_query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "' AND customer_group_id = '" . (int)$customer_group_id . "' AND quantity <= '" . (int)$discount_quantity . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity DESC, priority ASC, price ASC LIMIT 1");
					
					if ($product_discount_query->num_rows) {
						$price = $product_discount_query->row['price'];
						$log_subtotal = (float)((float)$product_query->row['price']-(float)$price)*$discount_quantity;									
						$discount_item ='<div>Product Price:<b>'.$product_query->row['price'].'*'.$discount_quantity.' - '.$price.'*'.$discount_quantity.' = '.$log_subtotal.'</b></div>';
					}
					
					// Product Specials
					$product_special_query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "' AND customer_group_id = '" . (int)$customer_group_id . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY priority ASC, price ASC LIMIT 1");
					$special_flag = false;
					if ($product_special_query->num_rows) {
						$price = $product_special_query->row['price'];
						$special_flag = true;
						$log_subtotal = (float)((float)$product_query->row['price']-(float)$price)*$quantity;
						$discount_item ='<div>Special Price:<b>'.$product_query->row['price'].'*'.$quantity.' - '.$price.'*'.$quantity.' = '.$log_subtotal.'</b></div>';
					}	

					$discount_subtotal = $log_subtotal+$log_option_subtotal;
					$price = (float)($price+$option_price);
					$total = $price * $quantity;
					$discount = 1;
					
					if(isset($product_query->row['vip_discount']) && $product_query->row['vip_discount'] && $special_flag == false){
						$discount = $this->customer->getCustomerGroupDiscount();
						if($discount!==false){
							$price *= $discount;					
							if($discount!=1){
								$discount_subtotal = (float)((float)($price+$option_price)*$quantity)*(float)(1-$discount);
								$discount_item .='<div>VIP Discount:<b>'.($price+$option_price).'*'.$quantity.' - '.($price+$option_price).'*'.$quantity.'*'.$discount.' = '.$discount_subtotal.'</b></div>';
								$total *= $discount;
							}
						}
					}				
					// Downloads		
					$download_data = array();     		
					
					$download_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_download p2d LEFT JOIN " . DB_PREFIX . "download d ON (p2d.download_id = d.download_id) LEFT JOIN " . DB_PREFIX . "download_description dd ON (d.download_id = dd.download_id) WHERE p2d.product_id = '" . (int)$product_id . "' AND dd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
				
					foreach ($download_query->rows as $download) {
						$download_data[] = array(
							'download_id' => $download['download_id'],
							'name'        => $download['name'],
							'filename'    => $download['filename'],
							'mask'        => $download['mask'],
							'remaining'   => $download['remaining']
						);
					}
					
					// Stock
					//if (!$product_query->row['quantity'] || ($product_query->row['quantity'] < $quantity)) {
						//$stock = false;
					//}
			
					$products[$key] = array(
						'key'                       => $key,
						'product_id'                => $product_query->row['product_id'],
						'pre_code'                	=> $product_query->row['pre_code'],
						'name'                      => $product_query->row['name'],
						'image'                     => $product_query->row['image'],
						'option'                    => $option_data,
						'download'                  => $download_data,
						'quantity'                  => $quantity,
						'minimum'                   => $product_query->row['minimum'],
						'subtract'                  => 0,//$product_query->row['subtract'],
						'stock'                     => true,
						'discount'					=> turn_percent($discount),
						'price_text'				=> ($price),
						'price'                     => $price ,
						'total'                     => $total,
						'total_text'                => ($total),
						'dicount_items'				=> $option_discount_item.$discount_item,
						'balance_checkout'			=> $product_query->row['balance_checkout'] ? $product_query->row['balance_checkout'] : 0,
						'data_template_id'			=> $product_query->row['data_template_id'] ? $product_query->row['data_template_id'] : 0,
					);
				} else {
					if($express_checkout){
						$this->session->data['ex_cart'] = array();
					}else{
						$this->remove($key);
					}
				}
			}
			return $express_checkout ? $products : $this->data = $products;
		}
  	}
	public function getProductDataTemplateId($express_checkout=false){
        $productDataTemplate = array();
        
        foreach ($this->getProducts($express_checkout) as $key => $value) {
            if ((int)$value['data_template_id']) {
                $productDataTemplate[$key] = $value;
            }
        }
        
        return $productDataTemplate;
    }
    
	public function getBalanceCheckoutProducts($express_checkout=false){
        $balance_checkout_products = array();
        
        foreach ($this->getProducts($express_checkout) as $key => $value) {
            if ((int)$value['balance_checkout']) {
                $balance_checkout_products[$key] = $value;
            }
        }
        
        return $balance_checkout_products;
    }
 
  	public function add($product_id, $qty = 1, $option,$express_checkout=false) {
        $key = (int) $product_id . ':';
        
        if ($option) {
            $key .= base64_encode(serialize($option)) . ':';
        }  else {
            $key .= ':';
        }
		
        if ((int) $qty && ((int) $qty > 0)) {
        	if($express_checkout){
        		$this->session->data['ex_cart'] = array();
        		$this->session->data['ex_cart'][$key] = (int) $qty;
        	}else{
	            if (!isset($this->session->data['cart'][$key])) {
	                $this->session->data['cart'][$key] = (int) $qty;
	            } else {
	                $this->session->data['cart'][$key] += (int) $qty;
	            }
        	}
        }

        $this->data = array();
  	}

  	public function update($key, $qty) {
    	if ((int)$qty && ((int)$qty > 0)) {
      		$this->session->data['cart'][$key] = (int)$qty;
    	} else {
	  		$this->remove($key);
		}
		
		$this->data = array();
  	}

  	public function remove($key) {
		if (isset($this->session->data['cart'][$key])) {
     		unset($this->session->data['cart'][$key]);
  		}
		
		$this->data = array();
	}
	
  	public function clear($express_checkout=false) {
  		if($express_checkout){
  			$this->session->data['ex_cart'] = array();
  		}else{
			$this->session->data['cart'] = array();
			$this->data = array();
  		}
  	}
	
  	public function getSubTotal($express_checkout=false) {
		$total = 0;
		
		foreach ($this->getProducts($express_checkout) as $product) {
			$total += $product['total'];
		}

		return $total;
  	}
	
  	public function getTotal($express_checkout=false) {
		$total = 0;
		
		foreach ($this->getProducts($express_checkout) as $product) {
			$total += $product['price'] * $product['quantity'];
		}

		return $total;
  	}
	  	
  	public function countProducts($express_checkout=false) {
		$product_total = 0;
			
		$products = $this->getProducts($express_checkout);
			
		foreach ($products as $product) {
			$product_total += $product['quantity'];
		}		
					
		return $product_total;
	}
	  
  	public function hasProducts($express_checkout=false) {
    	return $express_checkout ? count($this->session->data['ex_cart']) : count($this->session->data['cart']);
  	}
	
    public function hasBalanceCheckoutProducts($express_checkout=false){
        return count($this->getBalanceCheckoutProducts($express_checkout));
    }
    
	public function hasDataTemplateProduct($express_checkout=false){
        return count($this->getProductDataTemplateId($express_checkout));
    }
  
  	public function hasStock($express_checkout=false) {
		$stock = true;
		
		foreach ($this->getProducts($express_checkout) as $product) {
			if (!$product['stock']) {
	    		$stock = false;
			}
		}
		
    	return $stock;
  	}
  
	
  	public function hasDownload($express_checkout=false) {
		$download = false;
		
		foreach ($this->getProducts($express_checkout) as $product) {
	  		if ($product['download']) {
	    		$download = true;
				
				break;
	  		}		
		}
		
		return $download;
	}	
	
}
?>