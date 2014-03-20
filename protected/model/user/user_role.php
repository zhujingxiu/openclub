<?php
class ModelUserUserRole extends Model {
	public function addUserRole($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "user_role SET name = '" . $this->db->escape($data['name']) . "', permission = '" . (isset($data['permission']) ? serialize($data['permission']) : '') . "'");
	}
	
	public function editUserRole($user_role_id, $data) {
		
		$this->db->query("UPDATE " . DB_PREFIX . "user_role SET name = '" . $this->db->escape($data['name']) . "', permission = '" . (isset($data['permission']) ? serialize($data['permission']) : '') . "' WHERE user_role_id = '" . (int)$user_role_id . "'");
	}
	
	public function deleteUserRole($user_role_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "user_role WHERE user_role_id = '" . (int)$user_role_id . "'");
	}

	public function addPermission($user_id, $type, $page) {
		$user_query = $this->db->query("SELECT DISTINCT user_role_id FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$user_id . "'");
		
		if ($user_query->num_rows) {
			$user_role_query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "user_role WHERE user_role_id = '" . (int)$user_query->row['user_role_id'] . "'");
		
			if ($user_role_query->num_rows) {
				$data = unserialize($user_role_query->row['permission']);
				
				$data[$type][] = $page;
		
				$this->db->query("UPDATE " . DB_PREFIX . "user_role SET permission = '" . serialize($data) . "' WHERE user_role_id = '" . (int)$user_query->row['user_role_id'] . "'");
			}
		}
	}
	
	public function getUserRole($user_role_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "user_role WHERE user_role_id = '" . (int)$user_role_id . "'");
		
		$user_role = array(
			'name'       => $query->row['name'],
			'permission' => unserialize($query->row['permission'])
		);
		
		return $user_role;
	}
	
	public function getUserRoles($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "user_role";
		
		$sql .= " ORDER BY name";	
			
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}			

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
			
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
			
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
	public function getTotalUserRoles() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "user_role");
		
		return $query->row['total'];
	}	
	
	public function getPermissionNode($url){
		if(!empty($url)){
			$query = $this->db->query("SELECT remark FROM " . DB_PREFIX . "permission_node WHERE url = '".$url."'");
			if($query->num_rows){
				return $query->row['remark'];
			}
		}
		return false;
	}
}
?>