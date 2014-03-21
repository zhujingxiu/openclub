<?php
class ModelUserLog extends Model {

	public function truncate(){
		return $this->db->query('TRUNCATE '.DB_PREFIX.'user_log');
	}
			
	public function deleteLog($log_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "user_log` WHERE user_log_id = '" . (int)$log_id . "'");
	}
	
	public function getLog($log_id) {
		$query = $this->db->query("SELECT ul.*,u.username FROM `" . DB_PREFIX . "user_log` ul LEFT JOIN ".DB_PREFIX."user u ON ul.user_id = u.user_id WHERE user_log_id = '" . (int)$log_id . "'");
	
		return $query->row;
	}

	public function getUsers(){
		$users = array();
		$query = $this->db->query("SELECT * FROM ".DB_PREFIX."user");
		if($query->num_rows){
			foreach($query->rows as $row){
				$users[$row['user_id']] = $row['username'];
			}
		}
		return $users;
	}
	
	public function getLogs($data = array()) {
		$sql = "SELECT ul.*,u.username,u.firstname,u.lastname FROM `" . DB_PREFIX . "user_log` ul LEFT JOIN ".DB_PREFIX."user u ON ul.user_id = u.user_id WHERE 1 ";
		
		if(isset($data['filter_user_id']) && !empty($data['filter_user_id'])){
			$sql .= " AND ul.user_id = '".(int)$data['filter_user_id']."'";
		}
		if (!empty($data['filter_log_time_start'])) {
			$sql .= " AND ul.log_time >= '" . $this->db->escape($data['filter_log_time_start']) . "'";
		}
		
		if (!empty($data['filter_log_time_end'])) {
			$sql .= " AND ul.log_time <= '" . $this->db->escape($data['filter_log_time_end']) . "'";
		}
		if (!empty($data['filter_action'])) {
			$sql .= " AND ul.action LIKE '" . $this->db->escape($data['filter_action']) . "%'";
		}
		if (!empty($data['filter_url'])) {
			$sql .= " AND ul.url LIKE '%" . $this->db->escape($data['filter_url']) . "%'";
		}
			
		$sort_data = array(
			'username',
			'action',
			'url',
			'log_time'
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY log_time";	
		}
			
		if (isset($data['order']) && ($data['order'] == 'ASC')) {
			$sql .= " ASC";
		} else {
			$sql .= " DESC";
		}
		if(!isset($data['filter_all']) || !$data['filter_all']){
			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}			
				
				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}	
				
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}
		}
		$query = $this->db->query($sql);
	
		return $query->rows;
	}

	public function getTotalLogs($data= array()) {
      	$sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user_log` ul LEFT JOIN ".DB_PREFIX."user u ON ul.user_id = u.user_id WHERE 1 ";
		
		if(isset($data['filter_user_id']) && !empty($data['filter_user_id'])){
			$sql .= " AND ul.user_id = '".(int)$data['filter_user_id']."'";
		}
		if (!empty($data['filter_log_time_start'])) {
			$sql .= " AND ul.log_time >= '" . $this->db->escape($data['filter_log_time_start']) . "'";
		}
		
		if (!empty($data['filter_log_time_end'])) {
			$sql .= " AND ul.log_time <= '" . $this->db->escape($data['filter_log_time_end']) . "'";
		}
		if (!empty($data['filter_action'])) {
			$sql .= " AND ul.action LIKE '" . $this->db->escape($data['filter_action']) . "%'";
		}
		if (!empty($data['filter_url'])) {
			$sql .= " AND ul.url LIKE '%" . $this->db->escape($data['filter_url']) . "%'";
		}
		
		$query = $this->db->query($sql);
		return $query->row['total'];
	}

	public function getLastLogInfo($data) {
      	$query = $this->db->query("SELECT ul.*,u.username FROM `" . DB_PREFIX . "user_log` ul LEFT JOIN ".DB_PREFIX."user u ON ul.user_id = u.user_id WHERE user_log_id < '".$data['user_log_id']."' AND url = '".$data['url']."' AND action = '".$data['action']."' ORDER BY log_time DESC limit 1");
		
		return $query->row;
	}
	
	public function getTotalUsersByEmail($email) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user` WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
		
		return $query->row['total'];
	}	
}
?>