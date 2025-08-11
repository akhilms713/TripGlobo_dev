<?php
class Specialtrip_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }   
	
	

   	public function addSpecialTrip($postData){

            $this->db->insert('special_flight_trip',$postData);
     }
    
    public function get_specialFlight_list()
    {
    	//$query = "select * from special_flight_trip join airline_list on  airline_list.airline_list_id=special_flight_trip.airline_id";
        $query = "SELECT * FROM special_flight_trip as st LEFT JOIN airline_list as al on JSON_CONTAINS(st.airline_id, CAST(al.airline_list_id as JSON), '$')";
    	return $this->db->query($query)->result_array();
    }

	public function delSecialTrip($id)
	{
	 $this->db->where('flight_trip_id', $id);
		$this->db->delete('special_flight_trip'); 
	
	}
	
	public function updateStatusSecialTrip($val,$id)
	{
	  	$data = array('status_new' => $val);
		$this->db->where('flight_trip_id', $id);
		$this->db->update('special_flight_trip', $data); 
	    
	}
	 public function addHotelTrip($postData)
     {
         $this->db->insert('hotel_trip',$postData);
     }
     public function getallHotelTrip()
{
		$this->db->select('*');
		$this->db->from('hotel_trip');
		return $this->db->get()->result_array();
}
public function delHotelTrip($id)
{
     $this->db->where('hotel_trip_id', $id);
	 $this->db->delete('hotel_trip'); 
}

public function updateStatusHotelTrip($val,$id)
	{
	  	$data = array('hotel_status' => $val);
		$this->db->where('hotel_trip_id', $id);
		$this->db->update('hotel_trip', $data); 
	    
	}
	
 public function addBusTrip($postData)
     {
         $this->db->insert('bus_trip',$postData);
     }
	
public function getallBusTrip()
{
       	$this->db->select('*');
		$this->db->from('bus_trip');
		return $this->db->get()->result_array();
}

	public function delBusTrip($id)
	{
	    $this->db->where('bus_trip_id', $id);
		$this->db->delete('bus_trip'); 
	
	}
	
	public function updateStatusBusTrip($val,$id)
	{
	  	$data = array('status_new' => $val);
		$this->db->where('bus_trip_id', $id);
		$this->db->update('bus_trip', $data); 
	    
	}
	
	public function updateBusTrip($id)
	{
	    $this->db->select('*');
		$this->db->from('bus_trip');
		$this->db->where('bus_trip_id',$id);
		$query= $this->db->get(); 
		if ( $query->num_rows > 0 ) 
		{
			
			return $query->row();
	    }
		else
		{
			
			return '';
		}
	}

	public function updateHotelTrip($id)
	{
	    $this->db->select('*');
		$this->db->from('hotel_trip');
		$this->db->where('hotel_trip_id',$id);
		$query= $this->db->get(); 
		if ( $query->num_rows > 0 ) 
		{
			
			return $query->row();
	    }
		else
		{
			
			return '';
		}
	}
	public function updateBusTripDetails($tripid,$postdata)
	{
	    $this->db->where('bus_trip_id',$tripid);
	    $this->db->update('bus_trip',$postdata);
	}
	public function updateHotelTripDetails($tripid,$postdata)
	{
	    $this->db->where('hotel_trip_id',$tripid);
	    $this->db->update('hotel_trip',$postdata);
	}
	
	public function getFlightTrip($id)
	{
	     $this->db->select('*');
		$this->db->from('special_flight_trip');
		$this->db->where('flight_trip_id',$id);
		$query= $this->db->get(); 
		if ( $query->num_rows > 0 ) 
		{
			
			return $query->row();
	    }
		else
		{
			
			return '';
		}
	}
public function update_flightTrip($ftripid,$postData)
{
     $this->db->where('flight_trip_id',$ftripid);
	 	if ($this->db->update('special_flight_trip',$postData)) {
			return true;
		} else {
			return false;
		}
}

public function getflighttripRequest()
{
    	$query = "select * from b2c_special_flight_trip join special_flight_trip on  special_flight_trip.flight_trip_id=b2c_special_flight_trip.flight_trip_ids";
      	return $this->db->query($query)->result_array();
//   $this->db->select('*');
// 		$this->db->from('b2c_special_flight_trip');
// 		$query= $this->db->get(); 
// 		if ( $query->num_rows > 0 ) 
// 		{
			
// 			return $query->result_array();
// 	    }
// 		else
// 		{
			
// 			return '';
// 		}  
}

public function userReq_status_update($val,$id)
{
		$data = array('status' => $val);
		$this->db->where('special_trip_id', $id);
		$this->db->update('b2c_special_flight_trip', $data); 
}
	
public function getbustripRequest()
{
  $this->db->select('*');
		$this->db->from('b2c_special_bus_trip');
		$query= $this->db->get(); 
		if ( $query->num_rows > 0 ) 
		{
			
			return $query->result_array();
	    }
		else
		{
			
			return '';
		}  
}
public function gethoteltripRequest()
{
  $this->db->select('*');
		$this->db->from('b2c_special_hotel_trip');
		$query= $this->db->get(); 
		if ( $query->num_rows > 0 ) 
		{
			
			return $query->result_array();
	    }
		else
		{
			
			return '';
		}  
}

public function b2c_userReq_status_update($val,$id)
{
    	$data = array('status' => $val);
		$this->db->where('special_bus_id', $id);
		$this->db->update('b2c_special_bus_trip', $data); 
}
public function b2c_userReq_status_update_hotel($val,$id)
{
	
    	$data = array('status' => $val);
		$this->db->where('special_trip_id', $id);
		$this->db->update('b2c_special_hotel_trip', $data); 
}
	
}
?>
