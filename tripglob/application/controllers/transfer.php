<?php

ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
error_reporting(0);

class Transfer extends CI_Controller {
            public function __construct() {
        parent::__construct();
        $current_url = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
        $current_url = WEB_URL . $this->uri->uri_string() . $current_url;
        $url = array('continue' => $current_url);
        $this->perPage = 100000;
        $this->session->set_userdata($url);
        $this->load->model('Home_Model');
        $this->load->model('Transfer_Model');
        $this->load->model('cart_model');
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->model('booking_model'); 
        $this->load->helper('flight/tbo_helper'); 
        $this->load->library('Transfer_api');
        $this->curr_val = 1;
    }



public function search(){ 

     ignore_user_abort(true);
    set_time_limit(0);

    if(!isset($_GET['from']) && !isset($_GET['to'])){ 
                // redirect(WEB_URL.'home#buses','refresh');
        return base_url();
            } 
        $data =array();
        $data = $this->input->get(); 
        // debug($data); die;
        $insert_data['search_data'] = json_encode($data);
        $insert_data['search_type'] = 'Transfer';  

        $search_insert_data = $this->custom_db->insert_record('search_history',$insert_data);
        $data['search_id'] = $search_insert_data['insert_id'];
        $data['transfer_search_params'] = $data;  
            // $this->load->view(PROJECT_THEME.'/transfer/search_result_page', $data);   
         $data['transfer_country_list'] =   $this->Home_Model->transfer_country_list(); 

        $get_search_data = $this->Home_Model->get_search_data($data['search_id']); 
        $srch_data = json_decode($get_search_data[0]['search_data'],true);
        $data['srch_data'] = $srch_data;  
        $get_country_data = $this->Home_Model->get_country_data($srch_data['country']); 
        $data['get_country_data'] = $get_country_data;  
        $query = $this->db->query('select * from preferredlanguage'); 
        $langauge =  $query->result();
        $data['PreferredLanguage']  =   $langauge;  
        $get_api_resp=$this->get_api_resp($data['search_id']); 

        // debug($get_api_resp); die;
        $data['raw_transfer_list']  =   $get_api_resp; 
        $dataaa['search_id']  =   $data['search_id']; 
        $dataaa['response']  =   json_encode($data['raw_transfer_list']);
        $searcdatah_insert_data = $this->Transfer_Model->insert_transfer_search_logs($dataaa);
        // debug($data['raw_transfer_list']); die;
        $this->load->view(PROJECT_THEME.'/transfer/search_result_page', $data);     
}




public function get_api_resp($search_id){
//  ignore_user_abort(true);
// set_time_limit(0);
        $get_search_data_transfer = $this->Transfer_Model->get_search_data_transfer($search_id);  
        $search_data = $get_search_data_transfer[0]['search_data'];
        // $Response = $this->transfer_api->transfer_api_response($search_data,$search_id);   
        // debug($Response); die;
        
     $Response ='{
   "TransferSearchResult": {
      "Error": {
         "ErrorCode": 0,
         "ErrorMessage": ""
      },
      "ResponseStatus": 1,
      "TraceId": "5a9b1b22-b23b-4141-98b4-c27c896405c5",
      "TransferSearchResults": [
         {
            "IsPANMandatory": true,
            "ResultIndex": 9,
            "TransferCode": "1088225",
            "TransferName": "Estate Car",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-09T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-10T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Estate Car",
                  "VehicleCode": "1",
                  "VehicleMaximumPassengers": 4,
                  "VehicleMaximumLuggage": 4,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 8815.03,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 8815.03,
                     "PublishedPriceRoundedOff": 8815,
                     "OfferedPrice": 8815.03,
                     "OfferedPriceRoundedOff": 8815,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 10,
            "TransferCode": "1088224",
            "TransferName": "Standard Car",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-09T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-10T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Standard Car",
                  "VehicleCode": "2",
                  "VehicleMaximumPassengers": 3,
                  "VehicleMaximumLuggage": 3,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 8815.03,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 8815.03,
                     "PublishedPriceRoundedOff": 8815,
                     "OfferedPrice": 8815.03,
                     "OfferedPriceRoundedOff": 8815,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 11,
            "TransferCode": "1059997",
            "TransferName": "Standard Car",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-09T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-10T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Standard Car",
                  "VehicleCode": "3",
                  "VehicleMaximumPassengers": 2,
                  "VehicleMaximumLuggage": 2,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 11753.38,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 11753.38,
                     "PublishedPriceRoundedOff": 11753,
                     "OfferedPrice": 11753.38,
                     "OfferedPriceRoundedOff": 11753,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 12,
            "TransferCode": "949433",
            "TransferName": "MPV",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-09T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-10T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "MPV",
                  "VehicleCode": "4",
                  "VehicleMaximumPassengers": 4,
                  "VehicleMaximumLuggage": 4,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 12626.94,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 12626.94,
                     "PublishedPriceRoundedOff": 12627,
                     "OfferedPrice": 12626.94,
                     "OfferedPriceRoundedOff": 12627,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 13,
            "TransferCode": "415826",
            "TransferName": "Estate Car",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-10T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-11T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Estate Car",
                  "VehicleCode": "5",
                  "VehicleMaximumPassengers": 3,
                  "VehicleMaximumLuggage": 3,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 12706.35,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 12706.35,
                     "PublishedPriceRoundedOff": 12706,
                     "OfferedPrice": 12706.35,
                     "OfferedPriceRoundedOff": 12706,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 14,
            "TransferCode": "1059999",
            "TransferName": "Minivan",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-09T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-10T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Minivan",
                  "VehicleCode": "6",
                  "VehicleMaximumPassengers": 6,
                  "VehicleMaximumLuggage": 6,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 14612.3,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 14612.3,
                     "PublishedPriceRoundedOff": 14612,
                     "OfferedPrice": 14612.3,
                     "OfferedPriceRoundedOff": 14612,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 15,
            "TransferCode": "415827",
            "TransferName": "Van",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-10T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-11T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Van",
                  "VehicleCode": "7",
                  "VehicleMaximumPassengers": 9,
                  "VehicleMaximumLuggage": 9,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 16835.92,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 16835.92,
                     "PublishedPriceRoundedOff": 16836,
                     "OfferedPrice": 16835.92,
                     "OfferedPriceRoundedOff": 16836,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 16,
            "TransferCode": "1060000",
            "TransferName": "Van",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-09T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-10T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Van",
                  "VehicleCode": "8",
                  "VehicleMaximumPassengers": 10,
                  "VehicleMaximumLuggage": 10,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 17550.65,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 17550.65,
                     "PublishedPriceRoundedOff": 17551,
                     "OfferedPrice": 17550.65,
                     "OfferedPriceRoundedOff": 17551,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 17,
            "TransferCode": "1089820",
            "TransferName": "SUV",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-09T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-10T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "SUV",
                  "VehicleCode": "9",
                  "VehicleMaximumPassengers": 5,
                  "VehicleMaximumLuggage": 5,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 18980.11,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 18980.11,
                     "PublishedPriceRoundedOff": 18980,
                     "OfferedPrice": 18980.11,
                     "OfferedPriceRoundedOff": 18980,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 18,
            "TransferCode": "1089823",
            "TransferName": "Premium Minivan",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-09T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-10T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Premium Minivan",
                  "VehicleCode": "10",
                  "VehicleMaximumPassengers": 6,
                  "VehicleMaximumLuggage": 6,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 18980.11,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 18980.11,
                     "PublishedPriceRoundedOff": 18980,
                     "OfferedPrice": 18980.11,
                     "OfferedPriceRoundedOff": 18980,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 19,
            "TransferCode": "1089819",
            "TransferName": "Premium SUV",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-09T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-10T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Premium SUV",
                  "VehicleCode": "11",
                  "VehicleMaximumPassengers": 5,
                  "VehicleMaximumLuggage": 5,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 18980.11,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 18980.11,
                     "PublishedPriceRoundedOff": 18980,
                     "OfferedPrice": 18980.11,
                     "OfferedPriceRoundedOff": 18980,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 20,
            "TransferCode": "1089821",
            "TransferName": "Premium Car",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-09T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-10T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Premium Car",
                  "VehicleCode": "12",
                  "VehicleMaximumPassengers": 3,
                  "VehicleMaximumLuggage": 3,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 21918.46,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 21918.46,
                     "PublishedPriceRoundedOff": 21918,
                     "OfferedPrice": 21918.46,
                     "OfferedPriceRoundedOff": 21918,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 21,
            "TransferCode": "1060001",
            "TransferName": "Minibus",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-08T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-09T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Minibus",
                  "VehicleCode": "13",
                  "VehicleMaximumPassengers": 16,
                  "VehicleMaximumLuggage": 16,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 26603.92,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 26603.92,
                     "PublishedPriceRoundedOff": 26604,
                     "OfferedPrice": 26603.92,
                     "OfferedPriceRoundedOff": 26604,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 22,
            "TransferCode": "264143",
            "TransferName": "Bus",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-08T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-09T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Bus",
                  "VehicleCode": "14",
                  "VehicleMaximumPassengers": 16,
                  "VehicleMaximumLuggage": 16,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 27795.15,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 27795.15,
                     "PublishedPriceRoundedOff": 27795,
                     "OfferedPrice": 27795.15,
                     "OfferedPriceRoundedOff": 27795,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 23,
            "TransferCode": "264144",
            "TransferName": "Bus",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-08T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-09T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Bus",
                  "VehicleCode": "15",
                  "VehicleMaximumPassengers": 22,
                  "VehicleMaximumLuggage": 22,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 30733.49,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 30733.49,
                     "PublishedPriceRoundedOff": 30733,
                     "OfferedPrice": 30733.49,
                     "OfferedPriceRoundedOff": 30733,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 24,
            "TransferCode": "1089827",
            "TransferName": "Minibus",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-09T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-10T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Minibus",
                  "VehicleCode": "16",
                  "VehicleMaximumPassengers": 12,
                  "VehicleMaximumLuggage": 12,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 32162.95,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 32162.95,
                     "PublishedPriceRoundedOff": 32163,
                     "OfferedPrice": 32162.95,
                     "OfferedPriceRoundedOff": 32163,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 25,
            "TransferCode": "264145",
            "TransferName": "Bus",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-06T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-07T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Bus",
                  "VehicleCode": "17",
                  "VehicleMaximumPassengers": 40,
                  "VehicleMaximumLuggage": 40,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 33910.08,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 33910.08,
                     "PublishedPriceRoundedOff": 33910,
                     "OfferedPrice": 33910.08,
                     "OfferedPriceRoundedOff": 33910,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 26,
            "TransferCode": "1089826",
            "TransferName": "Bus",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-08T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-09T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Bus",
                  "VehicleCode": "18",
                  "VehicleMaximumPassengers": 20,
                  "VehicleMaximumLuggage": 20,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 36530.76,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 36530.76,
                     "PublishedPriceRoundedOff": 36531,
                     "OfferedPrice": 36530.76,
                     "OfferedPriceRoundedOff": 36531,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 27,
            "TransferCode": "1089825",
            "TransferName": "Bus",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-08T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-09T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Bus",
                  "VehicleCode": "19",
                  "VehicleMaximumPassengers": 35,
                  "VehicleMaximumLuggage": 35,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 42407.45,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 42407.45,
                     "PublishedPriceRoundedOff": 42407,
                     "OfferedPrice": 42407.45,
                     "OfferedPriceRoundedOff": 42407,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 28,
            "TransferCode": "1060002",
            "TransferName": "Bus",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-08T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-09T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Bus",
                  "VehicleCode": "20",
                  "VehicleMaximumPassengers": 37,
                  "VehicleMaximumLuggage": 37,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 42407.45,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 42407.45,
                     "PublishedPriceRoundedOff": 42407,
                     "OfferedPrice": 42407.45,
                     "OfferedPriceRoundedOff": 42407,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 1,
            "TransferCode": "1192|limo|Toyota Prius|economy",
            "TransferName": "Economy Sedan",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 8,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": null,
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": null,
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-10T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-11T00:00:00",
                        "ToDate": "2025-02-15T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Economy Sedan",
                  "VehicleCode": "1192",
                  "VehicleMaximumPassengers": 4,
                  "VehicleMaximumLuggage": 3,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 50136.09,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 50136.09,
                     "PublishedPriceRoundedOff": 50136,
                     "OfferedPrice": 50136.09,
                     "OfferedPriceRoundedOff": 50136,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": null
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 3,
            "TransferCode": "558|limo|VW T5|economy_van",
            "TransferName": "Economy VAN",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 8,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": null,
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": null,
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-10T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-11T00:00:00",
                        "ToDate": "2025-02-15T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Economy VAN",
                  "VehicleCode": "558",
                  "VehicleMaximumPassengers": 6,
                  "VehicleMaximumLuggage": 6,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 50930.24,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 50930.24,
                     "PublishedPriceRoundedOff": 50930,
                     "OfferedPrice": 50930.24,
                     "OfferedPriceRoundedOff": 50930,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": null
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 2,
            "TransferCode": "3759|limo|VW Touran|economy_mpv",
            "TransferName": "Economy MPV",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 8,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": null,
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": null,
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-10T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-11T00:00:00",
                        "ToDate": "2025-02-15T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Economy MPV",
                  "VehicleCode": "3759",
                  "VehicleMaximumPassengers": 4,
                  "VehicleMaximumLuggage": 4,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 61011.14,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 61011.14,
                     "PublishedPriceRoundedOff": 61011,
                     "OfferedPrice": 61011.14,
                     "OfferedPriceRoundedOff": 61011,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": null
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 4,
            "TransferCode": "4135|limo|Mercedes-Benz Sprinter|minibus",
            "TransferName": "Minibus",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 8,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": null,
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": null,
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-10T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-11T00:00:00",
                        "ToDate": "2025-02-15T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Minibus",
                  "VehicleCode": "4135",
                  "VehicleMaximumPassengers": 16,
                  "VehicleMaximumLuggage": 16,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 61011.14,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 61011.14,
                     "PublishedPriceRoundedOff": 61011,
                     "OfferedPrice": 61011.14,
                     "OfferedPriceRoundedOff": 61011,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": null
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 5,
            "TransferCode": "559|limo|Mercedes-Benz E-Class|business",
            "TransferName": "Business Sedan",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 8,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": null,
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": null,
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-10T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-11T00:00:00",
                        "ToDate": "2025-02-15T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Business Sedan",
                  "VehicleCode": "559",
                  "VehicleMaximumPassengers": 3,
                  "VehicleMaximumLuggage": 3,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 64198.05,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 64198.05,
                     "PublishedPriceRoundedOff": 64198,
                     "OfferedPrice": 64198.05,
                     "OfferedPriceRoundedOff": 64198,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": null
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 7,
            "TransferCode": "560|limo|Mercedes-Benz V-Class|business_van",
            "TransferName": "Business VAN",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 8,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": null,
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": null,
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-10T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-11T00:00:00",
                        "ToDate": "2025-02-15T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Business VAN",
                  "VehicleCode": "560",
                  "VehicleMaximumPassengers": 6,
                  "VehicleMaximumLuggage": 6,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 64198.05,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 64198.05,
                     "PublishedPriceRoundedOff": 64198,
                     "OfferedPrice": 64198.05,
                     "OfferedPriceRoundedOff": 64198,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": null
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 6,
            "TransferCode": "4136|limo|Mercedes-Benz GL-Class|business_mpv",
            "TransferName": "Business MPV",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 8,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": null,
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": null,
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-10T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-11T00:00:00",
                        "ToDate": "2025-02-15T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Business MPV",
                  "VehicleCode": "4136",
                  "VehicleMaximumPassengers": 4,
                  "VehicleMaximumLuggage": 4,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 74278.95,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 74278.95,
                     "PublishedPriceRoundedOff": 74279,
                     "OfferedPrice": 74278.95,
                     "OfferedPriceRoundedOff": 74279,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": null
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 8,
            "TransferCode": "561|limo|Mercedes-Benz S-Class|first",
            "TransferName": "First Class Sedan",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 8,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": null,
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": null,
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-10T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-11T00:00:00",
                        "ToDate": "2025-02-15T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "First Class Sedan",
                  "VehicleCode": "561",
                  "VehicleMaximumPassengers": 3,
                  "VehicleMaximumLuggage": 3,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 87402.23,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 87402.23,
                     "PublishedPriceRoundedOff": 87402,
                     "OfferedPrice": 87402.23,
                     "OfferedPriceRoundedOff": 87402,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": null
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 29,
            "TransferCode": "1089824",
            "TransferName": "Business Minibus",
            "CityCode": "115936",
            "ApproximateTransferTime": 1.35,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "DXB",
               "PickUpDetailName": "Dubai Intl",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1030",
               "PickUpDate": "15/02/2025"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1078433",
               "DropOffDetailName": "Corniche Hotel Abu Dhabi",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2025-02-08T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2025-02-09T00:00:00",
                        "ToDate": "2025-02-11T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Business Minibus",
                  "VehicleCode": "21",
                  "VehicleMaximumPassengers": 10,
                  "VehicleMaximumLuggage": 10,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 87594.41,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 87594.41,
                     "PublishedPriceRoundedOff": 87594,
                     "OfferedPrice": 87594.41,
                     "OfferedPriceRoundedOff": 87594,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         }
      ],
      "ValidationInfo": {
         "IsAgencyOwnPANAllowed": false,
         "IsCorporateBookingAllowed": true,
         "IsTCSApplicableOnCrp": false
      },
      "PreferredCurrency": "INR"
   }
}';
 

        /*$data['response'] = $Response;
        $data['search_id'] = $search_id; 
        $searcdatah_insert_data = $this->Transfer_Model->insert_transfer_search_logs($data);
        $Response = $this->Transfer_Model->get_search_resp($search_id);   
        $response_ = json_decode($Response[0]['response'],true);  
        $data['raw_transfer_list'] = $response_;*/
          


        $data['raw_transfer_list'] = json_decode($Response,true);
        

        // debug($data['raw_transfer_list']); die;
        return $data['raw_transfer_list'];
}
 
public function transfer_list($search_id){ 

// debug($search_id);
//   debug('teeeeee'); die;
        error_reporting(0);
        $search_params =array();
        $search_params = $this->input->get(); 
        // debug($search_params); 

        $get_search_data_transfer = $this->Transfer_Model->get_search_data_transfer($search_params['search_id']); 

        // debug($get_search_data_transfer); die;
 
        $search_data = $get_search_data_transfer[0]['search_data'];
        // $Response = $this->transfer_api->transfer_api_response($search_data,$search_params['search_id']);   

        $Response = '{
   "TransferSearchResult": {
      "Error": {
         "ErrorCode": 0,
         "ErrorMessage": ""
      },
      "ResponseStatus": 1,
      "TraceId": "2d8ef20a-a4f0-41ae-9635-e4098844b4d1",
      "TransferSearchResults": [
         {
            "IsPANMandatory": true,
            "ResultIndex": 1,
            "TransferCode": "990499",
            "TransferName": "Standard Car",
            "CityCode": "144092",
            "ApproximateTransferTime": 0.38,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": "Bangkok Intl Airport",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": "Baan Sukhumvit Soi 18",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-19T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-20T00:00:00",
                        "ToDate": "2024-09-21T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Standard Car",
                  "VehicleCode": "1",
                  "VehicleMaximumPassengers": 2,
                  "VehicleMaximumLuggage": 2,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 2303.03,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 2303.03,
                     "PublishedPriceRoundedOff": 2303,
                     "OfferedPrice": 2303.03,
                     "OfferedPriceRoundedOff": 2303,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 20,
            "TransferCode": "1267219_2_1",
            "TransferName": "Private Standard Car",
            "CityCode": "144092",
            "ApproximateTransferTime": 1.55,
            "CategoryId": 4,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": "Bangkok Suvarnabhumi International Airport",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": false,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": "Baan Sukhumvit Soi 18",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-18T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-19T00:00:00",
                        "ToDate": "2024-09-25T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Private Standard Car",
                  "VehicleCode": "43",
                  "VehicleMaximumPassengers": 3,
                  "VehicleMaximumLuggage": 3,
                  "Language": "English",
                  "LanguageCode": 4,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 2360.2,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 2360.2,
                     "PublishedPriceRoundedOff": 2360,
                     "OfferedPrice": 2360.2,
                     "OfferedPriceRoundedOff": 2360,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               " No of vehicle while travelling : 1 with capacity of 3 passengers  and 3 bags per vehicle "
            ],
            "Description": "Private Standard Cars operate a door to door service across our destinations around the world.\r\n\r\nThe driver will meet you via a ‘Meet & Greet’ service either at the arrivals hall or at our partner’s desk, and you will enjoy the relaxed journey that your private transfer gives you.\r\n\r\nVehicle types vary and whilst in the majority of locations you will be transported in a saloon vehicle in some, you may be transported in a larger vehicle. In all cases, you will be the only passengers in your vehicle, giving you a peaceful journey to and from your destination.\r\n\r\nFurther Arrival and Departure information will be provided on your booking voucher.\r\n"
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 2,
            "TransferCode": "990493",
            "TransferName": "MPV",
            "CityCode": "144092",
            "ApproximateTransferTime": 0.38,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": "Bangkok Intl Airport",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": "Baan Sukhumvit Soi 18",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-19T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-20T00:00:00",
                        "ToDate": "2024-09-21T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "MPV",
                  "VehicleCode": "2",
                  "VehicleMaximumPassengers": 4,
                  "VehicleMaximumLuggage": 4,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 2541.27,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 2541.27,
                     "PublishedPriceRoundedOff": 2541,
                     "OfferedPrice": 2541.27,
                     "OfferedPriceRoundedOff": 2541,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 3,
            "TransferCode": "1083722",
            "TransferName": "Premium Car",
            "CityCode": "144092",
            "ApproximateTransferTime": 0.38,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": "Bangkok Intl Airport",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": "Baan Sukhumvit Soi 18",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-20T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-21T00:00:00",
                        "ToDate": "2024-09-21T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Premium Car",
                  "VehicleCode": "3",
                  "VehicleMaximumPassengers": 2,
                  "VehicleMaximumLuggage": 2,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 3256,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 3256,
                     "PublishedPriceRoundedOff": 3256,
                     "OfferedPrice": 3256,
                     "OfferedPriceRoundedOff": 3256,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 21,
            "TransferCode": "1267194_2_1",
            "TransferName": "Private Standard Minibus",
            "CityCode": "144092",
            "ApproximateTransferTime": 1.55,
            "CategoryId": 4,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": "Bangkok Suvarnabhumi International Airport",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": false,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": "Baan Sukhumvit Soi 18",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-18T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-19T00:00:00",
                        "ToDate": "2024-09-25T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Private Standard Minibus",
                  "VehicleCode": "2",
                  "VehicleMaximumPassengers": 8,
                  "VehicleMaximumLuggage": 8,
                  "Language": "English",
                  "LanguageCode": 4,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 3857.17,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 3857.17,
                     "PublishedPriceRoundedOff": 3857,
                     "OfferedPrice": 3857.17,
                     "OfferedPriceRoundedOff": 3857,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               " No of vehicle while travelling : 1 with capacity of 8 passengers  and 8 bags per vehicle "
            ],
            "Description": "Private Standard Minibuses operate door to door services that are perfect for larger groups.\r\n\r\nThe driver will meet you via a ‘Meet & Greet’ service either at the arrivals hall or at our partner’s desk, and you will enjoy the relaxed journey that your private transfer gives you.\r\n\r\nFurther arrival and departure information will be provided on your booking voucher."
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 4,
            "TransferCode": "1083723",
            "TransferName": "Minivan",
            "CityCode": "144092",
            "ApproximateTransferTime": 0.38,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": "Bangkok Intl Airport",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": "Baan Sukhumvit Soi 18",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-20T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-21T00:00:00",
                        "ToDate": "2024-09-21T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Minivan",
                  "VehicleCode": "4",
                  "VehicleMaximumPassengers": 7,
                  "VehicleMaximumLuggage": 7,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 3970.74,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 3970.74,
                     "PublishedPriceRoundedOff": 3971,
                     "OfferedPrice": 3970.74,
                     "OfferedPriceRoundedOff": 3971,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 5,
            "TransferCode": "990497",
            "TransferName": "Minivan",
            "CityCode": "144092",
            "ApproximateTransferTime": 0.38,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": "Bangkok Intl Airport",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": "Baan Sukhumvit Soi 18",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-19T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-20T00:00:00",
                        "ToDate": "2024-09-21T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Minivan",
                  "VehicleCode": "5",
                  "VehicleMaximumPassengers": 9,
                  "VehicleMaximumLuggage": 9,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 4844.3,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 4844.3,
                     "PublishedPriceRoundedOff": 4844,
                     "OfferedPrice": 4844.3,
                     "OfferedPriceRoundedOff": 4844,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 6,
            "TransferCode": "990495",
            "TransferName": "SUV",
            "CityCode": "144092",
            "ApproximateTransferTime": 0.38,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": "Bangkok Intl Airport",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": "Baan Sukhumvit Soi 18",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-19T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-20T00:00:00",
                        "ToDate": "2024-09-21T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "SUV",
                  "VehicleCode": "6",
                  "VehicleMaximumPassengers": 4,
                  "VehicleMaximumLuggage": 4,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 4844.3,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 4844.3,
                     "PublishedPriceRoundedOff": 4844,
                     "OfferedPrice": 4844.3,
                     "OfferedPriceRoundedOff": 4844,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 7,
            "TransferCode": "990498",
            "TransferName": "Premium Minivan",
            "CityCode": "144092",
            "ApproximateTransferTime": 0.38,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": "Bangkok Intl Airport",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": "Baan Sukhumvit Soi 18",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-19T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-20T00:00:00",
                        "ToDate": "2024-09-21T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Premium Minivan",
                  "VehicleCode": "7",
                  "VehicleMaximumPassengers": 6,
                  "VehicleMaximumLuggage": 6,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 5003.13,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 5003.13,
                     "PublishedPriceRoundedOff": 5003,
                     "OfferedPrice": 5003.13,
                     "OfferedPriceRoundedOff": 5003,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 8,
            "TransferCode": "990496",
            "TransferName": "Premium SUV",
            "CityCode": "144092",
            "ApproximateTransferTime": 0.38,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": "Bangkok Intl Airport",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": "Baan Sukhumvit Soi 18",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-19T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-20T00:00:00",
                        "ToDate": "2024-09-21T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Premium SUV",
                  "VehicleCode": "8",
                  "VehicleMaximumPassengers": 4,
                  "VehicleMaximumLuggage": 4,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 5003.13,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 5003.13,
                     "PublishedPriceRoundedOff": 5003,
                     "OfferedPrice": 5003.13,
                     "OfferedPriceRoundedOff": 5003,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 22,
            "TransferCode": "1267207_2_1",
            "TransferName": "Private Premium Car",
            "CityCode": "144092",
            "ApproximateTransferTime": 1.55,
            "CategoryId": 4,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": "Bangkok Suvarnabhumi International Airport",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": false,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": "Baan Sukhumvit Soi 18",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-18T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-19T00:00:00",
                        "ToDate": "2024-09-25T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Private Premium Car",
                  "VehicleCode": "18",
                  "VehicleMaximumPassengers": 3,
                  "VehicleMaximumLuggage": 3,
                  "Language": "English",
                  "LanguageCode": 4,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 6566.01,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 6566.01,
                     "PublishedPriceRoundedOff": 6566,
                     "OfferedPrice": 6566.01,
                     "OfferedPriceRoundedOff": 6566,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               " No of vehicle while travelling : 1 with capacity of 3 passengers  and 3 bags per vehicle "
            ],
            "Description": "Private Premium Cars operate door to door services in a high class vehicle.\r\n\r\nVehicle types vary by destination, in all cases, you will be the only passengers in your vehicle, giving you a peaceful journey to and from your accomodation.\r\n\r\nThe driver will meet you via a ‘Meet & Greet’ service either at the arrivals hall or at our partner’s desk, and you will enjoy the relaxed journey that your private transfer gives you.\r\n\r\nFurther arrival and departure information will be provided on your booking voucher."
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 9,
            "TransferCode": "1083727",
            "TransferName": "Car + Minivan",
            "CityCode": "144092",
            "ApproximateTransferTime": 0.38,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": "Bangkok Intl Airport",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": "Baan Sukhumvit Soi 18",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-19T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-20T00:00:00",
                        "ToDate": "2024-09-21T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Car + Minivan",
                  "VehicleCode": "9",
                  "VehicleMaximumPassengers": 8,
                  "VehicleMaximumLuggage": 8,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 7147.32,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 7147.32,
                     "PublishedPriceRoundedOff": 7147,
                     "OfferedPrice": 7147.32,
                     "OfferedPriceRoundedOff": 7147,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 10,
            "TransferCode": "1083728",
            "TransferName": "2 Minivans",
            "CityCode": "144092",
            "ApproximateTransferTime": 0.38,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": "Bangkok Intl Airport",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": "Baan Sukhumvit Soi 18",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-19T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-20T00:00:00",
                        "ToDate": "2024-09-21T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "2 Minivans",
                  "VehicleCode": "10",
                  "VehicleMaximumPassengers": 14,
                  "VehicleMaximumLuggage": 14,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 7862.06,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 7862.06,
                     "PublishedPriceRoundedOff": 7862,
                     "OfferedPrice": 7862.06,
                     "OfferedPriceRoundedOff": 7862,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 11,
            "TransferCode": "990500",
            "TransferName": "Premium Minivan",
            "CityCode": "144092",
            "ApproximateTransferTime": 0.38,
            "CategoryId": 7,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": "Bangkok Intl Airport",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": "Baan Sukhumvit Soi 18",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-19T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-20T00:00:00",
                        "ToDate": "2024-09-21T23:59:59"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Premium Minivan",
                  "VehicleCode": "11",
                  "VehicleMaximumPassengers": 5,
                  "VehicleMaximumLuggage": 5,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 10006.25,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 10006.25,
                     "PublishedPriceRoundedOff": 10006,
                     "OfferedPrice": 10006.25,
                     "OfferedPriceRoundedOff": 10006,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               "Our representative monitors your landing hour and waits 60 minutes since the time of actual landing"
            ]
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 23,
            "TransferCode": "1267232_2_1",
            "TransferName": "Private Premium Minibus",
            "CityCode": "144092",
            "ApproximateTransferTime": 1.55,
            "CategoryId": 4,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": "Bangkok Suvarnabhumi International Airport",
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": false,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": "Baan Sukhumvit Soi 18",
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-18T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-19T00:00:00",
                        "ToDate": "2024-09-25T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Private Premium Minibus",
                  "VehicleCode": "78",
                  "VehicleMaximumPassengers": 5,
                  "VehicleMaximumLuggage": 5,
                  "Language": "English",
                  "LanguageCode": 4,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 10181.76,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 10181.76,
                     "PublishedPriceRoundedOff": 10182,
                     "OfferedPrice": 10181.76,
                     "OfferedPriceRoundedOff": 10182,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": [
               " No of vehicle while travelling : 1 with capacity of 5 passengers  and 5 bags per vehicle "
            ],
            "Description": "Private Premium Minibuses operate door to door services in a high class vehicle.\r\n\r\nVehicle types vary by destination, in all cases, you will be the only passengers in your vehicle, giving you a peaceful journey to and from your accommodation.\r\n\r\nThe driver will meet you via a ‘Meet & Greet’ service either at the arrivals hall or at our partner’s desk, and you will enjoy the relaxed journey that your private transfer gives you.\r\n\r\nFurther arrival and departure information will be provided on your booking voucher."
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 12,
            "TransferCode": "2847|limo|Toyota Prius|economy",
            "TransferName": "Economy Sedan",
            "CityCode": "144092",
            "ApproximateTransferTime": 0.28,
            "CategoryId": 8,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": null,
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": null,
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-20T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-21T00:00:00",
                        "ToDate": "2024-09-25T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Economy Sedan",
                  "VehicleCode": "2847",
                  "VehicleMaximumPassengers": 4,
                  "VehicleMaximumLuggage": 3,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 15131.68,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 15131.68,
                     "PublishedPriceRoundedOff": 15132,
                     "OfferedPrice": 15131.68,
                     "OfferedPriceRoundedOff": 15132,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": null
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 14,
            "TransferCode": "2848|limo|VW T5|economy_van",
            "TransferName": "Economy VAN",
            "CityCode": "144092",
            "ApproximateTransferTime": 0.28,
            "CategoryId": 8,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": null,
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": null,
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-20T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-21T00:00:00",
                        "ToDate": "2024-09-25T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Economy VAN",
                  "VehicleCode": "2848",
                  "VehicleMaximumPassengers": 6,
                  "VehicleMaximumLuggage": 6,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 15925.82,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 15925.82,
                     "PublishedPriceRoundedOff": 15926,
                     "OfferedPrice": 15925.82,
                     "OfferedPriceRoundedOff": 15926,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": null
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 13,
            "TransferCode": "5094|limo|VW Touran|economy_mpv",
            "TransferName": "Economy MPV",
            "CityCode": "144092",
            "ApproximateTransferTime": 0.28,
            "CategoryId": 8,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": null,
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": null,
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-20T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-21T00:00:00",
                        "ToDate": "2024-09-25T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Economy MPV",
                  "VehicleCode": "5094",
                  "VehicleMaximumPassengers": 4,
                  "VehicleMaximumLuggage": 4,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 16240.31,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 16240.31,
                     "PublishedPriceRoundedOff": 16240,
                     "OfferedPrice": 16240.31,
                     "OfferedPriceRoundedOff": 16240,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": null
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 15,
            "TransferCode": "5095|limo|Mercedes-Benz Sprinter|minibus",
            "TransferName": "Minibus",
            "CityCode": "144092",
            "ApproximateTransferTime": 0.28,
            "CategoryId": 8,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": null,
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": null,
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-20T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-21T00:00:00",
                        "ToDate": "2024-09-25T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Minibus",
                  "VehicleCode": "5095",
                  "VehicleMaximumPassengers": 16,
                  "VehicleMaximumLuggage": 16,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 16240.31,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 16240.31,
                     "PublishedPriceRoundedOff": 16240,
                     "OfferedPrice": 16240.31,
                     "OfferedPriceRoundedOff": 16240,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": null
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 16,
            "TransferCode": "2849|limo|Mercedes-Benz E-Class|business",
            "TransferName": "Business Sedan",
            "CityCode": "144092",
            "ApproximateTransferTime": 0.28,
            "CategoryId": 8,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": null,
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": null,
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-20T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-21T00:00:00",
                        "ToDate": "2024-09-25T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Business Sedan",
                  "VehicleCode": "2849",
                  "VehicleMaximumPassengers": 3,
                  "VehicleMaximumLuggage": 3,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 19412.13,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 19412.13,
                     "PublishedPriceRoundedOff": 19412,
                     "OfferedPrice": 19412.13,
                     "OfferedPriceRoundedOff": 19412,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": null
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 18,
            "TransferCode": "2850|limo|Mercedes-Benz V-Class|business_van",
            "TransferName": "Business VAN",
            "CityCode": "144092",
            "ApproximateTransferTime": 0.28,
            "CategoryId": 8,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": null,
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": null,
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-20T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-21T00:00:00",
                        "ToDate": "2024-09-25T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Business VAN",
                  "VehicleCode": "2850",
                  "VehicleMaximumPassengers": 6,
                  "VehicleMaximumLuggage": 6,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 19412.13,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 19412.13,
                     "PublishedPriceRoundedOff": 19412,
                     "OfferedPrice": 19412.13,
                     "OfferedPriceRoundedOff": 19412,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": null
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 17,
            "TransferCode": "5096|limo|Mercedes-Benz GL-Class|business_mpv",
            "TransferName": "Business MPV",
            "CityCode": "144092",
            "ApproximateTransferTime": 0.28,
            "CategoryId": 8,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": null,
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": null,
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-20T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-21T00:00:00",
                        "ToDate": "2024-09-25T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "Business MPV",
                  "VehicleCode": "5096",
                  "VehicleMaximumPassengers": 4,
                  "VehicleMaximumLuggage": 4,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 19727.41,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 19727.41,
                     "PublishedPriceRoundedOff": 19727,
                     "OfferedPrice": 19727.41,
                     "OfferedPriceRoundedOff": 19727,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": null
         },
         {
            "IsPANMandatory": true,
            "ResultIndex": 19,
            "TransferCode": "2851|limo|Mercedes-Benz S-Class|first",
            "TransferName": "First Class Sedan",
            "CityCode": "144092",
            "ApproximateTransferTime": 0.28,
            "CategoryId": 8,
            "PickUp": {
               "PickUpCode": 1,
               "PickUpName": "Airport",
               "PickUpDetailCode": "BKK",
               "PickUpDetailName": null,
               "IsPickUpAllowed": true,
               "IsPickUpTimeRequired": true,
               "PickUpTime": "1317",
               "PickUpDate": "25/09/2024"
            },
            "DropOff": {
               "DropOffCode": 0,
               "DropOffName": "Accomodation",
               "DropOffDetailCode": "1318080",
               "DropOffDetailName": null,
               "DropOffAllowForCheckInTime": 0,
               "IsDropOffAllowed": true
            },
            "Vehicles": [
               {
                  "IsPANMandatory": false,
                  "LastCancellationDate": "2024-09-20T23:59:59",
                  "TransferCancellationPolicy": [
                     {
                        "Charge": 100,
                        "ChargeType": 2,
                        "Currency": "INR",
                        "FromDate": "2024-09-21T00:00:00",
                        "ToDate": "2024-09-25T00:00:00"
                     }
                  ],
                  "VehicleIndex": 1,
                  "Vehicle": "First Class Sedan",
                  "VehicleCode": "2851",
                  "VehicleMaximumPassengers": 3,
                  "VehicleMaximumLuggage": 3,
                  "Language": "NotSpecified",
                  "LanguageCode": 0,
                  "TransferPrice": {
                     "CurrencyCode": "INR",
                     "BasePrice": 25987.67,
                     "Tax": 0,
                     "Discount": 0,
                     "PublishedPrice": 25987.67,
                     "PublishedPriceRoundedOff": 25988,
                     "OfferedPrice": 25987.67,
                     "OfferedPriceRoundedOff": 25988,
                     "AgentCommission": 0,
                     "AgentMarkUp": 0,
                     "ServiceTax": 0,
                     "TCS": 0,
                     "TDS": 0,
                     "PriceType": 0,
                     "SubagentCommissionInPriceDetailResponse": 0,
                     "SubagentCommissionTypeInPriceDetailResponse": 0,
                     "DistributorCommissionInPriceDetailResponse": 0,
                     "DistributorCommissionTypeInPriceDetailResponse": 0,
                     "ServiceCharge": 0,
                     "TotalGSTAmount": 0,
                     "GST": {
                        "CGSTAmount": 0,
                        "CGSTRate": 0,
                        "CessAmount": 0,
                        "CessRate": 0,
                        "IGSTAmount": 0,
                        "IGSTRate": 18,
                        "SGSTAmount": 0,
                        "SGSTRate": 0,
                        "TaxableAmount": 0
                     }
                  }
               }
            ],
            "Condition": null
         }
      ],
      "ValidationInfo": {
         "IsAgencyOwnPANAllowed": false,
         "IsCorporateBookingAllowed": true,
         "IsTCSApplicableOnCrp": false
      },
      "PreferredCurrency": "INR"
   }
}'; 
        $response_ = json_decode($Response,true);  
        $data['raw_transfer_list'] = $response_; 
        $dataresult['data'] =  $this->load->view(PROJECT_THEME.'/transfer/search_result_page',$data); 
        $dataresult['raw_transfer_list']= $response_; 
        $dataresult['status'] = 1;  
        echo json_encode($dataresult);exit();  
        // bus reference............................................................. 
    // bus reference.............................................................
}

public function addToCart($ResultIndex) {

    $d = unserialize(urldecode($ResultIndex)); 
    $Response = $this->Transfer_Model->get_search_resp($d['search_id']);  
    $response_ = json_decode($Response[0]['response'],true);  
    foreach ($response_['TransferSearchResult']['TransferSearchResults'] as $key => $value) { 
         if($value['ResultIndex']==$d['ResultIndex']){ 
            $vehicle = $value['Vehicles'];
            $TransferCode = $value['TransferCode'];
            $Condition = $value['Condition']; 
         }
    }  

    $number_of_vehicle = explode(':', $Condition[0]);
// debug($number_of_vehicle[1]);
    $number_of_vehicle = explode(' ', $number_of_vehicle[1]);    
    
    // debug($number_of_vehicle[1]); die;
    $data= array(); 
    $get_search_data = $this->Home_Model->get_search_data($d['search_id']); 
    $srch_dta = json_decode( $get_search_data[0]['search_data'],true);

     // debug($srch_dta); die;

    $data['Vehicles'] = $vehicle; 
    $data['srch_dta'] = $srch_dta; 
    $data['TransferCode'] = $TransferCode; 
    $data['search_id'] = $d['search_id']; 
    $data['TraceId'] = $response_['TransferSearchResult']['TraceId']; 
    $data['Condition'] = $number_of_vehicle[1]; 
    $data['ResultIndex'] = $d['ResultIndex']; 
    $data['transfer_country_list'] =   $this->Home_Model->transfer_country_list(); 
    $this->load->view(PROJECT_THEME.'/transfer/booking_page', $data);  

    //flight reference

    }

public function Booking($search_id){
 // debug("booking blocked"); die;
$r = base64_decode($_REQUEST['Vehicles']);  
$rr = $res = str_replace( array(  '[', ']' ), ' ', $r);  
$get_search_data = $this->Home_Model->get_search_data($search_id); 
$search_data = json_decode($get_search_data[0]['search_data'],true); 
$get_date=explode('-', $search_data['depatures']); 
$date_ = $get_date[2].'/'.$get_date[1].'/'.$get_date[0]; 
/*$t = '{
   "country": "GB",
   "from": "Ravna Gora,London,GB        ",
   "from_station_ids": "",
   "from_city_id": "",
   "from_HotelId": "1346517",
   "to": "London Heathrow Airport (LHR)",
   "to_station_id": "126632",
   "to_HotelId": "",
   "to_station_code": "LHR",
   "depatures": "2024-9-18",
   "hours": "19",
   "minutes": "32",
   "nationality": "IN",
   "langauge": "4",
   "adult": "1",
   "child": "0",
   "infant": "0"
}';
$srch_dta = json_decode($t,true); 
$search_data = $srch_dta;*/
$Vehicle = json_decode($rr,true);

$get_new_token=$this->Home_Model->get_token_deta(); 
$token_id = $get_new_token[0]['token'];  
// $token_id = "4237431c-a86e-476e-aff5-0f5833109d11"; 
$token_id = get_tokens(); 
// debug($Vehicle);  


$transaction_id =  'app_ref'.'-'. 'transf' . '-' . date ( 'dmHi' ) . '-' . rand ( 1000, 9999 );

// dubug($Vehicle); 

$rqust = json_encode($_REQUEST);

$this->Home_Model->insert_booking_detail_request($transaction_id,$search_id, $rqust,$_REQUEST['firstName'],$_REQUEST['lastName']); 
// debug($transaction_id); 
// debug($search_data); 
// debug($_REQUEST['airlineCode'].'-'.$_REQUEST['flightNumber']); die;


// debug(json_decode($book_req,true));  
// debug($_REQUEST['pickupHours'].$_REQUEST['pickupMinutes']); die; 
$H_time= $_REQUEST['pickupHours'].$_REQUEST['pickupMinutes'];
$book_request=array();
// $book_request['IsVoucherBooking']             =false;  for HOLD
$book_request['IsVoucherBooking']             =true;
$book_request['NumOfPax']                     =$search_data['adult'];
$book_request['PaxInfo'][0]['PaxId']          =0;
$book_request['PaxInfo'][0]['Title']          =$_REQUEST['title'];
$book_request['PaxInfo'][0]['FirstName']      =$_REQUEST['firstName'];
$book_request['PaxInfo'][0]['LastName']       =$_REQUEST['lastName'];
$book_request['PaxInfo'][0]['PaxType']        =0;
$book_request['PaxInfo'][0]['Age']            =35;
$book_request['PaxInfo'][0]['ContactNumber']  =$_REQUEST['mobileNo'];
$book_request['PaxInfo'][0]['PAN']            =$_REQUEST['pan'];
// Airport to Hotel
if($search_data['from_city_id']!=""){ 
$book_request['PickUp']['PickUpCode']         ="1";
$book_request['PickUp']['PickUpName']         ="Airport";
$book_request['PickUp']['PickUpDetailCode']   =$search_data['from_station_ids'];
$book_request['PickUp']['Description']        =$_REQUEST['airlineCode'].'-'.$_REQUEST['flightNumber'];

$book_request['PickUp']['PickUpDetailName']   =null;
$book_request['PickUp']['IsPickUpAllowed']    =true;
$book_request['PickUp']['IsPickUpTimeRequired']=true;
$book_request['PickUp']['Time']               =$search_data['hours'].$search_data['minutes'];
$book_request['PickUp']['PickUpDate']         =$date_;
$book_request['PickUp']['AddressLine1']       =null;
$book_request['PickUp']['city']               =null;
$book_request['PickUp']['Country']            =null;
$book_request['PickUp']['ZipCode']            =null;
$book_request['PickUp']['AddressLine2']       =null;
}
if($search_data['to_HotelId']!=""){ 

$book_request['DropOff']['DropOffCode']="0";
$book_request['DropOff']['DropOffName']="Accomodation";
$book_request['DropOff']['DropOffDetailCode']=$search_data['to_HotelId'];
$book_request['DropOff']['DropOffDetailName']=null;
$book_request['DropOff']['DropOffAllowForCheckInTime']=0;
$book_request['DropOff']['IsDropOffAllowed']=1;

// $book_request['DropOff']['PickUpDate']=null;
// $book_request['DropOff']['AddressLine1']=$_REQUEST['address1'];
// $book_request['DropOff']['City']=$_REQUEST['city'];
// $book_request['DropOff']['Country']=$_REQUEST['country'];
// $book_request['DropOff']['ZipCode']=$_REQUEST['zipcode'];
// $book_request['DropOff']['AddressLine2']=$_REQUEST['address2'];
}
// Airport to Hotel 
// Hotel to Airport  
if($search_data['from_HotelId']!=""){  
$book_request['PickUp']['DropOffCode']="0";
$book_request['PickUp']['DropOffName']="Accomodation";
$book_request['PickUp']['DropOffDetailCode']=$search_data['from_HotelId'];
$book_request['PickUp']['DropOffDetailName']=null;
$book_request['PickUp']['DropOffAllowForCheckInTime']=0;
$book_request['PickUp']['IsDropOffAllowed']=1;
$book_request['PickUp']['Time']=$H_time;
$book_request['PickUp']['PickUpDate']=$date_;
$book_request['PickUp']['AddressLine1']=$_REQUEST['address1'];
$book_request['PickUp']['City']=$_REQUEST['city'];
$book_request['PickUp']['Country']=$_REQUEST['country'];
$book_request['PickUp']['ZipCode']=$_REQUEST['zipcode'];
$book_request['PickUp']['AddressLine2']=$_REQUEST['address2'];
} 
if($search_data['to_station_code']!=""){ 
$book_request['DropOff']['PickUpCode']="1";
$book_request['DropOff']['PickUpName']="Airport";
$book_request['DropOff']['PickUpDetailCode']=$search_data['to_station_code'];
$book_request['DropOff']['PickUpDetailName']=null;
$book_request['DropOff']['IsPickUpAllowed']=true;
$book_request['DropOff']['IsPickUpTimeRequired']=true;
$book_request['DropOff']['Description']=$_REQUEST['airlineCode'].'-'.$_REQUEST['flightNumber'];
$book_request['DropOff']['Time']=$search_data['hours'].$search_data['minutes'];
$book_request['DropOff']['PickUpDate']=null;
$book_request['DropOff']['AddressLine1']=null;
$book_request['DropOff']['city']=null;
$book_request['DropOff']['Country']=null;
$book_request['DropOff']['ZipCode']=null;
$book_request['DropOff']['AddressLine2']=null;
// debug($book_request); die;
}
// Hotel to Airport  
$book_request['Vehicles'][0]['VehicleIndex']=$Vehicle['VehicleIndex'];
$book_request['Vehicles'][0]['Vehicle']=$Vehicle['Vehicle'];
$book_request['Vehicles'][0]['VehicleCode']=$Vehicle['VehicleCode'];
$book_request['Vehicles'][0]['VehicleCode']=$Vehicle['VehicleCode'];
$book_request['Vehicles'][0]['VehicleMaximumPassengers']=$Vehicle['VehicleMaximumPassengers'];
$book_request['Vehicles'][0]['VehicleMaximumLuggage']=$Vehicle['VehicleMaximumLuggage'];
$book_request['Vehicles'][0]['VehicleMaximumLuggage']=$Vehicle['VehicleMaximumLuggage'];
$book_request['Vehicles'][0]['Language']=$Vehicle['Language'];
$book_request['Vehicles'][0]['LanguageCode']=$Vehicle['LanguageCode'];
$book_request['Vehicles'][0]['TransferPrice']=$Vehicle['TransferPrice'];
$book_request['ResultIndex']=$_REQUEST['ResultIndex'];
$book_request['TransferCode']=$_REQUEST['TransferCode'];
$book_request['VehicleIndex'][0]=$Vehicle['VehicleIndex'];
$book_request['BookingMode']=5;
$book_request['OccupiedPax'][0]['AdultCount']=$search_data['adult'];
$book_request['EndUserIp']="182.156.5.54";
$book_request['TokenId']=$token_id;
$book_request['TraceId']=$_REQUEST['TraceId']; 

$rqst = json_encode($book_request); 
$Response = $this->transfer_api->transfer_api_book_response($rqst,$transaction_id,$search_id);   

$Response = json_decode($Response,true); 

if($Response['BookResult']['BookingId']!=""){ 

$token_id = get_tokens();  
$rqst1 = array();
$rqst1['EndUserIp'] = "182.156.5.54";
$rqst1['TokenId'] = $token_id;
$rqst1['BookingId'] = $Response['BookResult']['BookingId'];
$rqst1['AgencyId'] = "54818"; 

$get_booking_details = $this->transfer_api->get_booking_response($rqst,$transaction_id,$search_id);   

debug(json_decode($get_booking_details,true)); die;

}else{

    $text="Booking Failed from API side";
    redirect(WEB_URL.'error/booking_failure/'.base64_encode($text)); exit;
}
// After this, need to call getvoucher if ; Generatevoucher is equal to false.


} 
}
?>