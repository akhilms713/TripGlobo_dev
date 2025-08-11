<?php
class Deposit_Model extends CI_Model {
	
	public function __construct(){
	    parent::__construct();
    }
	 
	public function get_deposit_details($deposit_status,$date=""){
		 $this->db->select('user_deposit.*,user_deposit.user_id as user_deposit_id,user_type.*,user_details.*,user_deposit.status as deposit_status,user_accounts.*')
                ->from('user_deposit');
				if($deposit_status!='')
				{
					 $this->db->where('user_deposit.status',$deposit_status);
				}
				if($date!=''){
				    $this->db->where('user_deposit.creation_date_time >=',$date);
				}
				
				 $this->db->join('user_login_details', 'user_login_details.user_id  = user_deposit.user_id', 'left')
                ->join('user_type', 'user_type.user_type_id  = user_login_details.user_type_id', 'left')
				 ->join('user_details', 'user_details.user_id  = user_deposit.user_id', 'left')
				 ->join('user_accounts', 'user_accounts.user_id  = user_deposit.user_id', 'left')
				 ->order_by('`user_deposit`.`status`');
				
				
		$query = $this->db->get();
		
//	echo $this->db->last_query();exit();

		if ( $query->num_rows > 0 ) 
		{
			
			return $query->result();
	    }
		else
		{
			
			return '';
		}
	
	}
	public function save_deposit($post_data,$slip,$sub_admin_id)
	{
		$user_det = $post_data['user_det'];
		$amount = $post_data['amount'];
		$deposit_mode = $post_data['banking_types'];
		$d_date = $post_data['d_date'];
		$b_name = $post_data['b_name'];
		$b_branch = $post_data['b_branch'];
		$b_city = $post_data['b_city'];
		$c_date = $post_data['c_date'];
		$c_number = $post_data['c_number'];
		$Remarks = $post_data['Remarks'];
		$service_charge = (!empty($post_data['service_charge']))?$post_data['service_charge']:0;
		
		$select2 = "select max(deposit_id)+1 as max from user_deposit";
		$query=$this->db->query($select2);
		$aa = $query->row();
		$m_id1 = 0;
		if($aa!='')
		{
			$m_id1=  $aa->max;
		}
		// debug($deposit_mode);exit();
		$m_id =  'DS'.date('d').date('m').($m_id1+10000);
	    if ($this->session->userdata('admin_type_id')==1) {	    	
		$data = array(
			'user_id' => $user_det,
			'amount' => $amount,
			'deposited_date' => $d_date,
			'superadmin_remark' => $Remarks,
			'deposit_number' => $m_id,
			'deposit_mode' => $deposit_mode,
			'deposit_slip' => $slip,
			'cheque_number' => $c_number,
			'cheque_date' => $c_date,
			'bank_city' => $b_city,
			'bank_branch' => $b_branch,
			'bank_name' => $b_name,
			'service_charge' => $service_charge,
			'status' => 'ACCEPTED',			
			'superadmin_status' => 'ACCEPTED',
			'collected_by' => $sub_admin_id
		);
	    }else{
        $data = array(
			'user_id' => $user_det,
			'amount' => $amount,
			'deposited_date' => $d_date,
			'admin_remarks' => $Remarks,
			'deposit_number' => $m_id,
			'deposit_mode' => $deposit_mode,
			'deposit_slip' => $slip,
			'cheque_number' => $c_number,
			'cheque_date' => $c_date,
			'bank_city' => $b_city,
			'bank_branch' => $b_branch,
			'bank_name' => $b_name,
			'service_charge' => $service_charge,
			'status' => 'ACCEPTED',		
			
			'collected_by' => $sub_admin_id
		);
	    }
			
			// debug($this->session->userdata('admin_type_id'));exit();
		$this->db->insert('user_deposit', $data);
		$id = $this->db->insert_id();
		if (!empty($id) && $this->session->userdata('admin_type_id') == 1) {
			// Update Agent Acc info
			$select = "SELECT user_accounts_id FROM   user_accounts where user_id = $user_det limit 1";
			//echo $select;exit;
			$query=$this->db->query($select);
			if ($query->num_rows() > 0)
			{
				$qry = "update user_accounts set balance_credit = (balance_credit + $amount), last_credit = $amount where user_id = $user_det";

			} else {
				$qry = "insert into  user_accounts set user_id = $user_det, balance_credit = $amount, last_credit = $amount";
			}
			//echo $qry;exit;
			$query=$this->db->query($qry);
			////////////////////
			$select2 = "SELECT * FROM  user_accounts where user_id = $user_det limit 1";
			//echo $select;exit;
			$query2=$this->db->query($select2);
			if ($query2->num_rows() > 0)
			{
				$am_result = $query2->row();
	
				$description='DEPOSIT - : '.$m_id;
								
					$account_transaction = array(
						'transaction_type' => 'DEPOSIT',
						'deposit_id' => $id,
						'deposit_number' => $m_id,
						'user_id' => $user_det,
						'amount' => $amount,
						'balance_amount' => $am_result->balance_credit,
						'description' => $description
					);
					$this->db->insert('user_transaction',$account_transaction); 
					$bid = $this->db->insert_id();
					$timing = date('Ymd');
					$timing1 = date('His');
					$txno = 'TX'.$timing.$bid.$timing1;
								$update_account = array(
									'transaction_number' => $txno
								);
								
					$this->db->where('user_transaction_id',$bid);
					
					$this->db->update('user_transaction', $update_account);
					
			}
		
					/*  Service Tax adding */
					
					$amount = $am_result->balance_credit - $service_charge;
					
						$select = "SELECT user_accounts_id FROM   user_accounts where user_id = $user_det limit 1";
			//echo $select;exit;
			$query=$this->db->query($select);
			if ($query->num_rows() > 0)
			{
				$qry = "update user_accounts set balance_credit = (balance_credit - $service_charge), last_debit = $service_charge where user_id = $user_det";

			} else {
				$qry = "insert into  user_accounts set user_id = $user_det, balance_credit = $amount, last_debit = $service_charge";
			}
			//echo $qry;exit;
			$query=$this->db->query($qry);
				$select2 = "SELECT * FROM  user_accounts where user_id = $user_det limit 1";
			//echo $select;exit;
			$query2=$this->db->query($select2);
			if ($query2->num_rows() > 0)
			{
				$am_result = $query2->row();
				$description='Service Charge Of Deposit  '.$m_id;
					$account_transaction = array(
						'transaction_type' => 'WITHDRAW',
						'user_id' => $user_det,
						'amount' => $service_charge,
						'balance_amount' => $amount,
						'description' => $description
					);
					$this->db->insert('user_transaction',$account_transaction); 
					$bid = $this->db->insert_id();
					$timing = date('Ymd');
					$timing1 = date('His');
					$txno = 'TX'.$timing.$bid.$timing1;
								$update_account = array(
									'transaction_number' => $txno
								);
								
					$this->db->where('user_transaction_id',$bid);
					
					$this->db->update('user_transaction', $update_account);
					
					
			}
			return $id;
			
		} else {
			$this->update_deposit_status($id,'ACCEPTED',$user_det,$amount, $service_charge,$Remarks,$sub_admin_id);
			return $id;
		}

	
	}
	public function get_deposit_account_details($deposit_id)
	{
		 $this->db->select('*')
                ->from('user_deposit')->where('deposit_id',$deposit_id);
				
				
		$query = $this->db->get();

		if ( $query->num_rows > 0 ) 
		{
			
			return $query->row();
	    }
		else
		{
			
			return '';
		}
	
	}
		function update_deposit_status($id,$status,$user_id,$amount_credit, $service_fee,$admin_remarks,$admin_id)
	    {
	        $accepted_id = 0;
			if($status=='ACCEPTED')
			{
			    $insert_data['amount'] = $amount_credit;
			    $insert_data['service_fee'] = $service_fee;
			    $insert_data['admin_id'] = $admin_id;
			    $insert_data['deposit_id'] = $id;
			    $this->db->insert('admin_deposit_accepted', $insert_data);
		        $accepted_id = $this->db->insert_id();
			}
				
			$data = array(
				'status' => $status,
				'admin_remarks'=>$admin_remarks,
				'collected_by' => $admin_id,
				'admin_accepted_id' => $accepted_id
				);
				
				$where = "deposit_id = ".$id;
				$this->db->update('user_deposit', $data, $where);
				
				return true;
	}
	    
	public function get_user_details($module)
	{
		$this->db->select('user_login_details.*,user_details.*,address_details.*, country_list.country_name')
                ->from('user_login_details')
				->where('user_type.user_type_name',$module)
				 ->join('user_details', 'user_details.user_id  = user_login_details.user_id', 'left')
				 ->join('user_type', 'user_type.user_type_id  = user_login_details.user_type_id', 'left')
				 ->join('user_login_access', 'user_login_access.user_id  = user_login_details.user_id', 'left')
				 ->join('address_details', 'address_details.address_details_id  = user_details.address_details_id', 'left')
				 ->join('country_list', 'country_list.country_code  = address_details.country_code', 'left');
				 
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) 
		{
			return $query->result();	
		}
		else
		{
			return '';	
		}
	}
	
	function update_superadminAction_status($id,$status,$user_id,$admin_id,$admin_accepted_id,$remarks)
	{
	    
	    if($status=='ACCEPTED')
			{
			    $qry_a =  "SELECT * FROM  admin_deposit_accepted where deposit_id = $id and id= $admin_accepted_id";
			    
			    $query_accepted = $this->db->query($qry_a);
			    
			    if ($query_accepted->num_rows() > 0)
				{
					$getresult = $query_accepted->row();
			    // debug($getresult);exit();
					//echo '<pre>';print_r($getresult);exit();
					if ($getresult->service_fee=='') {
			        $service_fee =0;						
					}else{
			        $service_fee =$getresult->service_fee;	
					}
			        $amount_credit = $getresult->amount;
			    
    				$qry = "update  user_accounts set balance_credit = (balance_credit + $amount_credit), last_credit = $amount_credit where user_id = $user_id";
    
    				$query=$this->db->query($qry);
    				$select2 = "SELECT * FROM  user_deposit where deposit_id = $id limit 1";
    					//echo $select;exit;
    					$query2=$this->db->query($select2);
    					if ($query2->num_rows() > 0)
    					{
    						$am_result = $query2->row();
    					
    						$description='DEPOSIT - : '.$am_result->deposit_number;
    						$select3 = "SELECT * FROM  user_accounts where user_id = $user_id limit 1";
    					//echo $select;exit;
    					$query3=$this->db->query($select3);
    					if ($query3->num_rows() > 0)
    					{
    						$am_result3 = $query3->row();
    						
    							$account_transaction = array(
    								'transaction_type' => 'DEPOSIT',
    								'deposit_id' => $am_result->deposit_id,
    								'deposit_number' => $am_result->deposit_number,
    								
    								'user_id' => $user_id,
    								'amount' => $amount_credit,
    								'balance_amount' => $am_result3->balance_credit,
    								'description' => $description
    							);
    							$this->db->insert('user_transaction',$account_transaction); 
    							$bid = $this->db->insert_id();
    							$timing = date('Ymd');
    							$timing1 = date('His');
    							$txno = 'TX'.$timing.$bid.$timing1;
    									$update_account = array(
    											'transaction_number' => $txno
    											);
    							$this->db->where('user_transaction_id',$bid);
    							$this->db->update('user_transaction', $update_account);
    					}
    					}
    					
    					/* Service fee charging starts here */
    					
    					$qry = "update  user_accounts set balance_credit = (balance_credit - $service_fee), last_debit = $service_fee where user_id = $user_id";
    
        				$query=$this->db->query($qry);
        				$select2 = "SELECT * FROM  user_deposit where deposit_id = $id limit 1";
    					//echo $select;exit;
    					$query2=$this->db->query($select2);
    					if ($query2->num_rows() > 0)
    					{
    						$am_result = $query2->row();
    						$amount = $am_result->balance_credit - $service_fee;
    						$description='Service Charge Of Deposit - : '.$am_result->deposit_number;
    						$select3 = "SELECT * FROM  user_accounts where user_id = $user_id limit 1";
    					//echo $select;exit;
    					$query3=$this->db->query($select3);
    					if ($query3->num_rows() > 0)
    					{
    						$am_result3 = $query3->row();
    						
    							$account_transaction = array(
    								'transaction_type' => 'WITHDRAW',
    								'deposit_id' => $am_result->deposit_id,
    								'deposit_number' => $am_result->deposit_number,
    								
    								'user_id' => $user_id,
    								'amount' => $service_fee,
    								'balance_amount' => $amount,
    								'description' => $description
    							);
    							$this->db->insert('user_transaction',$account_transaction); 
    							$bid = $this->db->insert_id();
    							$timing = date('Ymd');
    							$timing1 = date('His');
    							$txno = 'TX'.$timing.$bid.$timing1;
    									$update_account = array(
    											'transaction_number' => $txno
    											);
    							$this->db->where('user_transaction_id',$bid);
    							$this->db->update('user_transaction', $update_account);
    					}
    					}
    					
    					/* service fee charging ends here */
    					
				}else{
				    //exit('not accepted');
				    $msg = 'Deposit is not accepted by admin.';
				}
			}
			
	    $data = array(
				'superadmin_status' => $status,
				'superadmin_remark' => $remarks,
				);
				$where = "deposit_id = ".$id;
				$this->db->update('user_deposit', $data, $where);
				
				return true;
	}
	
	public function get_deposit_check($admin_status,$super_status,$date=""){
	    
	    $this->db->select('user_deposit.*,user_deposit.user_id as user_deposit_id,user_type.*,user_details.*,user_deposit.status as deposit_status,user_accounts.*');
	    $this->db->from('user_deposit');
	    $this->db->join('user_login_details', 'user_login_details.user_id = user_deposit.user_id','left');
	    $this->db->join('user_type', 'user_type.user_type_id  = user_login_details.user_type_id', 'left');
	    $this->db->join('user_details', 'user_details.user_id  = user_deposit.user_id', 'left');
	    $this->db->join('user_accounts', 'user_accounts.user_id  = user_deposit.user_id', 'left');
	    
        if($admin_status!='')
		{
		    $this->db->where('user_deposit.status',$admin_status);
		}
		if($super_status!='')
		{
		    $this->db->where('user_deposit.superadmin_status',$super_status);
		}
		if($date!=''){
		    $this->db->LIKE('user_deposit.creation_date_time',$date);
		}
        $this->db->order_by("user_deposit.creation_date_time", "desc");
        
        $query = $this->db->get();

		return $query->result();
	
	}
}
