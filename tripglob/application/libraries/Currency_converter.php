<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*
Alessandro Minoccheri
V 1.0.0
09-04-2014

https://github.com/AlessandroMinoccheri

*/

class Currency_converter{
    public function __construct()
    {
        
    }   
    
    function test()
   {
       exit('testing');
   }

    function convert($from_currency,$to_currency,$amount)
   {
       //echo $from_currency;
      //echo $to_currency;
      // echo $amount;
   		// convert the base amount of $from_currency american dollar which is the base currency of convertion metrics
   		if($from_currency==$to_currency){
   			$final_price=$amount;
   			
		} else {
			   $CI =& get_instance();
		   			// if($to_currency!='USD')
			   		// {
			   		  	$CI->db->select('value');
				        $CI->db->from('currency_list');
				        $CI->db->where('currency_code', $from_currency);
				        $query = $CI->db->get();
						$from_currency_baseprice = $query->row()->value;

						if($from_currency_baseprice != 0)
						{
						$base_price_to_USD = $amount/$from_currency_baseprice; 
						}
						else
						{
						    $base_price_to_USD = $amount;
						}
						
						$CI =& get_instance();
				   		$CI->db->select('value');
				        $CI->db->from('currency_list');
				        $CI->db->where('currency_code', $to_currency);
				        $query = $CI->db->get();
						$to_currency_baseprice = $query->row()->value;
						
						$final_price = $base_price_to_USD * $to_currency_baseprice;
						$final_price=number_format((double)$final_price, 2, '.', '');
			   // 		} else if($to_currency=='USD'){
			   // 			$CI->db->select('*');
				  //       $CI->db->from('currency_list');
				  //       $CI->db->where('currency_code', $to_currency);
				  //       $query = $CI->db->get();
						
						// $from_currency_baseprice = $query->row()->value;
						// debug($query->row());exit();
						
						// //$final_price = $from_currency_baseprice * $amount;
						// $final_price = $amount/$from_currency_baseprice;
						// $final_price=number_format((double)$final_price, 2, '.', '');
			   // 		}	
					
   		}
   		
   		//return $to_currency;exit;
		return($final_price);
   }
   
    
}

?>