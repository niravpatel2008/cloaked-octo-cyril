<?php
class common_model extends CI_Model{
	public function  __construct(){
		parent::__construct();
		$this->load->database();
	}


	/**
	* Select data
	*
	* general function to get result by passing nesessary parameters
	*/
	public function selectData($table, $fields='*', $where='', $order_by="", $order_type="", $group_by="", $limit="", $rows="", $type='')
	{
		$this->db->select($fields);
		$this->db->from($table);
		if ($where != "") {
			$this->db->where($where);
		}

		if ($order_by != '') {
			$this->db->order_by($order_by,$order_type);
		}

		if ($group_by != '') {
			$this->db->group_by($group_by);
		}

		if ($limit > 0 && $rows == "") {
			$this->db->limit($limit);
		}
		if ($rows > 0) {
			$this->db->limit($rows, $limit);
		}


		$query = $this->db->get();

		if ($type == "rowcount") {
			$data = $query->num_rows();
		}else{
			$data = $query->result();
		}

		#echo "<pre>"; print_r($this->db->queries); exit;
		$query->free_result();

		return $data;
	}


	/**
	* Insert data
	*
	*general function to insert data in table
	*/
	public function insertData($table, $data)
	{
		$result = $this->db->insert($table, $data);
		if($result == 1){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}


	/**
	* Update data
	*
	* general function to update data
	*/
	public function updateData($table, $data, $where)
	{
		$this->db->where($where);
		if($this->db->update($table, $data)){
			return 1;
		}else{
			return 0;
		}
	}


	/**
	* Delete data
	*
	* general function to delete the records
	*/
	public function deleteData($table, $data)
	{
		if($this->db->delete($table, $data)){
			return 1;
		}else{
			return 0;
		}
	}



	/**
	* check unique fields
	*/
	public function isUnique($table, $field, $value,$where = "")
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($field,$value);
		if ($where != "")
			$this->db->where($where);
		$query = $this->db->get();
		$data = $query->num_rows();
		$query->free_result();

		return ($data > 0)?FALSE:TRUE;
	}


	function setImageOrder($imglist,$objid,$type)
	{
		$imglist = json_decode($imglist,1);
		foreach($imglist as $imgdata)
		{
			$where = array();
			$where['link_id'] = $imgdata['link_id'];
			$where['link_object_id'] = $objid;
			$where['link_type'] = $type;

			$data = array();
			$data['link_order'] = $imgdata['link_order'];
			$this->common_model->updateData(DEAL_LINKS, $data, $where);
		}
	}

	public function assingImagesToStamp($t_id,$image_ids)
	{
		$this->db->where_in('link_id',$image_ids);
		$data = array("link_object_id"=>$t_id);
		if($this->db->update(DEAL_LINKS, $data)){
			return 1;
		}else{
			return 0;
		}
	}

	public function getTags($obj_id,$type)
	{
		$this->db->select("tag_id,tag_name");
		$this->db->from(TICKET_TAG);
		$this->db->join(TICKET_TAG_MAPPING, "tm_object_id = tag_id");
		$this->db->where(array("tm_object_id"=>$obj_id));
		$this->db->where(array("tm_type"=>$type));

		$query = $this->db->get();
		$tags = $query->result_array();
		$query->free_result();
		return ($tags);
	}
	
	public function deleteTags($tm_tagid,$obj_id,$type)
	{
		$this->db->where_in('tm_tagid', $tm_tagid);
		$this->db->where(array('tm_object_id'=>$obj_id));
		$this->db->where(array('tm_type'=>$type));
		$del = $this->db->delete(TICKET_TAG_MAPPING);
		if($del){
			$delqry = "DELETE FROM TICKET_TAG WHERE tag_id IN (".implode(",",$tm_tagid).") AND (SELECT IF (COUNT(*)=0,1,0) FROM TICKET_TAG_MAPPING WHERE tm_tagid = tag_id AND tm_type = '$type')";
			$this->db->query($delqry);
			return 1;
		}else{
			return 0;
		}
	}

}
