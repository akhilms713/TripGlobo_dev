<?php
/**
 * Library which has generic functions to get data
 *
 * @package    Provab Application
 * @subpackage Travel Portal
 * @author     Arjun J<arjunjgowda260389@gmail.com>, Swaraj
 * @version    V2
 */
Class Custom_Db extends CI_Model
{
    
	/**
	 * get records from table using basic select
	 *
	 * @param $table	 Name of table from which records has to be fetched
	 * @param $cols		 group of columns to be selected
	 * @param $condition condition to be used to the records
	 * @param $offset	 offset to be used while fetching records
	 * @param $limit	 number of records to be fetched
	 * @param $order_by	 order in which the records has to be fetched
	 */
	function get_records ($table, $condition = '', $cols='*')
	{	
		$data = '';
		$temp_condition = array('1' => 1);
		if (strlen($table) > 0 ) {
			if(is_array($condition)) {
				$temp_condition = $condition;
			}
			$tmp_data = $this->db->select($cols)->get_where($table, $temp_condition)->result_array();
			$data = array('status' => 'SUCCESS', 'data' => $tmp_data);
		} else {
			redirect('general/redirect_login');
		}
		return $data;
	}
        function fetch_records ($table, $cols='*')
	{
		$data = '';
		if (strlen($table) > 0 ) {
			$tmp_data = $this->db->select($cols)->get_where($table)->result_array();
			$data = array('status' => 'SUCCESS', 'data' => $tmp_data);
		} else {
			redirect('general/redirect_login');
		}
		return $data;
	}
	function single_table_records($table, $cols='*', $condition=array(), $offset=0, $limit=1000, $order_by=array())
	{
           
		$data = '';
		if (empty($table) == false and is_string($table) == true) {
			if (is_array($order_by)) {
				foreach ($order_by as $k => $v) {
					$this->db->order_by($k, $v);
				}
			}
			$tmp_data = $this->db->select($cols)->get_where($table, $condition, $limit, $offset);
                        
			if($tmp_data->num_rows()>0) {
				$tmp_data=$tmp_data->result_array();
				$data = array('status' => QUERY_SUCCESS, 'data' => $tmp_data);
			}
			else {
				$data = array('status' => QUERY_FAILURE);
			}
		} else {
			redirect('general/redirect_login');
		}
		//echo $this->db->last_query();
		return $data;
	}

	/**
	 * get records from different tables using cross join
	 *
	 * @param array $tables        array having list of tables to be joined
	 * @param string $cols	       group of columns to be selected
	 * @param array $joincondition join condition to be used to join tables
	 * @param array $condition     condition to be used to the records
	 * @param number $offset       offset to be used while fetching records
	 * @param number $limit        number of records to be fetched
	 * @param array $order_by      order in which the records has to be fetched
	 * Ex. multiple_table_cross_records(array('modules','api'), 'api_id', array('modules.pk' => 'api.module_fk'), array('modules.status' => ACTIVE, 'api.status' => ACTIVE));
	 */
	function multiple_table_cross_records($tables=array(), $cols='*', $joincondition=array(), $condition=array(), $offset=0, $limit=1000, $order_by=array()){
		$data = '';
		if (valid_array($tables) && valid_array($joincondition)) {
			if (valid_array($order_by)) {
				foreach ($order_by as $k => $v) {
					$this->db->order_by($k, $v);
				}
			}
                        
			for($i=1;$i<count($tables);$i++){
				foreach ($joincondition as $ck => $cv) {
					$this->db->join($tables[$i], $ck."=".$cv);
				}
			}
                        
			$tmp_data = $this->db->select($cols)->get_where($tables[0], $condition, $limit, $offset)->result_array();
			//echo $this->db->last_query(); exit;
			$data = array('status' => QUERY_SUCCESS, 'data' => $tmp_data);
		} else {
			redirect('general/redirect_login');
		}
		return $data;
	}
        

	/*
	 *this will insert the data into database and create new record
	 *
	 *@param string $table_name name of the table to which the data has to be inserted
	 *@param array  $data       data which has to be inserted into database
	 *
	 *@return array has status of insertion and insert id
	 */
	function insert_record ($table_name, $data)
	{
		$this->db->insert($table_name, $data);
		$num_inserts = $this->db->affected_rows();
		if (intval($num_inserts) > 0) {
			$data = array('status' => QUERY_SUCCESS, 'insert_id' => $this->db->insert_id());
		} else {
			redirect('general/redirect_login');
		}
		return $data;
	}

	/*
	 *this will insert the data into database and create new record
	 *
	 *@param string $table_name name of the table to which the data has to be inserted
	 *@param array  $data       data which has to be inserted into database
	 *
	 *@return array has status of insertion and insert id
	 */
	function update_record ($table_name='', $data='', $condition='')
	{ //error_reporting(E_ALL);

		$status = '';
		if ((valid_array($data) == true) && (valid_array($condition)== true)) {
			$this->db->update($table_name, $data, $condition);
			if($this->db->affected_rows()>0) {
				$status = QUERY_SUCCESS;
			} else {
				$status = QUERY_FAILURE;
			}

			// echo $this->db->last_query();exit;
		} else {
			redirect('general/redirect_login');
		}
		return $status;
	}

	/*
	 *this will delete data from database
	 *
	 *@param string $table_name name of the table to which the data has to be inserted
	 *@param array  $condition  condition for deleting data
	 *
	 *@return array has status of insertion and insert id
	 */
	function delete_record($table_name='',  $condition='')
	{
		$status = '';
		if (valid_array($condition)) {
			$this->db->delete($table_name, $condition);
			$status = QUERY_SUCCESS;
		} else {
			redirect('general/redirect_login');
		}
		return $status;
	}
	
	// common query in header.php 
	/*function crs_hotel_supplier_details()
	{      
		$this->db->select('*');
		$this->db->where('supplier_id',$this->entity_user_id);
		$query = $this->db->get('crs_hotel_supplier_details');
		return $query;
	}*/
    public function num_records($table,$condition){
    	$data='';
    	if(isset($table) && strlen($table) > 0){
    		if(is_array($condition)){
    			$tmp_condition=$condition;
    		}else{
    			$tmp_condition=1;
    		}
    		$this->db->select('*');
			$this->db->where($tmp_condition);
			$query = $this->db->get($table);
			$data = $query->num_rows();
    		
    	}
    	return $data;
    }
/*
		# function getRecords($tbl_name,$condition=FALSE,$select=FALSE,$order_by=FALSE,$limit=FALSE,$start=FALSE)
		# * indicates paramenter is must
		# Use : 
			1) return array of records from table
		# Parameters : 
			1) $tbl_name* =name of table 
			2) $condition=array('column_name1'=>$column_val1,'column_name2'=>$column_val2);
			3) $select=('col1,col2,col3');
			4) $order_by=array('colname1'=>order,'colname2'=>order); Order='ASC OR DESC'
			5) $limit= limit for paging
			6) $start=start for paging
		
		# How to call:
			$this->master_model->getRecords('tbl_name',$condition_array,$select,...);
			
		# In case where we need joins, you can pass joins in controller also.
		Ex: 
			$this->db->join('tbl_nameB','tbl_nameA.col=tbl_nameB.col','left');
			$this->master_model->getRecords('tbl_name',$condition_array,$select,...);
			
		# Instruction 
			1) check number of counts in controller or where you are displying records
			
	*/
	
	public function getRecords($tbl_name,$condition=FALSE,$select=FALSE,$order_by=FALSE,$start=FALSE,$limit=FALSE)
	{
		if($select!="")
		{$this->db->select($select);}
		
		if(count($condition)>0 && $condition!="")
		{
			$condition=$condition;
		}
		else
		{$condition=array();}
		if(count($order_by)>0 && $order_by!="")
		{
			foreach($order_by as $key=>$val)
			{$this->db->order_by($key,$val);}
		}
		if($limit!="" || $start!="")
		{
			$this->db->limit($limit,$start);
		}
		
		$rst=$this->db->get_where($tbl_name,$condition);
		return $rst->result_array();
	}
	     
	
}

?>
