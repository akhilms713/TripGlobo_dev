<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Orders extends CI_Controller {
	public function __construct(){
	 
		parent::__construct();
		//$this->check_isvalidated();
		$this->load->model('admin_model');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
      	$this->output->set_header("Pragma: no-cache");
	    $this->load->library('form_validation');
		$this->load->model('user_model');
	    $this->load->model('order_model');
	      $this->load->model('email_model');
	}
	private function check_isvalidated()
	{
		if(!$this->session->userdata('admin_logged_in') || $this->session->userdata('admin_id')!= ADMIN_ID )
		{
			if ($this->session->userdata('admin_logged_in')) {
		 	$controller_name = $this->router->fetch_class();
			 $function_name = $this->router->fetch_method();
             $this->load->model('Privilege_Model');
            $sub_admin_id = $this->session->userdata('admin_id');
           
           if(!$this->Privilege_Model->get_privileges_by_sub_admin_id($sub_admin_id,$controller_name,$function_name))
		   {			
    	 	  	access_denied('error');
			}
			
       	 }
		}
		
    }
	function transfer_crs_orders()
	{
		$module = '';
		$api_id = 16;
		$data['module'] = 'transfer_crs_orders';
		$data['type'] = 'CRS';
		$data['orders'] = $this->order_model->get_crs_orders($module,'',$api_id);
        $this->load->view('orders/view', $data); 
	} 
	function b2b_orders()
	{
		
	  		$user_mode= 'B2B';
		$user_type_id = $this->general_model->get_user_type($user_mode);
		$data['page_usermode'] = 'B2B';
		$data['orders'] = $this->order_model->get_all_oders($user_type_id);
        $this->load->view('orders/view', $data); 
	} 
	function user_bookings($user_type_id,$user_id)
	{
		
	  	$data['orders'] = $this->order_model->get_all_oders($user_type_id,$user_id);
        $this->load->view('orders/view', $data); 
	} 
	function b2c_orders()
	{
		
	  	$user_mode= 'B2C';
		$user_type_id = $this->general_model->get_user_type($user_mode);
		$data['page_usermode'] = 'B2C';
		$data['orders'] = $this->order_model->get_all_oders($user_type_id);
        $this->load->view('orders/view', $data); 
	} 
	function invoice($pnr_no)
	{
		$data['orders'] = $this->order_model->get_order_details($pnr_no);
		// echo "<pre>"; print_r($data); 
		if($data['orders']!='')
		{
		//	echo "cjksgbk";
		$data['accounts'] = $this->order_model->get_transaction_details($data['orders']->booking_global_id);
		$data['passanger'] = $this->order_model->get_passanger_details($data['orders']->booking_global_id);
		$data['user_info'] = $this->user_model->get_user_details($data['orders']->user_id);
		if($data['orders']->product_name == 'FLIGHT')
		{
			$flight_data = $this->order_model->get_flight_booking_details($data['orders']->referal_id);
			$data['product'] = $data['orders']->product_name;
			$data['product_desc'] = $flight_data->mode.' | '. $flight_data->origin.' -> '.$flight_data->destination ;
			$data['passanger_info'] =  count($data['passanger']);
			$data['total'] =  $data['orders']->amount;
			 
			
		}
      //   print_r($data);exit;
		if($data['accounts']!='')
		{
			$this->load->view('orders/invoice', $data); 
		}
		else
		{
					redirect(WEB_URL,'refresh'); 
		}
}
else
{
		 	redirect(WEB_URL,'refresh'); 
}
		
	}
	
	function voucher($pnr_no)
	{
		$data['orders'] = $this->order_model->get_order_details($pnr_no);
		//echo "<pre>";print_r($data['orders']);
		if($data['orders']!='')
		{
			$data['accounts'] = $this->order_model->get_transaction_details($data['orders']->booking_global_id);
			$data['passanger'] = $this->order_model->get_passanger_details($data['orders']->booking_global_id);
			$data['user_info'] = $this->user_model->get_user_details($data['orders']->user_id);		
			if($data['orders']->product_name == 'FLIGHT')
			{
				$data['flight_data'] = $this->order_model->get_flight_booking_details($data['orders']->referal_id);
			}
			if($data['orders']->product_name == 'HOTEL'){
				
				$data['hotel_data'] = $this->order_model->get_hotel_booking_details($data['orders']->referal_id);
			}
			//	echo"<pre/>";print_r($data); exit;

			$this->load->view('orders/voucher', $data);
		}
		else
		{
					redirect(WEB_URL,'refresh'); 
		}
		
	}

function download_pdf_voucher($pnr_no)
{
	 $data['orders'] = $this->order_model->get_order_details($pnr_no);
		if($data['orders']!='')
		{
			$data['passanger'] = $this->order_model->get_passanger_details($data['orders']->booking_global_id);
			if($data['orders']->product_name == 'FLIGHT')
			{
				$data['flight_data'] = $this->order_model->get_flight_booking_details($data['orders']->referal_id);
			}
			if($data['orders']->product_name == 'HOTEL'){
				
				$data['hotel_data'] = $this->order_model->get_hotel_booking_details($data['orders']->referal_id);
			}
			 $this->load->library('m_pdf');
			 $html = $this->load->view('orders/voucher-pdf', $data, true);
			 $pdfFilePath = $data['orders']->leadpax . "-voucher.pdf"; 
			 $this->m_pdf->pdf->WriteHTML($html);
             $this->m_pdf->pdf->Output($pdfFilePath, "D");  

		}
		else
		{
			redirect(WEB_URL,'refresh'); 
		}

}


	function track_b2b_orders($msg='')
	{
		$user_mode= 'B2B';
		$data['user_type_id'] = $this->general_model->get_user_type($user_mode);
		$data['msg'] = $msg;
		$this->load->view('orders/track_booking',$data); 
	}
 function track_b2c_orders($msg='')
	{
		$user_mode= 'B2C';
		$data['user_type_id'] = $this->general_model->get_user_type($user_mode);
		$data['msg'] = $msg;
		$this->load->view('orders/track_booking',$data); 
	}
	function view_bookings($pnr_no='')
	{
		$user_type_id='';
		if(isset($_POST['pnr_no']) && $_POST['pnr_no']!='')
		{
			$pnr_no =$_POST['pnr_no'];
			$user_type_id =$_POST['user_type_id'];
			
		}
		 

		 
			$data['orders'] = $this->order_model->get_order_details($pnr_no,$user_type_id);
			//echo '<pre/>';
			//print_r($data['orders']);exit;
			if($data['orders']!='')
			{
			$data['passanger'] = $this->order_model->get_passanger_details($data['orders']->booking_global_id);
			$data['transactions'] = $this->order_model->get_transaction_details_all($data['orders']->booking_transaction_id);
			// check the promo code is there are not
			
			if($data['transactions']->promo_id>0){
				
			$data['promo_info'] = $this->order_model->get_promo_info($data['transactions']->promo_id);

				
			}
		
			if($data['orders']->product_name == 'FLIGHT')
			{
				$data['flight_data'] = $this->order_model->get_flight_booking_details($data['orders']->referal_id);
			}
			if($data['orders']->product_name == 'HOTEL'){
				
				$data['hotel_data'] = $this->order_model->get_hotel_booking_details($data['orders']->referal_id);
			}
				//echo '<pre/>';
			//print_r($data);exit;
			$this->load->view('orders/view_bookings', $data); 
			}
			else
			{
				$datamsg = 'BNSUIDS';
				 redirect(WEB_URL.'orders/track_b2b_orders/'.$datamsg,'refresh'); 
			}
	
	} 

	public function mail($pnr_no=''){	
	 $count = $this->order_model->getBookingPnr($pnr_no)->num_rows();
        if($count == 1){
            $b_data = $this->order_model->getBookingPnr($pnr_no)->row();
            if($b_data->product_name == 'FLIGHT'){
				$data['b_data'] = $this->order_model->getBookingPnr($pnr_no)->row();     
				$booking_global_id=$b_data->booking_global_id;
				$billing_address_id=$b_data->billing_address_id;
				$data['Passenger'] = $passenger = $this->order_model->getPassengerbyid($booking_global_id)->result();
				$data['booking_agent'] = $passenger = $this->order_model->getagentbyid($billing_address_id)->result();
				$data['message'] = $this->load->view('mail/mail_voucher',$data,TRUE);
				$data['to'] = $data['booking_agent'][0]->billing_email;               
				$data['booking_status'] = $b_data->booking_status;
				$data['pnr_no'] = $pnr_no;
				$data['email_access'] = $this->email_model->get_email_acess()->row();
				$email_type = 'FLIGHT_BOOKING_VOUCHER';
                $Response = $this->email_model->sendmail_flightVoucher($data);
                $response = array('status' => 1);
                echo json_encode($response);
            }
            else if($b_data->product_name == 'HOTEL'){
				$data['b_data'] = $this->order_model->getBookingPnr($pnr_no)->row();     
				$booking_global_id=$b_data->booking_global_id;
				$billing_address_id=$b_data->billing_address_id;
				$data['Passenger'] = $passenger = $this->order_model->getPassengerbyid($booking_global_id)->result();
				$data['booking_agent'] = $passenger = $this->order_model->getagentbyid($billing_address_id)->result();
				$data['booking_info'] = $bookinginfo = $this->order_model->getBookingbyPnr($pnr_no,$b_data->product_name)->row();
				$data['cartinfo']	= $cart = $this->order_model->getBookingTemphotel($bookinginfo->shopping_cart_hotel_id);
				$data['message'] = $this->load->view('mail/hotel_mail_voucher', $data,TRUE);
				$data['to'] = $data['booking_agent'][0]->billing_email;               
				$data['booking_status'] = $b_data->booking_status;
				$data['pnr_no'] = $pnr_no;
				$data['email_access'] = $this->email_model->get_email_acess()->row();
				$email_type = 'HOTEL_BOOKING_VOUCHER';
                $Response = $this->email_model->sendmail_flightVoucher($data);
                $response = array('status' => 1);
                echo json_encode($response);
            } 
        }else{
            $response = array('status' => 0);
            echo json_encode($response);
        }
    }

    public function cancelled_orders(){
    	$data['result'] = $this->order_model->cancel_bookings();
    	
    	$this->load->view('orders/cancel_reports',$data);

    }
}

?>
