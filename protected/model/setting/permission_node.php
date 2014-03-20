<?php 
class ModelSettingPermissionNode extends Model {
	public function getAllNodes() {
		$data = array();
		$c_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "permission_node WHERE `type` = 'controller' AND `parent_node_id` = 0 ORDER BY sort_order");
		
		foreach ($c_query->rows as $c_row){
			$data[$c_row['name']]['info'] = $c_row;
			
			$m_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "permission_node WHERE `type` = 'model' AND `parent_node_id` = '".$c_row['node_id']."' ORDER BY sort_order");
			
			foreach ($m_query->rows as $m_row){
				
				$data[$c_row['name']]['model'][$m_row['name']]['info'] = $m_row;
				
				$a_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "permission_node WHERE `type` = 'action' AND `parent_node_id` = '".$m_row['node_id']."' ORDER BY sort_order");
			
				foreach ($a_query->rows as $a_row){
					
					$data[$c_row['name']]['model'][$m_row['name']]['action'][] = $a_row;
					
				}
			
			}
		}
		
		return $data;
	}
	public function addNode($data) {
		$fields = array();
		if($data){
			foreach ($data as $key=>$item){
				$fields[] = " `".$key."` = '".$this->db->escape($item)."' ";
			}
		}
		$this->db->query("INSERT INTO " . DB_PREFIX . "permission_node SET ".implode(" , ",$fields));
		
		return $this->db->getLastId();
		
	}
	public function editNode($node_id, $data) {
		
		$fields = array();
		if($data){
			foreach ($data as $key=>$item){
				$fields[] = " `".$key."` = '".$this->db->escape($item)."' ";
			}
		}
		
		$this->db->query("UPDATE " . DB_PREFIX . "permission_node SET ".implode(" , ",$fields)." WHERE  `node_id` = '" . (int)$node_id . "'");
		
	}
	
	public function deleteNode($node_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "permission_node WHERE node_id = '" . (int)$node_id . "' ");
	}
	
	public function getNode($node_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "permission_node WHERE `node_id` = '".$node_id."' ");
		
		return $query->row;
	}	
	
	public function getNodeByName($name ,$type) {
		$query = $this->db->query("SELECT COUNT(node_id) AS total FROM " . DB_PREFIX . "permission_node WHERE `name` = '".$this->db->escape($name)."' AND `type` = '".$this->db->escape($type)."'");
		
		return $query->row['total'];
	}
	
	public function getNodeByUrl($url,$type) {
		$query = $this->db->query("SELECT COUNT(node_id) AS total FROM " . DB_PREFIX . "permission_node WHERE `url` = '".$this->db->escape($url)."' AND `type` = '".$this->db->escape($type)."'");
		
		return $query->row['total'];
	}
	
	public function getParentNodes($parent_id) {
		$query = $this->db->query("SELECT node_id,name,type,parent_node_id FROM " . DB_PREFIX . "permission_node WHERE `parent_node_id` = '".(int)$parent_id."' ");
		
		return $query->rows;
	}
}
?>