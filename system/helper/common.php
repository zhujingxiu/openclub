<?php
function lively_truncate($string, $length = 80, $etc = '...', $count_words = true) {
	mb_internal_encoding ( "UTF-8" );
	$string = strip_tags(trim(html_entity_decode($string)));
	if ($length == 0) return '';
	preg_match_all ( "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $info );
	if ($count_words) {
		$k = 0;
		$wordscut = '';
		for($i = 0; $i < count ( $info [0] ); $i ++) {
			$wordscut .= $info [0] [$i];
			$k ++;
			if ($k >= $length) {
				return $wordscut . $etc;
			}
		}
		return join ( '', $info [0] );
	}
	return join ( "", array_slice ( $info [0], 0, $length ) ) . $etc;
}
/* vim: set expandtab: */

function turn_percent($value){
	return ((float)$value*100).'%';
}



function get_duty_status_text($status){
	switch ((int)$status){
		case 0 :
			$status_text = '未读';
			break;
		case 1 :
			$status_text = '已读';
			break;
		case 2 :
			$status_text = '处理中';
			break;
		case 3 :
			$status_text = '已处理';
			break;
	}
	return $status_text;
}
function get_duty_type_text($type){

	switch (strtolower($type)){
		case 'summary' :
			$type_text = '总结';
			break;
		case 'notification' :
			$type_text = '通告';
			break;
		case 'task' :
			$type_text = '任务';
			break;
		case 'question' :
			$type_text = '问题';
			break;
		case 'refunded' :
			$type_text = '退款';
			break;
		case 'other' :
			$type_text = '其他';
			break;
	}
	return $type_text;
}


function get_image_url($fileName){
  	$imgurl='';
  	$index=strrpos($fileName,'.');
  	$ext=substr($fileName,$index+1);
  	if(in_array($ext,array('jpg','jpeg','gif','png'))){
  		$imgurl=$fileName;
  	}else{
  		if(defined("HTTP_CATALOG")){
  			$prefix = HTTP_CATALOG;
  		}else{
  			$prefix = HTTP_SERVER;
  		}
  		$imgurl=$prefix."asset/img/icons/$ext.png";
  	}
  	return $imgurl;
  }
  	


function get_contribute_status($status,$language_id=1){
  	$status_name = '';
  	switch($status){
  		case 1:
  			$status_name = $language_id==2 ? '已投稿' : 'Contributed';
  			break;
  		case 2:
  			$status_name = $language_id==2 ? '已拒绝' :'Rejected';
  			break;
  		case 3:
  			$status_name = $language_id==2 ? '已发布' :'Published';
  			break;
  	}  		
  	return $status_name;
}

function readExcel( $filePath) {
	require_once DIR_SYSTEM.'library/PHPExcel/IOFactory.php';
	$PHPReader = new PHPExcel_Reader_Excel5();
	if(!$PHPReader->canRead($filePath)){   
	 	$PHPReader = new PHPExcel_Reader_Excel5();   
	    if(!$PHPReader->canRead($filePath)){         
	    	echo 'no Excel';  
	        return ;   
	   	}  
	}
	
	$PHPExcel = $PHPReader->load($filePath);  
	
	$currentSheet = $PHPExcel->getSheet(0);  /**取得一共有多少列*/
	
	$allColumn = $currentSheet->getHighestColumn();     /**取得一共有多少行*/  
	
	$allRow = $currentSheet->getHighestRow();
	
	$all = array();
	for( $currentRow = 1 ; $currentRow <= $allRow ; $currentRow++){
		$flag = 0;
	    $col = array();
	    for($currentColumn='A'; $currentColumn <= $allColumn ; $currentColumn++){
	   		$address = $currentColumn.$currentRow;   
	
	        $string = $currentSheet->getCell($address)->getValue();
	                
	        $col[$flag] = $string;
	
	        $flag++;
	    }
	   	$all[] = $col;
	}
	return $all;
}

function writeExcel($filepath,$data = array()){
	if(!$filepath){
		return false;
	}
	require_once DIR_SYSTEM.'library/PHPExcel.php';

	if(is_array($data) ){
		$objExcel = new PHPExcel(); 
		$objExcel->getProperties()  				//获得文件属性对象，给下文提供设置资源
				->setCreator( isset($data['setting']['creator']) ? $data['setting']['creator'] : "Jason")          //设置文件的创建者
				->setLastModifiedBy( isset($data['setting']['lastModified']) ? $data['setting']['lastModified'] :"Jason")   //设置最后修改者
				->setTitle( isset($data['setting']['title']) ? $data['setting']['title'] :"Test Document" )   //设置标题
				->setSubject( isset($data['setting']['subject']) ? $data['setting']['subject'] :"Test Document" );//设置类别
		$objExcel->setActiveSheetIndex(0);//设置第一个内置表（一个xls文件里可以有多个表）为活动的
		$objActSheet = $objExcel->getActiveSheet();
	    $objActSheet->setTitle('Sheet1');
		if(isset($data['first_line'])){
			foreach ($data['first_line'] as $fk => $fv ){
				$objActSheet->setCellValue($fk,$fv);//
			}
		}
		if(isset($data['items'])){
			foreach ($data['items'] as $item ){
				foreach ($item as $_k => $_v){
					$objActSheet->setCellValue($_k,$_v);
				}
			}
		}
	}
    //生成文件
    PHPExcel_IOFactory::createWriter($objExcel, 'Excel5')->save($filepath);	
    return $filepath;
}
function initAdminIgnoreRoute(){

	return array(
				'common/home',
				'common/login',
				'common/logout',
				'common/profile',
				'common/reset',
				'error/not_found',
				'error/permission',
				'tools/common'
		);
}

//配置后台菜单
function initAdminMenu(){
	$dashboard = 'common/home';
	$catalog = array(
				'category'		=> 'catalog/category',
				'product'		=> 'catalog/product',
				'option'		=> 'catalog/option',
				'download'		=> 'catalog/download',
				'review'		=> 'catalog/review',
				'information'	=> 'catalog/information',
				'data_template' => 'catalog/data_template'
				);
	$extension = array(
				'module'		=> 'extension/module',
				'payment'		=> 'extension/payment',
				'total'			=> 'extension/total',
				'faq'			=> 'catalog/faq',
				'news'			=> 'catalog/news',
				);
	$sale = array(
				'order'			=> 'sale/order',
				'project'		=> 'sale/project',
				'customer'		=> array(
									'customer'			=>'sale/customer',
									'customer_group'	=>'sale/customer_group',
									'ban_account'		=>'sale/ban_account',
									'customer_ban_ip'	=>'sale/customer_ban_ip',
								),
				'refunded'		=> 'sale/refunded',
				'recharge'		=> 'sale/recharge_list',
				'Balance'		=> 'sale/balance_list',				
				'contact'		=> 'sale/contact',
				);
	$system = array(
				'setting'		=> 'setting/setting',
				'users'			=> array(
									'user'				=>'user/user',
									'user_group'		=>'user/user_permission',
								),
				'localisation'	=> array(
									'order_status'		=>'localisation/order_status',
									'project_status'	=>'localisation/project_status',
									'language'			=>'localisation/language',
									'currency'			=>'localisation/currency',
									'layout_design'		=>'design/layout'
								),
				'error_log'		=> 'tool/error_log',
				'backup'		=> 'tool/backup'
				);
	$manage = array(
				'accounts'		=> 'manage/accounts',
				'license'		=> 'manage/license',
				'configuration' => 'manage/configuration',
				);
	$mmc = array(
				'fbpage'		=> 'mmc/fbpage',
				);
	$tools = array(
				'statistics'	=> 'statistics/statistics/orders',
	            'change_password' => 'tools/user',
				'user_logs'		=> 'tools/user_log',
				'duty_note'		=> 'common/note',
				'world_clock'	=> 'tools/common/world_clock',
				'spin'			=> 'tools/common/spin',
				'different_name'=> 'tools/common/different_name',
				'parsing_excel'	=> 'tools/common/parsing_excel',
				);
				
	return array('dashboard'=>$dashboard,'catalog'=>$catalog,'extension'=>$extension,'sale'=>$sale,'system'=>$system,'manage'=>$manage,'mmc'=>$mmc,'tools'=>$tools);
}


	/*
	 * { id:3, pId:0, name:"父节点 3", open:true},
		{ id:31, pId:3, name:"叶子节点 3-1"},
		{ id:32, pId:3, name:"叶子节点 3-2"},
		{ id:33, pId:3, name:"叶子节点 3-3"}
	 */
function create_file_nodes($filetree,$pId=false){
	//global $nodes;
		$file_nodes = array();
		if(is_array($filetree)){
			foreach ($filetree as $key => $node){
				if(isset($node['sub_dir'])){
					$file_nodes[] = array('id'=>(int)(($pId?$pId:$node['level']).($key+1)),'pID'=>$pId?$pId:$node['level'],'name'=>$node['file_name'],'path'=>$node['file_path'],'open'=>'true','sub_node'=>create_file_nodes($node['sub_dir'],(int)(($pId?$pId:$node['level']).($key+1))));
					
				}else{
					$file_nodes[] = array('id'=>(int)(($pId?$pId:$node['level']).($key+1)),'pID'=>$pId?$pId:$node['level'],'name'=>$node['file_name'],'path'=>$node['file_path']);
				}
			}
		}

		return $file_nodes;
	}
function read_all_dir ( $dir ,$p_offset=0){

	$result = false;
	$handle = @opendir($dir);
	if ( $handle ){
		while ( ( $file = @readdir ( $handle ) ) !== false ){
			if ( $file != '.' && $file != '..'){
				$cur_path = $dir . DIRECTORY_SEPARATOR . $file;
				if ( is_dir ($cur_path) ){
					$result[] = array('file_name'=>$file,'file_path' => $cur_path,'level'=>$p_offset,'sub_dir'=> read_all_dir ($cur_path,$p_offset+1));
				}else{
					$result[] = array('file_name'=>$file,'file_path' => $cur_path,'level'=>$p_offset,);
				}
			}

		}
		@closedir($handle);
	
	}
	return $result;
}
