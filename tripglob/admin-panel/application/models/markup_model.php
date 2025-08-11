<?php
class Markup_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }   
	
	function get_markup_list($markup_details_id = ''){		 
		$this->db->select('m.*, d.domain_name,a.api_name,a.api_alternative_name,a.api_credential_type,ad.airline_name,p.product_name,ut.user_type_name,c.country_name,c.iso3_code');
		// $this->db->select('m.*, d.domain_name,a.api_name,a.api_alternative_name,a.api_credential_type,p.product_name,ut.user_type_name');
		$this->db->from('markup_details m');
		$this->db->join('domain_details d', 'd.domain_details_id = m.domain_details_id');
		$this->db->join('api_details a', 'a.api_details_id = m.api_details_id');
		$this->db->join('product_details p', 'p.product_details_id = m.product_details_id');
		//$this->db->join('airline_details ad', 'ad.airline_code = m.airline_details_id','left');
		$this->db->join('airline_list ad', 'ad.airline_code = m.airline_details_id','left');
		$this->db->join('user_type ut', 'ut.user_type_id = m.user_type_id');
		$this->db->join('country_details c', 'c.country_id = m.country_id','left');
		if($markup_details_id !='')
			$this->db->where('markup_details_id', $markup_details_id);
		$query=$this->db->get();
		// echo $this->db->last_query();exit;
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	public function get_markup_data($user_type,$product_type,$markup_type){
		$query = "select * from markup_details where user_type_id =".$user_type." AND product_details_id=".$product_type." AND markup_type = '".$markup_type."' ";
		return $this->db->query($query)->result_array();

	}
	public function add_markup($input){
		//echo "<pre/>";print_r($input);exit;
		if(!isset($input['status']))
			$input['status'] = "INACTIVE";	
		$insert_markup_data = array(
				'user_type_id' 				=> $input['user_type'],
				'domain_details_id' 		=> $input['domain'],
				'product_details_id' 		=> $input['product'],					
				'api_details_id' 			=> $input['api'],			
				'markup_type' 				=> $input['markup_type'],
				'user_details_id'			=> $input['agent_name'],	
				'country_id' 				=> $input['country'],				
				'airline_details_id' 		=> $input['airline'],													
				'markup_value' 				=> $input['markup_value'],
				'markup_fixed' 				=> $input['markup_fixed'],
				'ip_address'				=> $_SERVER['REMOTE_ADDR'],
				'date'						=> date('Y-m-d H:i:s'),
				'status'			        => "ACTIVE"				
			);	
			//echo "<pre/>";print_r($insert_markup_data)		;exit;
		$this->db->insert('markup_details',$insert_markup_data);							
	}

	
	public function add_markup_old($input){
		//echo "<pre/>";print_r($input);exit;
		if(!isset($input['status']))
			$input['status'] = "INACTIVE";
		//for($ut=0;$ut<count($input['user_type']);$ut++){
			//echo"<pre/>"; print_r($input);
			//for($d=0;$d<count($input['domain']);$d++){
				//for($p=0;$p<count($input['product']);$p++){
					//for($a=0;$a<count($input['api']);$a++){
						//for($mt=0;$mt<count($input['markup_type']);$mt++){
						//	for($c=0;$c<count($input['country']);$c++){
							//	for($ad=0;$ad<count($input['airline']);$ad++){
											//echo"<pre/>"; print_r($input);exit;
									$insert_markup_data = array(
											'user_type_id' 				=> $input['user_type'],
											'domain_details_id' 		=> $input['domain'],
											'product_details_id' 		=> $input['product'],					
											'api_details_id' 			=> $input['api'],			
											'markup_type' 				=> $input['markup_type'],
											'user_details_id'			=> $input['agent_name'],	
											'country_id' 				=> $input['country'],				
											'airline_details_id' 		=> $input['airline'],													
											'markup_value' 				=> $input['markup_value'],													
											'markup_fixed' 				=> $input['markup_fixed'],													
											'status'			        => "ACTIVE"				
										);	
										//echo "<pre/>";print_r($insert_markup_data)		;exit;
									$this->db->insert('markup_details',$insert_markup_data);									
							//	}								
							//}							
						/*}								
					}								
				}
			}
		}*/
	}
	
	public function update_markup($input,$markup_id){
		
		$update_data = array(
								'user_type_id' 				=> $input['user_type'],
								'domain_details_id' 		=> $input['domain'],
								'product_details_id' 		=> $input['product'],					
								'api_details_id' 			=> $input['api'],
								'user_details_id'			=> $input['agent_name'],		
								'markup_type' 				=> $input['markup_type'],		
								'country_id' 				=> $input['country'],				
								'airline_details_id' 		=> $input['airline'],													
								// 'markup_value' 				=> $input['markup_value'],													
								// 'markup_fixed' 				=> $input['markup_fixed'],
								'ip_address'				=> $_SERVER['REMOTE_ADDR'],
								'date'						=> date('Y-m-d H:i:s'),
								'previous_value_per'		=> $input['old_percentage_value'],
								'previous_value_fixed'		=> $input['old_fixed_value']								
										
							);	
		if($input['markup_value_type'] == 1){
			$update_data['markup_value'] = $input['markup_value'];
			$update_data['markup_fixed'] = '';
		}else{
			$update_data['markup_value'] = '';
			$update_data['markup_fixed'] = $input['markup_fixed'];
		}
		// debug($update_data);exit();
		$this->db->where('markup_details_id', $markup_id);
		$this->db->update('markup_details', $update_data);
	}
	function active_markup($markup_details_id){
		$data = array( 'status' => 'ACTIVE' );
		$this->db->where('markup_details_id', $markup_details_id);
		$this->db->update('markup_details', $data); 
	}
	
	function inactive_markup($markup_details_id){
		$data = array('status' => 'INACTIVE');
		$this->db->where('markup_details_id', $markup_details_id);
		$this->db->update('markup_details', $data); 
	}
	
	function delete_markup($markup_details_id){
		$this->db->where('markup_details_id', $markup_details_id);
		$this->db->delete('markup_details'); 
	}

	function getB2bUsers(){
		$this->db->select('user_details.user_id,user_details.user_name,user_details.user_email,user_details.sa_status');
		$this->db->from('user_details');
		$this->db->join('user_login_details','user_login_details.user_id = user_details.user_id');
        $this->db->where('user_details.status','ACTIVE');
		$this->db->where('user_login_details.user_type_id',1);

		return $this->db->get()->result();
	}
	public function get_dest_air_markup($post_data){

		$user_type = $post_data['user_type'];
		if($user_type=='1'){
			$agent_id=$post_data['agent_name'];
		}else{
			$agent_id='';
		}
		$domain=$post_data['domain'];
		$product_type = $post_data['product'];
		$api_id=$post_data['api'];
		$markup_type = $post_data['markup_type'];
		$airline=$post_data['airline'];
		$trip_type=$post_data['trip_type'];
		$from_loc=$post_data['from_city'];
		$to_loc=$post_data['to_city'];
		
		if($trip_type=='1'){
			$onward_class=$post_data['onward_class'];
			$return_class='';
		}else{
			$onward_class=$post_data['onward_class'];
			$return_class=$post_data['return_class'];
		}

		$this->db->select('*');
		$this->db->from('dest_air_markup');
		$this->db->where('user_type_id',$user_type);
		if($agent_id!=''){
			$this->db->where('user_details_id',$agent_id);
		}
		$this->db->where('domain_details_id',$domain);
		$this->db->where('product_details_id',$product_type);
		$this->db->where('api_details_id',$api_id);
		$this->db->where('markup_type',$markup_type);
		$this->db->where('airline_details_id',$airline);
		$this->db->where('trip_type',$trip_type);
		$this->db->where('from_loc',$from_loc);
		$this->db->where('to_loc',$to_loc);
		$this->db->where('onward_class',$onward_class);
		if($return_class!=''){
			$this->db->where('return_class',$return_class);
		}
		return $this->db->get()->result_array();
	}

	public function add_dest_air_markup($post_data){
		// debug($post_data);exit();
		$user_type = $post_data['user_type'];
		if($user_type=='1'){
			$agent_id=$post_data['agent_name'];
		}else{
			$agent_id='';
		}
		$domain=$post_data['domain'];
		$product_type = $post_data['product'];
		$api_id=$post_data['api'];
		$markup_type = $post_data['markup_type'];
		$airline=$post_data['airline'];
		$trip_type=$post_data['trip_type'];
		$from_loc=$post_data['from_city'];
		$to_loc=$post_data['to_city'];
		

		if($trip_type=='1'){
			$onward_class=$post_data['onward_class'];
			$return_class='';
		}else{
			$onward_class=$post_data['onward_class'];
			$return_class=$post_data['return_class'];
		}
		
		$insert_markup_data = array(
				'user_type_id' 				=> $user_type,
				'user_details_id'			=> $agent_id,	
				'domain_details_id' 		=> $domain,
				'product_details_id' 		=> $product_type,					
				'api_details_id' 			=> $api_id,			
				'markup_type' 				=> $markup_type,
				'airline_details_id' 		=> $airline,
				'trip_type'					=> $trip_type,
				'from_loc'					=> $from_loc,
				'to_loc'					=> $to_loc,
				'onward_class'				=> $onward_class,				
				'return_class'				=> $return_class,
				'markup_value' 				=> $post_data['markup_value'],
				'markup_fixed' 				=> $post_data['markup_fixed'],		
				'ip_address'				=> $_SERVER['REMOTE_ADDR'],
				'date'						=> date('Y-m-d H:i:s'),
				'status'			        => "ACTIVE"				
			);
		$this->db->insert('dest_air_markup',$insert_markup_data);							
	}
	public function update_dest_air_markup($input,$markup_id){
		$trip_type=$input['trip_type'];
		$from_loc=$input['from_city'];
		$to_loc=$input['to_city'];
		
		if($trip_type=='1'){
			$onward_class=$input['onward_class'];
			$return_class='';
		}else{
			$onward_class=$input['onward_class'];
			$return_class=$input['return_class'];
		}
		$update_data = array(
						'user_type_id' 				=> $input['user_type'],
						'user_details_id'			=> ($input['user_type']==1)?$input['agent_name']:0,
						'domain_details_id' 		=> $input['domain'],
						'product_details_id' 		=> $input['product'],					
						'api_details_id' 			=> $input['api'],
						'markup_type' 				=> $input['markup_type'],		
						'airline_details_id' 		=> $input['airline'],
						'trip_type'					=> $trip_type,
						'from_loc'					=> $from_loc,
						'to_loc'					=> $to_loc,				
						'onward_class'				=> $onward_class,				
						'return_class'				=> $return_class,				
						'ip_address'				=> $_SERVER['REMOTE_ADDR'],
						'date'						=> date('Y-m-d H:i:s'),								
						'status'			        => "ACTIVE"				
					);	
		if($input['markup_value_type'] == 1){
			$update_data['markup_value'] = $input['markup_value'];
			$update_data['markup_fixed'] = '';
		}else{
			$update_data['markup_value'] = '';
			$update_data['markup_fixed'] = $input['markup_fixed'];
		}
		$this->db->where('markup_details_id', $markup_id);
		$this->db->update('dest_air_markup', $update_data);
	}
	function get_list_dest_air_markup($markup_details_id = ''){		 
		$this->db->select('m.*, d.domain_name,a.api_name,a.api_alternative_name,a.api_credential_type,ad.airline_name,p.product_name,ut.user_type_name,c.country_name,c.iso3_code');
		$this->db->from('dest_air_markup m');
		$this->db->join('domain_details d', 'd.domain_details_id = m.domain_details_id');
		$this->db->join('api_details a', 'a.api_details_id = m.api_details_id');
		$this->db->join('product_details p', 'p.product_details_id = m.product_details_id');
		$this->db->join('airline_list ad', 'ad.airline_code = m.airline_details_id','left');
		$this->db->join('user_type ut', 'ut.user_type_id = m.user_type_id');
		$this->db->join('country_details c', 'c.country_id = m.country_id','left');
		if($markup_details_id !='')
			$this->db->where('markup_details_id', $markup_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

	function active_dest_air_markup($markup_details_id){
		$data = array( 'status' => 'ACTIVE' );
		$this->db->where('markup_details_id', $markup_details_id);
		$this->db->update('dest_air_markup', $data); 
	}
	
	function inactive_dest_air_markup($markup_details_id){
		$data = array('status' => 'INACTIVE');
		$this->db->where('markup_details_id', $markup_details_id);
		$this->db->update('dest_air_markup', $data); 
	}
	
	function delete_dest_air_markup($markup_details_id){
		$this->db->where('markup_details_id', $markup_details_id);
		$this->db->delete('dest_air_markup'); 
	}
	function get_agent_name($id){
		$this->db->select('*');
		$this->db->from('user_details');
		$this->db->where('user_id',$id);
		return $this->db->get()->result();
	}
	function get_list_air_coun_markup($markup_details_id = ''){		 
		$this->db->select('m.*, d.domain_name,a.api_name,a.api_alternative_name,a.api_credential_type,ad.airline_name,p.product_name,ut.user_type_name,c.country_name,c.iso3_code');
		$this->db->from('air_coun_markup m');
		$this->db->join('domain_details d', 'd.domain_details_id = m.domain_details_id');
		$this->db->join('api_details a', 'a.api_details_id = m.api_details_id');
		$this->db->join('product_details p', 'p.product_details_id = m.product_details_id');
		$this->db->join('airline_list ad', 'ad.airline_code = m.airline_details_id','left');
		$this->db->join('user_type ut', 'ut.user_type_id = m.user_type_id');
		$this->db->join('country_details c', 'c.country_id = m.country_id','left');
		if($markup_details_id !='')
			$this->db->where('markup_details_id', $markup_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	public function add_air_coun_markup($post_data){
		$user_type = $post_data['user_type'];
		if($user_type=='1'){
			$agent_id=$post_data['agent_name'];
		}else{
			$agent_id='';
		}
		$domain=$post_data['domain'];
		$product_type = $post_data['product'];
		$api_id=$post_data['api'];
		$markup_type = $post_data['markup_type'];
		$airline=$post_data['airline'];
		$country=$post_data['country'];
		
		
		$insert_markup_data = array(
				'user_type_id' 				=> $user_type,
				'user_details_id'			=> $agent_id,	
				'domain_details_id' 		=> $domain,
				'product_details_id' 		=> $product_type,					
				'api_details_id' 			=> $api_id,			
				'markup_type' 				=> $markup_type,
				'airline_details_id' 		=> $airline,
				'country_id' 				=> $country,
				'markup_value' 				=> $post_data['markup_value'],
				'markup_fixed' 				=> $post_data['markup_fixed'],		
				'ip_address'				=> $_SERVER['REMOTE_ADDR'],
				'date'						=> date('Y-m-d H:i:s'),				
			);
		$this->db->insert('air_coun_markup',$insert_markup_data);							
	}
	public function get_air_coun_markup($post_data){

		$user_type = $post_data['user_type'];
		if($user_type=='1'){
			$agent_id=$post_data['agent_name'];
		}else{
			$agent_id='';
		}
		$domain=$post_data['domain'];
		$product_type = $post_data['product'];
		$api_id=$post_data['api'];
		$markup_type = $post_data['markup_type'];
		$airline=$post_data['airline'];
		$country=$post_data['country'];
		
		$this->db->select('*');
		$this->db->from('air_coun_markup');
		$this->db->where('user_type_id',$user_type);
		if($agent_id!=''){
			$this->db->where('user_details_id',$agent_id);
		}
		$this->db->where('domain_details_id',$domain);
		$this->db->where('product_details_id',$product_type);
		$this->db->where('api_details_id',$api_id);
		$this->db->where('markup_type',$markup_type);
		$this->db->where('airline_details_id',$airline);
		$this->db->where('country_id',$country);
		
		return $this->db->get()->result_array();
	}
	public function update_air_coun_markup($input,$markup_id){
		
		$update_data = array(
						'user_type_id' 				=> $input['user_type'],
						'user_details_id'			=> ($input['user_type']==1)?$input['agent_name']:0,
						'domain_details_id' 		=> $input['domain'],
						'product_details_id' 		=> $input['product'],					
						'api_details_id' 			=> $input['api'],
						'markup_type' 				=> $input['markup_type'],		
						'airline_details_id' 		=> $input['airline'],				
						'country_id'				=> $input['country'],				
						'ip_address'				=> $_SERVER['REMOTE_ADDR'],
						'date'						=> date('Y-m-d H:i:s'),						
					);	
		if($input['markup_value_type'] == 1){
			$update_data['markup_value'] = $input['markup_value'];
			$update_data['markup_fixed'] = '';
		}else{
			$update_data['markup_value'] = '';
			$update_data['markup_fixed'] = $input['markup_fixed'];
		}
		$this->db->where('markup_details_id', $markup_id);
		$this->db->update('air_coun_markup', $update_data);
	}
	function active_air_coun_markup($markup_details_id){
		$data = array( 'status' => 'ACTIVE' );
		$this->db->where('markup_details_id', $markup_details_id);
		$this->db->update('air_coun_markup', $data); 
	}
	
	function inactive_air_coun_markup($markup_details_id){
		$data = array('status' => 'INACTIVE');
		$this->db->where('markup_details_id', $markup_details_id);
		$this->db->update('air_coun_markup', $data); 
	}
	
	function delete_air_coun_markup($markup_details_id){
		$this->db->where('markup_details_id', $markup_details_id);
		$this->db->delete('air_coun_markup'); 
	}








	public function get_air_coun_dest_markup($post_data){

		$user_type = $post_data['user_type'];
		if($user_type== 1){
			$agent_id=$post_data['agent_name'];
		}else{
			$agent_id='';
		}
		$domain=$post_data['domain'];
		$product_type = $post_data['product'];
		$api_id=$post_data['api'];
		$markup_type = $post_data['markup_type'];
		$airline=$post_data['airline'];
		$trip_type=$post_data['trip_type'];
		$from_loc=$post_data['from_city'];
		$to_loc=$post_data['to_city'];
		$country=$post_data['country'];
		if($trip_type=='1'){
			$onward_class=$post_data['onward_class'];
			$return_class='';
		}else{
			$onward_class=$post_data['onward_class'];
			$return_class=$post_data['return_class'];
		}

		$this->db->select('*');
		$this->db->from('air_coun_dest_markup');
		$this->db->where('user_type_id',$user_type);
		if($agent_id!=''){
			$this->db->where('user_details_id',$agent_id);
		}
		$this->db->where('domain_details_id',$domain);
		$this->db->where('product_details_id',$product_type);
		$this->db->where('api_details_id',$api_id);
		$this->db->where('markup_type',$markup_type);
		$this->db->where('airline_details_id',$airline);
		$this->db->where('trip_type',$trip_type);
		$this->db->where('from_loc',$from_loc);
		$this->db->where('to_loc',$to_loc);
		$this->db->where('onward_class',$onward_class);
		$this->db->where('country_id',$country);
		if($return_class!=''){
			$this->db->where('return_class',$return_class);
		}
		return $this->db->get()->result_array();
	}
	public function add_air_coun_dest_markup($post_data){
		$user_type = $post_data['user_type'];
		if($user_type== 1){
			$agent_id=$post_data['agent_name'];
		}else{
			$agent_id='';
		}
		$domain=$post_data['domain'];
		$product_type = $post_data['product'];
		$api_id=$post_data['api'];
		$markup_type = $post_data['markup_type'];
		$airline=$post_data['airline'];
		$trip_type=$post_data['trip_type'];
		$from_loc=$post_data['from_city'];
		$to_loc=$post_data['to_city'];
		$country=$post_data['country'];

		if($trip_type=='1'){
			$onward_class=$post_data['onward_class'];
			$return_class='';
		}else{
			$onward_class=$post_data['onward_class'];
			$return_class=$post_data['return_class'];
		}
		
		$insert_markup_data = array(
				'user_type_id' 				=> $user_type,
				'user_details_id'			=> $agent_id,	
				//'domain_details_id' 		=> $domain,
				'product_details_id' 		=> $product_type,					
				'api_details_id' 			=> $api_id,			
				'markup_type' 				=> $markup_type,
				'airline_details_id' 		=> $airline,
				'trip_type'					=> $trip_type,
				'from_loc'					=> $from_loc,
				'to_loc'					=> $to_loc,
				'onward_class'				=> $onward_class,				
				'return_class'				=> $return_class,
				'country_id'				=> $country,
				'markup_value' 				=> $post_data['markup_value'],
				'markup_fixed' 				=> $post_data['markup_fixed'],		
				'ip_address'				=> $_SERVER['REMOTE_ADDR'],
				'date'						=> date('Y-m-d H:i:s'),
				'status'			        => "ACTIVE"				
			);
		//	echo "<pre>"; print_r($insert_markup_data);exit;
		$this->db->insert('air_coun_dest_markup',$insert_markup_data);							
	}
	public function update_air_coun_dest_markup($input,$markup_id){
		$trip_type=$input['trip_type'];
		$from_loc=$input['from_city'];
		$to_loc=$input['to_city'];
		
		if($trip_type=='1'){
			$onward_class=$input['onward_class'];
			$return_class='';
		}else{
			$onward_class=$input['onward_class'];
			$return_class=$input['return_class'];
		}
		$update_data = array(
						'user_type_id' 				=> $input['user_type'],
						'user_details_id'			=> $input['agent_name'],
						'domain_details_id' 		=> $input['domain'],
						'product_details_id' 		=> $input['product'],					
						'api_details_id' 			=> $input['api'],
						'markup_type' 				=> $input['markup_type'],		
						'airline_details_id' 		=> $input['airline'],
						'trip_type'					=> $trip_type,
						'from_loc'					=> $from_loc,
						'to_loc'					=> $to_loc,				
						'onward_class'				=> $onward_class,				
						'return_class'				=> $return_class,
						'country_id'				=> $input['country'],				
						'ip_address'				=> $_SERVER['REMOTE_ADDR'],
						'date'						=> date('Y-m-d H:i:s'),								
						'status'			        => "ACTIVE"				
					);	
		if($input['markup_value_type'] == 1){
			$update_data['markup_value'] = $input['markup_value'];
			$update_data['markup_fixed'] = '';
		}else{
			$update_data['markup_value'] = '';
			$update_data['markup_fixed'] = $input['markup_fixed'];
		}
		$this->db->where('markup_details_id', $markup_id);
		$this->db->update('air_coun_dest_markup', $update_data);
	}
	function get_list_air_coun_dest_markup($markup_details_id = ''){	
	  //$this->db->select('m.*, d.domain_name,a.api_name,a.api_alternative_name,a.api_credential_type,ad.airline_name,p.product_name,ut.user_type_name,c.country_name,c.iso3_code');
		$this->db->select('m.*,a.api_name,a.api_alternative_name,a.api_credential_type,ad.airline_name,p.product_name,ut.user_type_name,c.country_name,c.iso3_code');
		$this->db->from('air_coun_dest_markup m');
	//	$this->db->join('domain_details d', 'd.domain_details_id = m.domain_details_id');
		$this->db->join('api_details a', 'a.api_details_id = m.api_details_id');
		$this->db->join('product_details p', 'p.product_details_id = m.product_details_id');
		$this->db->join('airline_list ad', 'ad.airline_code = m.airline_details_id','left');
		$this->db->join('user_type ut', 'ut.user_type_id = m.user_type_id');
		$this->db->join('country_details c', 'c.country_id = m.country_id','left');
		if($markup_details_id !='')
			$this->db->where('markup_details_id', $markup_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	function active_air_coun_dest_markup($markup_details_id){
		$data = array( 'status' => 'ACTIVE' );
		$this->db->where('markup_details_id', $markup_details_id);
		$this->db->update('air_coun_dest_markup', $data); 
	}
	
	function inactive_air_coun_dest_markup($markup_details_id){
		$data = array('status' => 'INACTIVE');
		$this->db->where('markup_details_id', $markup_details_id);
		$this->db->update('air_coun_dest_markup', $data); 
	}
	
	function delete_air_coun_dest_markup($markup_details_id){
		$this->db->where('markup_details_id', $markup_details_id);
		$this->db->delete('air_coun_dest_markup'); 
	}

	function get_list_amt_range_markup($markup_details_id = ''){		 
		$this->db->select('m.*, d.domain_name,a.api_name,a.api_alternative_name,a.api_credential_type,ad.airline_name,p.product_name,ut.user_type_name,c.country_name,c.iso3_code');
		$this->db->from('amount_range_markup m');
		$this->db->join('domain_details d', 'd.domain_details_id = m.domain_details_id');
		$this->db->join('api_details a', 'a.api_details_id = m.api_details_id');
		$this->db->join('product_details p', 'p.product_details_id = m.product_details_id');
		$this->db->join('airline_list ad', 'ad.airline_code = m.airline_details_id','left');
		$this->db->join('user_type ut', 'ut.user_type_id = m.user_type_id');
		$this->db->join('country_details c', 'c.country_id = m.country_id','left');
		if($markup_details_id !='')
			$this->db->where('markup_details_id', $markup_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	public function get_amt_range_markup($post_data){

		$user_type = $post_data['user_type'];
		if($user_type=='3'){
			$agent_id=$post_data['agent_name'];
		}else{
			$agent_id='';
		}
		$domain=$post_data['domain'];
		$product_type = $post_data['product'];
		$api_id=$post_data['api'];
		$markup_type = $post_data['markup_type'];

		$this->db->select('*');
		$this->db->from('amount_range_markup');
		$this->db->where('user_type_id',$user_type);
		if($agent_id!=''){
			$this->db->where('user_details_id',$agent_id);
		}
		$this->db->where('domain_details_id',$domain);
		$this->db->where('product_details_id',$product_type);
		$this->db->where('api_details_id',$api_id);
		$this->db->where('markup_type',$markup_type);
		return $this->db->get()->result_array();
	}
	public function update_amt_range_markup($input,$markup_id){
		
		$update_data = array(
						'user_type_id' 				=> $input['user_type'],
						'user_details_id'			=> $input['agent_name'],
						'domain_details_id' 		=> $input['domain'],
						'product_details_id' 		=> $input['product'],					
						'api_details_id' 			=> $input['api'],
						'markup_type' 				=> $input['markup_type'],						
						'amt_from' 					=> $input['amt_from'],						
						'amt_to' 					=> $input['amt_to'],						
						'ip_address'				=> $_SERVER['REMOTE_ADDR'],
						'date'						=> date('Y-m-d H:i:s'),								
						'status'			        => "ACTIVE"				
					);	
		if($input['markup_value_type'] == 1){
			$update_data['markup_value'] = $input['markup_value'];
			$update_data['markup_fixed'] = '';
		}else{
			$update_data['markup_value'] = '';
			$update_data['markup_fixed'] = $input['markup_fixed'];
		}
		$this->db->where('markup_details_id', $markup_id);
		$this->db->update('amount_range_markup', $update_data);
	}
	public function add_amt_range_markup($post_data){
		$user_type = $post_data['user_type'];
		if($user_type=='3'){
			$agent_id=$post_data['agent_name'];
		}else{
			$agent_id='';
		}
		$domain=$post_data['domain'];
		$product_type = $post_data['product'];
		$api_id=$post_data['api'];
		$markup_type = $post_data['markup_type'];
		
		$insert_markup_data = array(
				'user_type_id' 				=> $user_type,
				'user_details_id'			=> $agent_id,	
				'domain_details_id' 		=> $domain,
				'product_details_id' 		=> $product_type,					
				'api_details_id' 			=> $api_id,			
				'markup_type' 				=> $markup_type,						
				'amt_from' 					=> $post_data['amt_from'],						
				'amt_to' 					=> $post_data['amt_to'],
				'markup_value' 				=> $post_data['markup_value'],
				'markup_fixed' 				=> $post_data['markup_fixed'],		
				'ip_address'				=> $_SERVER['REMOTE_ADDR'],
				'date'						=> date('Y-m-d H:i:s'),
				'status'			        => "ACTIVE"				
			);
		$this->db->insert('amount_range_markup',$insert_markup_data);							
	}
	function active_amt_range_markup($markup_details_id){
		$data = array( 'status' => 'ACTIVE' );
		$this->db->where('markup_details_id', $markup_details_id);
		$this->db->update('amount_range_markup', $data); 
	}
	
	function inactive_amt_range_markup($markup_details_id){
		$data = array('status' => 'INACTIVE');
		$this->db->where('markup_details_id', $markup_details_id);
		$this->db->update('amount_range_markup', $data); 
	}
	
	function delete_amt_range_markup($markup_details_id){
		$this->db->where('markup_details_id', $markup_details_id);
		$this->db->delete('amount_range_markup'); 
	}
	
	
	
// 	public function get_bulkDataNameby($query){
// 		$raw_search_chars = '"'.$query.'"';
// 		$sql = 'select * from city_code_amadeus where `city` like "%'.$query.'%" OR`city_code` like "%'.$query.'%" OR `country` like "%'.$query.'%" LIMIT 0, 10';
// 		$result_from = $this->db->query($sql);
// 		return  $result_from->result();
// 	}
	

	

}
?>
